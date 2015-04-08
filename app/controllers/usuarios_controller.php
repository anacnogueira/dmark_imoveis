<?php
class UsuariosController extends AppController {

	var $name = 'Usuarios';
  var $helpers = array('Statuso');
  /* FRONT END */
  function cadastro(){
    $this->set("title_for_layout"," - Cadastro de usuário");
    if (!empty($this->data)) {
     $this->Usuario->create();
     if ($this->__saveUser($this->data['Usuario'])) {

       $body  = "<h1>Confirmação de cadastro</h1>";
       $body .= "<p>Parabéns pela criação de sua nova conta na D'mark Imóveis!</p>";
       $body .= "<p>Clique no link abaixo para confirmar seu cadastro e confirmar sua conta";
       $body .= "<p><a href='".Configure::read('Site.url')."usuarios/valida_cadastro/".$this->data['Usuario']['randow']."'>".Configure::read('Site.url')."usuarios/valida_cadastro/".$this->data['Usuario']['randow']."</a></p>";

       $this->Email->from     = Configure::read('Site.email');
       $this->Email->to = $this->data['Usuario']['nome'].' <'.$this->data['Usuario']['email'].'>';
       $this->Email->subject = '['.Configure::read('Site.name').'] Cadastro de usuário';
       $this->Email->template = 'default';
       $this->Email->sendAs = 'html';
       if($this->Email->send($body))
        $sent = 's';
       else
        $sent = 'n';

       $this->redirect(array('action' => 'confirma_cadastro',$sent));
		 } else {
				//$this->Session->setFlash(__('Seu cadastro não pode ser salvo. Por favor, tente novamente.', true));
		 }
    }
    $this->set('randow',$this->__gera_numero(12));
  }

  function confirma_cadastro($sent){
   if(!empty($sent)){
     $this->set(compact('sent'));
   }
  }

  function valida_cadastro($cod = null){
    if(!empty($cod)){
     $data = $this->Usuario->find('first',array('conditions'=>array('randow'=>$cod),
     'recursive'=>-1));

      //Verifica se o codigo de validação foi cadastrado
      if(isset($data['Usuario']['randow'])){
        //Ativar Conta
        $this->Usuario->updateAll(
          array('ativo'=>"'S'",'randow'=>NULL),
          array('Usuario.id'=>$data['Usuario']['id'])
        );

        $body = "<h1>Cadastro Ativado</h1>";
        $body .= "<p>Parabéns, sua conta já está ativada</p>";
        $body .= "<p>Clique no link abaixo para cadastrar seus imóveis</p>";
        $body .= "<p><a href='".Configure::read('Site.url')."imovels/adicionar'>".Configure::read('Site.url')."imovels/adicionar</a></p>";

        $this->Email->from = Configure::read('Site.name').' <'.Configure::read('Site.email').'>';
        $this->Email->to = $data['Usuario']['nome'].' <'.$data['Usuario']['email'].'>';
        $this->Email->subject = '['.Configure::read('Site.name').'] Cadastro ativado';
        $this->Email->template = 'default';
        $this->Email->sendAs = 'html';
        $this->Email->send($body);
      }
    } else {
      $body = "<h1>Cadastro não efetivado</h1>";
      $body = "<p>Não foi possível ativar sua conta, codigo de confirmação incorreto</p>";
    }

    $this->set("body",$body);

  }

