<?php
class ImovelsController extends AppController {

	var $name = 'Imovels';
  var $uses = array('Imovel','Cidade');
	var $helpers = array('Statuso');


  /* ----- FRONT-END ----- */
  /* Pagina Inicial */
	function index() {
    $this->set("title_for_layout"," - Home");
    $this->layout ='home';
    $conditions = array('status'=>'S','destaque'=>'S');
    $fields = array('Imovel.id','Imovel.descricao','Imovel.dorms','Imovel.garagem',
    'Bairro.name','Imovel.area_terreno','Imovel.valor');

    $this->paginate['Imovel'] = array(
      'limit'=>9,
      'conditions' => $conditions,
      'fields' => $fields,
      'order'=>'Imovel.created DESC');

    $imoveis = $this->paginate('Imovel');

    $this->set(compact('imoveis'));
	}

  /* Detalhes do imovel */
  function detalhes($id=null){
		if (!$id) {
			$this->flash(__('Imovel Inválido', true), array('action'=>'index'));
		}
    $this->set("title_for_layout"," - Detalhes do imóvel #".$id);
    $imovel = $this->Imovel->read(null, $id);
    $cidade = $this->Cidade->find('first',array('fields'=>array('name'),
      'conditions'=>array('id'=>$imovel['Bairro']['cidade_id']),'recursive'=>0));
    $this->set(compact('imovel','cidade'));

  }

  /* Resultado da Busca */
  function resultado_busca(){
    if(!$this->data)
     $this->Session->setFlash('Nenhum dado fornecido para a busca');
    else{
      if(!empty($this->data['Imovel']['Categoria']))
        $conditions['categoria_id']=$this->data['Imovel']['Categoria'];
      if(!empty($this->data['Imovel']['Tipo']))
        $conditions['tipo_id']=$this->data['Imovel']['Tipo'];
      if(!empty($this->data['Imovel']['Cidade']) and empty($this->data['Imovel']['Bairro'])) {
        $bairros = $this->Imovel->Bairro->find('list',array('conditions'=>array(
        'cidade_id'=>$this->data['Imovel']['Cidade']),'fields'=>array('id')));
        $conditions['bairro_id']= $bairros;
      }
      else if(!empty($this->data['Imovel']['Bairro']))
        $conditions['bairro_id']=$this->data['Imovel']['Bairro'];

      $conditions['status']='S';
    }

    $imoveis = $this->paginate($conditions);
    $this->set(compact('imoveis'));
    $this->set("title_for_layout"," - Resultado da busca");
  }

  /* Lista 'Meus Imóveis */
  function lista(){
    $this->set("title_for_layout"," - Meus imóveis");
    parent::checkSession();

    $this->Imovel->recursive = -1;
    $this->paginate['Imovel'] = array(
        'limit' => 9,
        'contain' => '',
        'conditions' => array('Imovel.usuario_id'=>$this->Session->read('usuario.id')),
        'fields' => array('Imovel.*', 'Bairro.*','Cidade.*'),
        'joins' => array(
                    array(
                      'table' => 'bairros',
                      'type' => 'INNER',
                      'alias' => 'Bairro',
                     'conditions' => array('Bairro.id = Imovel.bairro_id')),
                    array(
                      'table' => 'cidades',
                      'type' => 'INNER',
                      'alias' => 'Cidade',
                     'conditions' => array('Cidade.id = Bairro.cidade_id'))
                 ));

     $imovels = $this->paginate('Imovel');
     $this->set(compact('imovels'));

  }


