<?php
class CidadesController extends AppController {

	var $name = 'Cidades';
	var $helpers = array('Html', 'Form');

	function admin_index() {
	  $this->set("title_for_layout","Cidades");
	  $this->layout = 'admin';
		$this->Cidade->recursive = 0;
		//Filtrar condições
    $conditions = array();
    if(empty($this->data))
     $index_qtde = 1;
    else
     $index_qtde  = $this->data['Cidade']['qtde'];

    if(!empty($this->data['Cidade']['name'])){
      $conditions['name LIKE'] = '%'.$this->data['Cidade']['name'].'%';
    }

    $this->paginate['Cidade'] = array(
      'limit'=>$this->qtde[$index_qtde],
      'conditions' => array($conditions),
      'fields' => array('Cidade.*'));

    $cidades1 = $this->paginate('Cidade');
    $this->set(compact('cidades1'));
	}

	function admin_view($id = null) {
	  $this->set("title_for_layout","Cidades &raquo; Ver");
	  $this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Cidade Inválida', true));
      $this->redirect(array("action" => "admin_index"));
		}
		$this->set('cidade', $this->Cidade->read(null, $id));
	}

	function admin_add() {
	  $this->set("title_for_layout","Cidades &raquo; Nova Cidade");
	  $this->layout = 'admin';
		if (!empty($this->data)) {
			$this->Cidade->create();
			if ($this->Cidade->save($this->data)) {
				$this->Session->setFlash(__('Cidade salva.', true));
        $this->redirect(array("action" => "admin_index"));
			} else {
			}
		}
	}

	function admin_edit($id = null) {
	  $this->set("title_for_layout","Cidades &raquo; Editar Cidade");  
	  $this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->flash(__('Cidade Inválida', true));
		}
		if (!empty($this->data)) {
			if ($this->Cidade->save($this->data)) {
				$this->Session->setFlash(__('A cidade foi salva.', true));
        $this->redirect(array("action" => "admin_index"));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cidade->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Cidade Inválida', true));
      $this->redirect(array("action" => "admin_index"));
		}
		if ($this->Cidade->delete($id)) {
			$this->Session->setFlash(__('Cidade excluída', true));
      $this->redirect(array("action" => "admin_index"));
		}
	}
}
?>