  function esqueci_senha(){
    $this->set("title_for_layout"," - Esqueci a senha");
    if($this->data){
      // Check for data validation
      $this->Usuario->set($this->data);
      if($this->Usuario->validates(array('fieldList' => array('email')))) {
        $data = $this->Usuario->find('first',
          array('conditions'=>array('email'=>$this->data['Usuario']['email']),
          'recursive'=>-1));

         if(!empty($data)){  //Verificar se o e-mail esta cadastrado
           //Gerar novo código randomico
           $randow = $this->__gera_numero(12);

           //Adicionar código de confirmação e colocar ativo como N
           $this->Usuario->updateAll(
            array('ativo'=>"'N'",'randow'=>$randow),
            array('Usuario.id'=>$data['Usuario']['id'])
           );

           //Enviar e-mail
           $body = "<h1>Cadastrar nova senha</h1>";
           $body .= "<p>Segue abaixo o link para o cadastro da nova senha</p>";
           $body .= "<p><a href='".Configure::read('Site.url')."usuarios/cadastrar_nova_senha/".$randow."'>".Configure::read('Site.url')."usuarios/cadastrar_nova_senha/".$randow."</a></p>";

            $this->Email->from = Configure::read('Site.name').' <'.Configure::read('Configure.email').'>';
            $this->Email->to = $data['Usuario']['nome'].' <'.$data['Usuario']['email'].'>';
            $this->Email->subject = '['.Configure::read('Site.name').'] Cadastrar nova senha';
            $this->Email->template = 'default';
            $this->Email->sendAs = 'html';
            $this->Email->send($body);

            $msg = "Um link para o cadastro de nova senha foi enviado para o seu e-mail";

         }
         else
           $msg = "Não possível enviar e-mail: não cadastrado em nosso Banco de Dados";

         $this->set("msg",$msg);
      }
   }
  }

  function cadastrar_nova_senha($cod = null){
    $this->set("title_for_layout"," - Cadastrar nova senha");
   // if(!empty($cod)){
      if(!empty($this->data)){
         $this->Usuario->updateAll(
          array('ativo'=>"'S'",'randow'=>NULL),
          array('email'=>$this->data['Usuario']['email'])
         );

         //Enviar email
          $body = "<h1>Nova senha Cadastrada</h1>";
          $body .= "<p>Nova Senha:".$this->data['Usuario']['password']."</p>";

          $this->Email->from = Configure::read('Site.name').' <'.Configure::read('Configure.email').'>';
          $this->Email->to =   $this->data['Usuario']['email'];
          $this->Email->subject = '['.Configure::read('Site.name').'] Nova senha Cadastrada';
          $this->Email->template = 'default';
          $this->Email->sendAs = 'html';
          $this->Email->send($body);

          $this->redirect(array('action' => 'nova_senha_cadastrada'));
      } else{
       //Achar o e-mail  através do codigo enviado
       $data = $this->Usuario->find('first',array(
        'conditions'=>array('randow'=>$cod),
        'recursive'=>-1));

       if(!empty($data)){
         $this->set('email',$data['Usuario']['email']);
       }
     }
   }


   function login($type=null){
     $this->set("title_for_layout","Login");
     if(!$this->Session->read('redirect_page.url')){
      if($type == 'admin'){
        $this->layout = 'admin';
        $redirect = '/admin';
      }
      else{
        $this->layout = 'default';
        $redirect = '/meus_imoveis';
      }
     }
     else
      $redirect = '/'.$this->Session->read('redirect_page.url');

      if(!empty($this->data)){

        $this->Usuario->set($this->data);
        if($this->Usuario->validates(array('fieldList' => array('username','senha')))) {

          $email    = $this->data['Usuario']['username'];
          $password = Security::hash(trim($this->data['Usuario']['senha']));

          $usuario = $this->Usuario->find('first',array(
            'conditions'=>array('email'=>$email,'password'=>$password),
            'recursive'=>0,
            'fields'=>array('Usuario.id','Usuario.nome','Usuario.email','Usuario.ativo',
              'Grupo.id','Grupo.name')
          ));

          //Validar e-mail e senha
          if(!$usuario){

            $this->Session->setFlash(__('Usuário e/ou senha inválidos.',true));

          }
          elseif(($type == 'admin' and $usuario['Grupo']['name'] != 'Admin') or $usuario['Usuario']['ativo'] != 'S'){
           $this->Session->setFlash(__('Usuário não autorizado',true));
          }
          else{
            $usuario['Usuario']['type'] = $usuario['Grupo']['name'];
            $this->Session->write('usuario',$usuario['Usuario']);
            $this->redirect($redirect);
          }
        }
      }
      $this->set(compact('type','page'));
   }