  function adicionar(){
    $this->set("title_for_layout"," - Meus imóveis &raquo; Novo Imóvel");
    parent::checkSession();
    $save = true;

		if (!empty($this->data)) { // If 1
		  $this->Imovel->set($this->data);
      if($this->Imovel->validates()){
        //Salvar imovel
        $imoveis = array();
        $imoveis['descricao'] = $this->data['Imovel']['descricao'];
        $imoveis['tipo_id'] = $this->data['Imovel']['tipo_id'];
        $imoveis['categoria_id'] = $this->data['Imovel']['categoria_id'];
        $imoveis['cidade_id'] = $this->data['Imovel']['cidade_id'];
        $imoveis['bairro_id'] = $this->data['Imovel']['bairro_id'];
        $imoveis['area_terreno'] = $this->data['Imovel']['area_terreno'];
        $imoveis['area_construida'] = $this->data['Imovel']['area_construida'];
        $imoveis['dorms'] = $this->data['Imovel']['dorms'];
        $imoveis['banheiros'] = $this->data['Imovel']['banheiros'];
        $imoveis['suites'] = $this->data['Imovel']['suites'];
        $imoveis['sala'] = $this->data['Imovel']['sala'];
        $imoveis['garagem'] = $this->data['Imovel']['garagem'];
        $imoveis['obs'] = $this->data['Imovel']['obs'];
        $imoveis['valor'] = parent:: convert_number_to_en_format($this->data['Imovel']['valor']);
        $imoveis['usuario_id'] = $this->Session->read('usuario.id');
        $imoveis['status'] = $this->data['Imovel']['status'];
        $imoveis['destaque'] = $this->data['Imovel']['destaque'];
        $this->Imovel->create();

        if(!$this->Imovel->save($imoveis)) {
          $save = false;
        }
        $imovel_id = $this->Imovel->id;
        //Salvar imagens
        if(!empty($this->data['Imovel']['foto_img']) and is_array($this->data['Imovel']['foto_img'])){

          foreach($this->data['Imovel']['foto_img'] as $item){
            $imagens = array();
            $imagem['imovel_id'] = $imovel_id;
            $imagem['foto'] = $item;
            $this->Session->delete('qtde');
            $this->Imovel->Foto->create();
            if(!$this->Imovel->Foto->save($imagem)){
              $save = false;
            }
          }
        }
        if($save){

          //Informar admin por e-mail que um imóvel foi criado
          $this->Email->to       =  Configure::read('Site.email');
          $this->Email->subject  = '['.Configure::read('Site.name').'] Imóvel #'.$imovel_id.' criado por usuário';
          $this->Email->from     = Configure::read('Site.email');
          $this->Email->template = 'default';
          $msg .= '<p>O imóvel #'.$imovel_id.' foi criado e precisa de moderação</p>';
          $msg .= '<p>Data: '.date('d/m/Y h:i:s').'</p>';
          $this->Email->sendAs = 'html';

          $this->Session->setFlash(__('Imóvel salvo.', true));
          $this->redirect(array("action" => "lista"));
        }
        else{
          $this->Session->setFlash(__('Não foi possível salvar imóvel.', true));
          $this->redirect(array("action" => "lista"));
        }
      } //Fim if 2
		} // FIm if 1

    //Carrega listas
    $cidade_id  = isset($this->data['Cidade']['id']) ? $this->data['Cidade']['id'] : $this->data['Imovel']['cidade_id'];
		$tipos = $this->Imovel->Tipo->find('list');
		$categorias = $this->Imovel->Categoria->find('list');
		$bairros1= $this->Imovel->Bairro->find('list',array('conditions'=>array('cidade_id'=>$cidade_id)));
	  $this->set(compact('tipos', 'categorias', 'bairros1'));
  }
  function editar($id=null){
    $this->set("title_for_layout"," - Meus imóveis &raquo; Alterar Imóvel");
    parent::checkSession();
    $save = true;
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Imóvel Inválido', true));
      $this->redirect(array("action" => "admin_index"));
		}
		if (!empty($this->data)) {
		  $this->Imovel->set($this->data);
			  if($this->Imovel->validates()){
        //Salvar imovel
        $this->Imovel->id = $id;
        $imoveis = array();
        $imoveis['descricao'] = $this->data['Imovel']['descricao'];
        $imoveis['tipo_id'] = $this->data['Imovel']['tipo_id'];
        $imoveis['categoria_id'] = $this->data['Imovel']['categoria_id'];
        $imoveis['cidade_id'] = $this->data['Imovel']['cidade_id'];
        $imoveis['bairro_id'] = $this->data['Imovel']['bairro_id'];
        $imoveis['area_terreno'] = $this->data['Imovel']['area_terreno'];
        $imoveis['area_construida'] = $this->data['Imovel']['area_construida'];
        $imoveis['dorms'] = $this->data['Imovel']['dorms'];
        $imoveis['banheiros'] = $this->data['Imovel']['banheiros'];
        $imoveis['suites'] = $this->data['Imovel']['suites'];
        $imoveis['sala'] = $this->data['Imovel']['sala'];
        $imoveis['garagem'] = $this->data['Imovel']['garagem'];
        $imoveis['obs'] = $this->data['Imovel']['obs'];
        $imoveis['valor'] = parent:: convert_number_to_en_format($this->data['Imovel']['valor']);
        $imoveis['usuario_id'] = $this->Session->read('usuario.id');
        $imoveis['status'] = $this->data['Imovel']['status'];
        $imoveis['destaque'] = $this->data['Imovel']['destaque'];


        if(!$this->Imovel->save($imoveis)) {
          $save = false;
        }

        //Imagens
        //1. Excluir imagens antigas
        $this->Imovel->Foto->deleteAll(array('imovel_id'=>$id));
        //Salvar imagens (se houverem)
        if(!empty($this->data['Imovel']['foto_img']) and is_array($this->data['Imovel']['foto_img'])){

          foreach($this->data['Imovel']['foto_img'] as $item){
            $imagens = array();
            $imagem['imovel_id'] = $id;
            $imagem['foto'] = $item;
            $this->Session->delete('qtde');
            $this->Imovel->Foto->create();
            if(!$this->Imovel->Foto->save($imagem)){
              //debug($this->Imovel->validationErrors); die();
              $save = false;
            }
          }
        }
        if($save){

          //Informar admin por e-mail que um imóvel foi alterado
          $this->Email->to       = Configure::read('Site.email');
          $this->Email->subject  = '['.Configure::read('Site.name').'] Imóvel #'.$id.' alterado por usuário';
          $this->Email->from     = Configure::read('Site.email');
          $this->Email->template = 'default';
          $msg .= '<p>O imóvel #'.$id.' foi alterado e precisa de moderação</p>';
          $msg .= '<p>Data: '.date('d/m/Y h:i:s').'</p>';
          $this->Email->sendAs = 'html';

          $this->Session->setFlash(__('Imóvel salvo.', true));
          $this->redirect(array("action" => "lista"));
        }
        else{
          $this->Session->setFlash(__('Não foi possível salvar imóvel.', true));
          $this->redirect(array("action" => "lista"));
        }
      }
		}
		if (empty($this->data)) {
		  $this->Imovel->recursive = 0;
		  $this->Imovel->bindModel(array('belongsTo'=>array(
                    'Cidade'=>array(
                        'foreignKey'=>false,
                        'conditions'=>array('Cidade.id = Bairro.cidade_id')),
                    )));
			$this->data = $this->Imovel->find('first',array('conditions'=>array(
      'Imovel.id'=>$id,'Imovel.usuario_id'=>$this->Session->read('usuario.id'))));
      $this->data['Imovel']['foto_img'] = $this->Imovel->Foto->find('all',array('recursive'=>-1,'conditions'=>array('imovel_id'=>$id)));
		}

