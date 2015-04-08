<?php
class BairrosController extends AppController {

	var $name = 'Bairros';
	var $helpers = array('Html', 'Form');

	function admin_index() {
	  $this->set("title_for_layout","Bairros");
    $this->layout = 'admin';
    $this->Bairro->recursive = 2;
		//Filtrar condições
    $conditions = array();
    if(empty($this->data))
     $index_qtde = 1;
    else
     $index_qtde  = $this->data['Bairro']['qtde'];

    if(!empty($this->data['Bairro']['name'])){
      $conditions['Bairro.name LIKE'] = '%'.$this->data['Bairro']['name'].'%';
    }
    if(!empty($this->data['Bairro']['cidade'])){
      $conditions['cidade_id'] = $this->data['Bairro']['cidade'];
    }

    $this->paginate['Bairro'] = array(
      'limit'=>$this->qtde[$index_qtde],
      'conditions' => array($conditions),
      'fields' => array('Bairro.*'));

    $bairros1 = $this->paginate('Bairro');
    $this->set(compact('bairros1'));
	}

	function admin_view($id = null) {
	  $this->set("title_for_layout","Bairros &raquo; Ver");
	  $this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Bairro Inválido', true));
      $this->redirect(array('controller'=>'bairros','action'=>'index'));
		}
		$this->set('bairro', $this->Bairro->read(null, $id));
	}

	function admin_add() {
	  $this->set("title_for_layout","Bairros &raquo; Novo Bairro");
	  $this->layout = 'admin';
		if (!empty($this->data)) {
			$this->Bairro->create();
			if ($this->Bairro->save($this->data)) {
				$this->Session->setFlash(__('Bairro salvo.', true));
        $this->redirect(array("action" => "index"));
			} else {
			}
		}
		$cidades = $this->Bairro->Cidade->find('list');
		$this->set(compact('cidades'));
	}

	function admin_edit($id = null) {
	  $this->set("title_for_layout","Bairros &raquo; Editar Bairro");
	  $this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->flash(__('Bairro Inválido', true), array('action'=>'index'));
      $this->redirect(array("action" => "index"));
		}
		if (!empty($this->data)) {
			if ($this->Bairro->save($this->data)) {
				$this->Session->setFlash(__('O bairro foi salvo.', true));
        $this->redirect(array("action" => "index"));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Bairro->read(null, $id);
		}
		$cidades = $this->Bairro->Cidade->find('list');
		$this->set(compact('cidades'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Bairro Inválido', true), array('action'=>'index'));
		}
		if ($this->Bairro->delete($id)) {
			$this->Session->setFlash(__('Bairro excluído', true));
      $this->redirect(array("action" => "index"));   
		}
	}

}
?>