   function logout() {

    if((isset($this->passedArgs[0]) and $this->passedArgs[0] == 'admin')  or $this->params['controller'] == 'admin'){
        $redirect = '/admin/login';
    }
    else{
        $redirect = '/';
    }

      $this->Session->delete('usuario');
      $this->Session->destroy();
      $this->Session->setFlash('Sessão encerrada.');
      $this->redirect($redirect);
   }

   function alterar_cadastro($id=null){
    $this->set("title_for_layout"," - Alterar dados");
    parent::checkSession();

    if(!$id)
      $id = $this->Session->read('usuario.id');

    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Usuário Inválido', true));
		}
		if(!empty($this->data)) {
		  $this->Usuario->set($this->data);
      $fields = array('nome','email','cpf','telefone','celular','cep','endereco',
      'complemento','bairro','cidade','estado','data_nascimento');

      if($this->Usuario->validates(array('fieldList' => $fields))) {
        $user = array();
        $user['nome']            = "'".$this->data['Usuario']['nome']."'";
        $user['email']           = "'".$this->data['Usuario']['email']."'";
        $user['cpf']             = "'".$this->data['Usuario']['cpf']."'";
        $user['telefone']        = "'".$this->data['Usuario']['telefone']."'";
        $user['celular']         = "'".$this->data['Usuario']['celular']."'";
        $user['cep']             = "'".$this->data['Usuario']['cep']."'";
        $user['endereco']        = "'".$this->data['Usuario']['endereco']."'";
        $user['complemento']     = "'".$this->data['Usuario']['complemento']."'";
        $user['bairro']          = "'".$this->data['Usuario']['bairro']."'";
        $user['cidade']          = "'".$this->data['Usuario']['cidade']."'";
        $user['estado']          = "'".$this->data['Usuario']['estado']."'";
        $user['data_nascimento'] = "'".parent::format_date($this->data['Usuario']['data_nascimento'],2)."'";

			  if ($this->Usuario->updateAll($user,array('Usuario.id'=>$id))) {
				  $this->Session->setFlash(__('Dados alterados com sucesso', true));
        }
			 else {
        $this->Session->setFlash(__('Não foi possível salvar usuário', true));
			 }
      }
     }
		if (empty($this->data)) {
			$this->data = $this->Usuario->read(null, $this->Session->read('usuario.id'));
      if(!empty($this->data['Usuario']['data_nascimento'])){
        $this->data['Usuario']['data_nascimento'] = parent::format_date($this->data['Usuario']['data_nascimento'],1);
      }
		}
   }

   function alterar_senha($id=null){
     $this->set("title_for_layout"," - Alterar senha");
     parent::checkSession();
     if(!$id)
      $id = $this->Session->read('usuario.id');

    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Usuário Inválido', true));

		}
		if(!empty($this->data)) {
		  $this->Usuario->set($this->data);
      $fields = array('senhaAtual','password1','password2');

      if($this->Usuario->validates(array('fieldList' => $fields))) {
        $user = array();
        $user['password']            = "'".Security::hash($this->data['Usuario']['password1'])."'";
        if ($this->Usuario->updateAll($user,array('Usuario.id'=>$id))) {
				  $this->Session->setFlash(__('Senha alterada com sucesso', true));
        }
			 else {
        $this->Session->setFlash(__('Não foi possível salvar usuário', true));
			 }
      }
		}
		if (empty($this->data)) {
      $this->data = $this->Usuario->read(null, $id);
      if(!empty($this->data['Usuario']['data_nascimento'])){
        $this->data['Usuario']['data_nascimento'] = parent::format_date($this->data['Usuario']['data_nascimento'],1);
      }
		}
   }
   function nova_senha_cadastrada(){
    $this->set("title_for_layout"," - Nova senha cadastrada");
   }
   function codigo_nao_informado() {}


  /* FUNÇÔES RESTRITAS */
  function __gera_numero($valor = 0){
    $rnd = "";
    for($i = 0; $i < $valor;$i++)
      $rnd .= rand(0,9);

    return $rnd;
  }

  function __saveUser($getUser){
    if(!empty($getUser)){


      $this->Usuario->create();
      if($this->Usuario->save($getUser)){
        return true;
      }
      return false;
    }
  }



  /*----- ADMIN ------*/
   function admin_esqueci_senha(){
    $this->set("title_for_layout","Esqueci a senha");
    $this->layout = 'admin';
    if($this->data){
      // Check for data validation
      $this->Usuario->set($this->data);
      if($this->Usuario->validates(array('fieldList' => array('email')))) {
        $data = $this->Usuario->find('first',
          array('conditions'=>array('email'=>$this->data['Usuario']['email']),
          'recursive'=>-1));

         if(!empty($data)){  //Verificar se o e-mail esta cadastrado
           //Gerar novo código randomico
           $randow = $this->__gera_numero(12);

           //Adicionar código de confirmação e colocar ativo como N
           $this->Usuario->updateAll(
            array('ativo'=>"'N'",'randow'=>$randow),
            array('Usuario.id'=>$data['Usuario']['id'])
           );

           //Enviar e-mail
           $body = "<h1>Cadastrar nova senha</h1>";
           $body .= "<p>Segue abaixo o link para o cadastro da nova senha</p>";
           $body .= "<p><a href='".Configure::read('Site.url')."/admin/usuarios/cadastrar_nova_senha/".$randow."'>".Configure::read('Site.url')."/admin/usuarios/cadastrar_nova_senha/".$randow."</a></p>";

            $this->Email->from = Configure::read('Site.name').' <'.Configure::read('Site.email').'>';
            $this->Email->to = $data['Usuario']['nome'].' <'.$data['Usuario']['email'].'>';
            $this->Email->subject = '['.Configure::read('Site.name').'] Cadastrar nova senha';
            $this->Email->template = 'default';
            $this->Email->sendAs = 'html';
            $this->Email->send($body);

            $msg = "Um link para o cadastro de nova senha foi enviado para o seu e-mail";

         }
         else
           $msg = "E-mail desconhecido.";

         $this->set("msg",$msg);
      }
   }
  }

  function admin_cadastrar_nova_senha($cod = null){
    $this->set("title_for_layout","Cadastrar nova senha");
    $this->layout = 'admin';
   // if(!empty($cod)){
      if(!empty($this->data)){
         $this->Usuario->updateAll(
          array('ativo'=>"'S'",'randow'=>NULL),
          array('email'=>$this->data['Usuario']['email'])
         );

         //Enviar email
          $body = "<h1>Nova senha Cadastrada</h1>";
          $body .= "<p>Nova Senha:".$this->data['Usuario']['password']."</p>";
          $this->Email->smtpOptions = Configure::read("Site.smtp_config");
          $this->Email->from = Configure::read('Site.name').' <'.Configure::read('Site.email').'>';
          $this->Email->to =   $this->data['Usuario']['email'];
          $this->Email->subject = '['.Configure::read('Site.name').'] Nova senha Cadastrada';
          $this->Email->template = 'default';
          $this->Email->sendAs = 'html';
          $this->Email->delivery = 'smtp';
          $this->Email->send($body);
          $this->set('smtp_errors', $this->Email->smtpError);
          pr($this->Session->read('Message.email'));

          $this->redirect(array('action' => 'nova_senha_cadastrada'));
      } else{
       //Achar o e-mail  através do codigo enviado
       $data = $this->Usuario->find('first',array(
        'conditions'=>array('randow'=>$cod),
        'recursive'=>-1));
       if(!$data){
         $erro = 'Código vázio ou não válido.';
         $this->set(compact('erro'));

       }
       if(!empty($data)){
         $this->set('email',$data['Usuario']['email']);
       }
     }
   }
    function admin_nova_senha_cadastrada(){
      $this->set("title_for_layout","Nova senha cadastrada");
      $this->layout = 'admin';
    }

	function admin_index() {
	  $this->set("title_for_layout","Usuários");
	  $this->layout = 'admin';
    $this->Usuario->recursive = 1;
    //Filtrar condições
    $conditions = array();
    if(empty($this->data))
     $index_qtde = 1;
    else
     $index_qtde  = $this->data['Usuario']['qtde'];

    if(!empty($this->data['Usuario']['nome'])){
      $conditions['nome LIKE'] = '%'.$this->data['Usuario']['nome'].'%';
    }
    if(!empty($this->data['Usuario']['grupo'])){
      $conditions['grupo_id'] = $this->data['Usuario']['grupo'];
    }
    if(!empty($this->data['Usuario']['ativo'])){
      $conditions['ativo'] = $this->data['Usuario']['ativo'];
    }
    $this->paginate['Usuario'] = array(
      'limit'=>$this->qtde[$index_qtde],
      'conditions' => array($conditions),
      'fields' => array('Usuario.*', 'Grupo.*'));

    $usuarios = $this->paginate('Usuario');
    $grupos = $this->Usuario->Grupo->find('list');
    array_unshift($grupos,'Todos');
    $this->set(compact('grupos','usuarios'));
	}

	function admin_view($id = null) {
	  $this->set("title_for_layout","Usuário &raquo; Ver");
	  $this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Usuário Inválido', true));
      $this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
		}
    $usuario =  $this->Usuario->read(null, $id);
    $usuario['Usuario']['data_nascimento'] = parent::format_date($usuario['Usuario']['data_nascimento'],1);
    $usuario['Usuario']['created'] = parent::format_date($usuario['Usuario']['created'],4);
    $usuario['Usuario']['modified'] = parent::format_date($usuario['Usuario']['modified'],4);
		$this->set(compact('usuario'));
	}

	function admin_add() {
	  $this->set("title_for_layout","Usuário &raquo; Novo usuário");
	  $this->layout = 'admin';
		if (!empty($this->data)) {
      $this->Usuario->set($this->data);
		  if($this->data['Usuario']['cod'] == 'S'){
		    //Gerar código de ativação
        $this->data['Usuario']['randow'] =  $this->__gera_numero(12);
		  }

      if($this->Usuario->validates()) {
        $this->Usuario->create();

			  if ($this->Usuario->save($this->data)) {
				  $body  = "<h1>Confirmação de cadastro</h1>";
          $body .= "<p>Parabéns pela criação de sua nova conta na D'mark Imóveis!</p>";
          $body .= "<p>Clique no link abaixo para confirmar seu cadastro e confirmar sua conta";
          if(isset($this->data['Usuario']['randow']))
            $body .= "<p><a href='".Configure::read('Site.url')."usuarios/valida_cadastro/".$this->data['Usuario']['randow']."'>".Configure::read('Site.url')."usuarios/confirma_cadastro/".$this->data['Usuario']['randow']."</a></p>";

          $this->Email->from = Configure::read('Site.name').' <'.Configure::read('Site.email').'>';
          $this->Email->to = $this->data['Usuario']['nome'].' <'.$this->data['Usuario']['email'].'>';
          $this->Email->subject = '['.Configure::read('Site.name').'] Cadastro de usuário';
          $this->Email->template = 'default';
          $this->Email->sendAs = 'html';
          $this->redirect(array("action" => "admin_index"));
			  } else {
          //Erro ao cadastrar usuário
          $this->Session->setFlash(__('Não foi possível cadastrar usuário. Por favor,
          contacte o administrador do site.', true));
        }

		  }
    }
    $grupos = $this->Usuario->Grupo->find('list');
    $this->set(compact('grupos'));
	}

	function admin_edit($id = null) {
	  $this->set("title_for_layout","Usuário &raquo; Editar usuário");
	  $this->layout = 'admin';
		if (!$id && empty($this->data)) {

			$this->Session->setFlash(__('Usuário Inválido', true));
      $this->redirect(array("action" => "admin_index"));
		}
		if (!empty($this->data)) {
      if($this->data['Usuario']['cod'] == 'S'){
		    //Gerar código de ativação
        $this->data['Usuario']['randow'] =  $this->__gera_numero(12);
		  }
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(__('O usuário foi salvo', true));
        $this->redirect(array('controller'=>'usuarios','action'=>'admin_index'));
			} else {
        //Não foi possível salvar dados do usuário
			}
		}
		if (empty($this->data)) {
      $this->data = $this->Usuario->read(null, $id);
      if(!empty($this->data['Usuario']['data_nascimento'])){
        $this->data['Usuario']['data_nascimento'] = parent::format_date($this->data['Usuario']['data_nascimento'],1);
      }
		}

    $grupos = $this->Usuario->Grupo->find('list');
    $this->set(compact('grupos'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Usuário Invalido', true));
      $this->redirect(array("action" => "admin_index"));
		}
		if ($this->Usuario->delete($id)) {
			$this->flash(__('Usuário excluído', true), array('action'=>'admin_index'));
      $this->redirect(array("action" => "admin_index"));
		}
	}

  function admin_edit_user_count($id=null) {
    $this->set("title_for_layout","Alterar dados");
    $this->layout = 'admin';
    if(!$id)
      $id = $this->Session->read('usuario.id');

    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Usuário Inválido', true));
		}
		if(!empty($this->data)) {
		  $this->Usuario->set($this->data);
      $fields = array('nome','email','cpf','telefone','celular','cep','endereco',
      'complemento','bairro','cidade','estado','data_nascimento');

      if($this->Usuario->validates(array('fieldList' => $fields))) {
        $user = array();
        $user['nome']            = "'".$this->data['Usuario']['nome']."'";
        $user['email']           = "'".$this->data['Usuario']['email']."'";
        $user['cpf']             = "'".$this->data['Usuario']['cpf']."'";
        $user['telefone']        = "'".$this->data['Usuario']['telefone']."'";
        $user['celular']         = "'".$this->data['Usuario']['celular']."'";
        $user['cep']             = "'".$this->data['Usuario']['cep']."'";
        $user['endereco']        = "'".$this->data['Usuario']['endereco']."'";
        $user['complemento']     = "'".$this->data['Usuario']['complemento']."'";
        $user['bairro']          = "'".$this->data['Usuario']['bairro']."'";
        $user['cidade']          = "'".$this->data['Usuario']['cidade']."'";
        $user['estado']          = "'".$this->data['Usuario']['estado']."'";
        $user['data_nascimento'] = "'".parent::format_date($this->data['Usuario']['data_nascimento'],2)."'";

			  if ($this->Usuario->updateAll($user,array('Usuario.id'=>$id))) {
				  $this->Session->setFlash(__('Dados alterados com sucesso', true));
        }
			 else {
        $this->Session->setFlash(__('Não foi possível salvar usuário', true));
			 }
      }
		}
		if (empty($this->data)) {
      $this->data = $this->Usuario->read(null, $id);
      if(!empty($this->data['Usuario']['data_nascimento'])){
        $this->data['Usuario']['data_nascimento'] = parent::format_date($this->data['Usuario']['data_nascimento'],1);
      }
		}
	}

  function admin_edit_user_password($id=null) {
    $this->set("title_for_layout","Alterar senha");
    $this->layout = 'admin';
    if(!$id)
      $id = $this->Session->read('usuario.id');

    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Usuário Inválido', true));

		}
		if(!empty($this->data)) {
		  $this->Usuario->set($this->data);
      $fields = array('senhaAtual','password1','password2');

      if($this->Usuario->validates(array('fieldList' => $fields))) {
        $user = array();
        $user['password']            = "'".Security::hash($this->data['Usuario']['password1'])."'";
        if ($this->Usuario->updateAll($user,array('Usuario.id'=>$id))) {
				  $this->Session->setFlash(__('Senha alterada com sucesso', true));
        }
			 else {
        $this->Session->setFlash(__('Não foi possível salvar usuário', true));
			 }
      }
		}
		if (empty($this->data)) {
      $this->data = $this->Usuario->read(null, $id);
      if(!empty($this->data['Usuario']['data_nascimento'])){
        $this->data['Usuario']['data_nascimento'] = parent::format_date($this->data['Usuario']['data_nascimento'],1);
      }
		}
	}
}
?>