    if(empty($this->data)){
      $this->Session->setFlash(__('Imóvel não encontrado',true));
      $this->set('error',true);
    }
    $cidade_id  = isset($this->data['Cidade']['id']) ? $this->data['Cidade']['id'] : $this->data['Imovel']['cidade_id'];
		$tipos = $this->Imovel->Tipo->find('list');
		$categorias = $this->Imovel->Categoria->find('list');
		$bairros1= $this->Imovel->Bairro->find('list',array('conditions'=>array('cidade_id'=>$this->data['Cidade']['id'])));
    $imagens = $this->Imovel->Foto->find('all',array('recursive'=>-1,'conditions'=>array('imovel_id'=>$id)));
    if(!empty($imagens)){
      $this->Session->write('qtde',sizeof($imagens));
    }

    $this->set(compact('tipos','categorias','bairros1','imagens'));
  }
  function excluir($id = null) {
    parent::checkSession();

    $this->autoRender = false;
		if (!$id) {
			$this->Session->setFlash(__('Imovel Inválido', true));
      $this->redirect(array("action" => "lista"));
		}


		if ($this->Imovel->deleteAll(array(
      'Imovel.id'=>$id,'Imovel.usuario_id'=>$this->Session->read('usuario.id')))) {
			$this->Session->setFlash(__('Imóvel excluído', true));
      $this->redirect(array("action" => "lista"));
		}
    else{
     $this->Session->setFlash(__('Não é possível excluir este imóvel', true));
      $this->redirect(array("action" => "lista"));
    }
	}

  /*----- ADMIN -----*/
  function admin_index(){
    $this->set("title_for_layout","Imóveis");
    $this->layout = 'admin';
    $this->Imovel->recursive = -1;
    $destaque = array('0'=>'Todos','S'=>'Sim','N'=>'Não');
    //Filtrar condições
    $conditions = array();
    if(empty($this->data))
     $index_qtde = 1;
    else
     $index_qtde  = $this->data['Imovel']['qtde'];

    if(!empty($this->data['Imovel']['descricao'])){
      $conditions['descricao LIKE'] = '%'.$this->data['Imovel']['descricao'].'%';
    }

    if(!empty($this->data['Imovel']['tipo_id'])){
      $conditions['tipo_id'] = $this->data['Imovel']['tipo_id'];
    }
    if(!empty($this->data['Imovel']['categoria_id'])){
      $conditions['categoria_id'] = $this->data['Imovel']['categoria_id'];
    }
    if(!empty($this->data['Imovel']['area_terreno'])){
      $conditions['area_terreno'] = $this->data['Imovel']['area_terreno'];
    }
    if(!empty($this->data['Imovel']['area_construida'])){
      $conditions['area_construida'] = $this->data['Imovel']['area_construida'];
    }
     if(!empty($this->data['Imovel']['area_construida'])){
      $conditions['area_construida'] = $this->data['Imovel']['area_construida'];
    }
    if(!empty($this->data['Imovel']['dorms'])){
      $conditions['dorms'] = $this->data['Imovel']['dorms'];
    }
    if(!empty($this->data['Imovel']['suites'])){
      $conditions['suites'] = $this->data['Imovel']['suites'];
    }
    if(!empty($this->data['Imovel']['banheiros'])){
      $conditions['banheiros'] = $this->data['Imovel']['banheiros'];
    }
    if(!empty($this->data['Imovel']['sala'])){
      $conditions['sala'] = $this->data['Imovel']['sala'];
    }
    if(!empty($this->data['Imovel']['garagem'])){
      $conditions['garagem'] = $this->data['Imovel']['garagem'];
    }
    //Valor
    if(!empty($this->data['Imovel']['valor_from']) && empty($this->data['Imovel']['valor_to'])){
      $valor_from = parent::convert_number_to_en_format($this->data['Imovel']['valor_from']);
      $conditions['valor >='] = $valor_from;
    }
    if(empty($this->data['Imovel']['valor_from']) && !empty($this->data['Imovel']['valor_to'])){
      $valor_to = parent::convert_number_to_en_format($this->data['Imovel']['valor_to']);
      $conditions['valor <='] = $valor_to;
    }
    if(!empty($this->data['Imovel']['valor_from']) && !empty($this->data['Imovel']['valor_to'])){
      $valor_from = parent::convert_number_to_en_format($this->data['Imovel']['valor_from']);
      $valor_to = parent::convert_number_to_en_format($this->data['Imovel']['valor_to']);
      $conditions['valor  BETWEEN ? AND ?'] = array($valor_from,$valor_to);
    }

    if(!empty($this->data['Imovel']['status'])){
      $conditions['status'] = $this->data['Imovel']['status'];
    }
    if(!empty($this->data['Imovel']['destaque'])){
      $conditions['destaque'] = $this->data['Imovel']['destaque'];
    }
    if(!empty($this->data['Imovel']['cidade'])){
      $conditions['Cidade.id'] = $this->data['Imovel']['cidade'];
    }
    if(!empty($this->data['Imovel']['bairro'])){
      $conditions['Imovel.bairro_id'] = $this->data['Imovel']['bairro'];
    }

    $this->paginate['Imovel'] = array(
        'limit' => $this->qtde[$index_qtde],
        'conditions' => array($conditions),
        'fields' => array('Imovel.*', 'Bairro.*','Cidade.*'),
        'joins' => array(
                    array(
                      'table' => 'bairros',
                      'type' => 'INNER',
                      'alias' => 'Bairro',
                     'conditions' => array('Bairro.id = Imovel.bairro_id')),
                    array(
                      'table' => 'cidades',
                      'type' => 'INNER',
                      'alias' => 'Cidade',
                     'conditions' => array('Cidade.id = Bairro.cidade_id'))
                 ));

    $imovels1 = $this->paginate('Imovel');
    $this->set(compact('destaque','imovels1'));
  }

	function admin_view($id = null) {
	  $this->set("title_for_layout","Imóveis &raquo; Ver");
	  $this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Imóvel Inválido', true));
      $this->redirect(array("action" => "admin_index"));
		}
    $this->Imovel->bindModel(array('belongsTo'=>array(
                    'Cidade'=>array(
                        'foreignKey'=>false,
                        'conditions'=>array('Cidade.id = Bairro.cidade_id')),
                    )));

		$imovel = $this->Imovel->find('first',array(
     'recursive'=>0,
     'conditions'=>array('Imovel.id'=>$id)
    ));
    $fotos = $this->Imovel->Foto->find('all',array('recursive'=>-1,
      'conditions'=>array('imovel_id'=>$id)
    ));
    $this->set(compact('imovel','fotos'));
	}

	function admin_add() {
	  $this->set("title_for_layout","Imóveis &raquo; Novo Imóvel");
	  $this->layout = 'admin';
    $save = true;

		if (!empty($this->data)) { // If 1
		  $this->Imovel->set($this->data);
      if($this->Imovel->validates()){
        //Salvar imovel
        $imoveis = array();
        $imoveis['descricao'] = $this->data['Imovel']['descricao'];
        $imoveis['tipo_id'] = $this->data['Imovel']['tipo_id'];
        $imoveis['categoria_id'] = $this->data['Imovel']['categoria_id'];
        $imoveis['cidade_id'] = $this->data['Imovel']['cidade_id'];
        $imoveis['bairro_id'] = $this->data['Imovel']['bairro_id'];
        $imoveis['area_terreno'] = $this->data['Imovel']['area_terreno'];
        $imoveis['area_construida'] = $this->data['Imovel']['area_construida'];
        $imoveis['dorms'] = $this->data['Imovel']['dorms'];
        $imoveis['banheiros'] = $this->data['Imovel']['banheiros'];
        $imoveis['suites'] = $this->data['Imovel']['suites'];
        $imoveis['sala'] = $this->data['Imovel']['sala'];
        $imoveis['garagem'] = $this->data['Imovel']['garagem'];
        $imoveis['obs'] = $this->data['Imovel']['obs'];
        $imoveis['valor'] = parent:: convert_number_to_en_format($this->data['Imovel']['valor']);
        $imoveis['usuario_id'] = $this->Session->read('usuario.id');
        $imoveis['status'] = $this->data['Imovel']['status'];
        $imoveis['destaque'] = $this->data['Imovel']['destaque'];
        $this->Imovel->create();

        if(!$this->Imovel->save($imoveis)) {
          //debug($this->Imovel->validationErrors); die();
          $save = false;
        }
        $imovel_id = $this->Imovel->id;
        //Salvar imagens
        if(!empty($this->data['Imovel']['foto_img']) and is_array($this->data['Imovel']['foto_img'])){

          foreach($this->data['Imovel']['foto_img'] as $item){
            $imagens = array();
            $imagem['imovel_id'] = $imovel_id;
            $imagem['foto'] = $item;
            $this->Session->delete('qtde');
            $this->Imovel->Foto->create();
            if(!$this->Imovel->Foto->save($imagem)){
              //debug($this->Imovel->validationErrors); die();
              $save = false;
            }
          }
        }
        if($save){
          $this->Session->setFlash(__('Imóvel salvo.', true));
          $this->redirect(array("action" => "admin_index"));
        }
        else{
          $this->Session->setFlash(__('Não foi possível salvar imóvel.', true));
          $this->redirect(array("action" => "admin_index"));
        }
      } //Fim if 2
		} // FIm if 1

    //Carrega listas
    $cidade_id  = isset($this->data['Cidade']['id']) ? $this->data['Cidade']['id'] : $this->data['Imovel']['cidade_id'];
    $tipos = $this->Imovel->Tipo->find('list');
		$categorias = $this->Imovel->Categoria->find('list');
    $bairros1= $this->Imovel->Bairro->find('list',array('conditions'=>array('cidade_id'=>$cidade_id)));

	  $this->set(compact('tipos', 'categorias', 'bairros1'));
	}

	function admin_edit($id = null) {
	  $this->set("title_for_layout","Imóveis &raquo; Editar Imóvel");
	  $this->layout = 'admin';
    $save = true;
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Imóvel Inválido', true));
      $this->redirect(array("action" => "admin_index"));
		}
		if (!empty($this->data)) {
		  $this->Imovel->set($this->data);
			  if($this->Imovel->validates()){
        //Salvar imovel
        $this->Imovel->id = $id;
        $imoveis = array();
        $imoveis['descricao'] = $this->data['Imovel']['descricao'];
        $imoveis['tipo_id'] = $this->data['Imovel']['tipo_id'];
        $imoveis['categoria_id'] = $this->data['Imovel']['categoria_id'];
        $imoveis['cidade_id'] = $this->data['Imovel']['cidade_id'];
        $imoveis['bairro_id'] = $this->data['Imovel']['bairro_id'];
        $imoveis['area_terreno'] = $this->data['Imovel']['area_terreno'];
        $imoveis['area_construida'] = $this->data['Imovel']['area_construida'];
        $imoveis['dorms'] = $this->data['Imovel']['dorms'];
        $imoveis['banheiros'] = $this->data['Imovel']['banheiros'];
        $imoveis['suites'] = $this->data['Imovel']['suites'];
        $imoveis['sala'] = $this->data['Imovel']['sala'];
        $imoveis['garagem'] = $this->data['Imovel']['garagem'];
        $imoveis['obs'] = $this->data['Imovel']['obs'];
        $imoveis['valor'] = parent:: convert_number_to_en_format($this->data['Imovel']['valor']);
        $imoveis['usuario_id'] = $this->Session->read('usuario.id');
        $imoveis['status'] = $this->data['Imovel']['status'];
        $imoveis['destaque'] = $this->data['Imovel']['destaque'];
        //$imoveis['Imovel.id'] = $imovel_id;

        if(!$this->Imovel->save($imoveis)) {
          //debug($this->Imovel->validationErrors); die();
          $save = false;
        }

        //Imagens
        //1. Excluir imagens antigas
        $this->Imovel->Foto->deleteAll(array('imovel_id'=>$id));
        //Salvar imagens (se houverem)
        if(!empty($this->data['Imovel']['foto_img']) and is_array($this->data['Imovel']['foto_img'])){

          foreach($this->data['Imovel']['foto_img'] as $item){
            $imagens = array();
            $imagem['imovel_id'] = $id;
            $imagem['foto'] = $item;
            $this->Session->delete('qtde');
            $this->Imovel->Foto->create();
            if(!$this->Imovel->Foto->save($imagem)){
              //debug($this->Imovel->validationErrors); die();
              $save = false;
            }
          }
        }
        if($save){

          $this->Session->setFlash(__('Imóvel salvo.', true));
          $this->redirect(array("action" => "admin_index"));
        }
        else{
          $this->Session->setFlash(__('Não foi possível salvar imóvel.', true));
          $this->redirect(array("action" => "admin_index"));
        }
      }
		}
		if (empty($this->data)) {
		  $this->Imovel->recursive = 0;
		  $this->Imovel->bindModel(array('belongsTo'=>array(
                    'Cidade'=>array(
                        'foreignKey'=>false,
                        'conditions'=>array('Cidade.id = Bairro.cidade_id')),
                    )));
			$this->data = $this->Imovel->read(null, $id);
		}
    $cidade_id  = isset($this->data['Cidade']['id']) ? $this->data['Cidade']['id'] : $this->data['Imovel']['cidade_id'];
		$tipos = $this->Imovel->Tipo->find('list');
		$categorias = $this->Imovel->Categoria->find('list');
		$bairros1= $this->Imovel->Bairro->find('list',array('conditions'=>array('cidade_id'=>$cidade_id)));
    $this->data['Imovel']['foto_img'] = $this->Imovel->Foto->find('all',array('recursive'=>-1,'conditions'=>array('imovel_id'=>$id)));
    if(!empty($imagens)){
      $this->Session->write('qtde',sizeof($imagens));
    }

    $this->set(compact('tipos','categorias','bairros1','imagens','cidade_id'));
	}

	function admin_delete($id = null) {
	  $this->autoRender = false;  
		if (!$id) {
			$this->Session->setFlash(__('Imóvel Inválido', true));
      $this->redirect(array("action" => "admin_index"));
		}
		if ($this->Imovel->delete($id)) {
		  //Excluir imagens do imóvel selecionado
      $this->Imovel->Foto->deleteAll(array('imovel_id'=>$id));
			$this->Session->setFlash(__('Imóvel excluído.', true));
      $this->redirect(array("action" => "admin_index"));
		}
	}


  /*---- OUTRAS FUNÇÔES -----*/
  function manager_files(){
    $this->autoRender = false;
    Configure::write ( 'debug', 0 );
    $idx = 1;
    $limite = Configure::read('File.max_qtde');
    if(!$this->Session->read('qtde')){
      $this->Session->write('qtde',$idx);
    }
    else
     $idx = $this->Session->read('qtde');


    //if($acao != ''){

     if($this->params['form']['foto']){ //a imagem existe
       $foto = $this->params['form']['foto'];
       $ext = substr(strtolower($foto["name"]),-3);
       //1. Verificar extensão
       if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'png') {
         $erro = 'Você só pode fazer upload de imagens com as extensões permitidas';
       }
       //2. Verificar tamanho do arquivo
       else if($foto['size'] > Configure::read('File.max_file_size_kb')){
          $erro =  "Tamanho do arquivo maior que o permitido";
          exit;
       }
       else{
         //3. Verificar se nº de fotos enviadas é maior ou igual ao permitido
         if($idx <= $limite){

         $uploadfile = WWW_ROOT.'img/imoveis/imovel_'.$idx.'_'.date('Ymdmis').".".$ext;
         //fazer upload do arquivo
         if(!move_uploaded_file($foto['tmp_name'], $uploadfile)){
          $erro = 'Não foi possível fazer upload do arquivo';
         }
         else{
           echo basename($uploadfile);
           $idx++;
           $this->Session->write('qtde',$idx);
         }
        }
        else{
          $erro = 'Número de imagens permitidas atingido';
        }
       }
     }

     else{
       $erro = 'Nenhuma imagem definida';
     }

    //}
    //else {
    //  $erro = 'Nenhuma ação definida';
    //}
    if(!empty($erro)){
      echo 'Erro:'.$erro;
    }
  }

  function delete_file($file=null){
    $this->autoRender = false;
    Configure::write ( 'debug', 0 );
    if($file){
      //1. Apaga imagem
        if(file_exists(WWW_ROOT."img\imoveis\\".$file)){
          unlink(WWW_ROOT."img\imoveis\\".$file);
          echo "Apagou";
        }
        else
         echo "Erro: O arquivo não existe";
    }
  }
  function get_bairros($cidade_id=null){
    if($cidade_id){
      $this->autoRender = false;
      Configure::write ( 'debug', 0 );
      $bairros = $this->Imovel->Bairro->find('all',array('conditions'=>array('cidade_id'=>$cidade_id),
      'recursive'=>-1));
      if(!empty($bairros)){
        foreach($bairros as $key=>$bairro){
          $out[$key]['value'] = $bairro['Bairro']['id'];
          $out[$key]['caption'] = $bairro['Bairro']['name'];
        }
        return json_encode($out);
      }

    }
  }
}
?>