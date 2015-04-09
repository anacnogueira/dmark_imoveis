<?php
class TiposController extends AppController {

	var $name = 'Tipos';
	var $helpers = array('Html', 'Form');

  /*----- ADMIN -----*/
	function admin_index() {
	  $this->set("title_for_layout","Tipos");
	  $this->layout = 'admin';
		$this->Tipo->recursive = 0;
		//Filtrar condições
    $conditions = array();
    if(empty($this->data))
     $index_qtde = 1;
    else
     $index_qtde  = $this->data['Tipo']['qtde'];

    if(!empty($this->data['Tipo']['name'])){
      $conditions['name LIKE'] = '%'.$this->data['Tipo']['name'].'%';
    }

    $this->paginate['Tipo'] = array(
      'limit'=>$this->qtde[$index_qtde],
      'conditions' => array($conditions),
      'fields' => array('Tipo.*'));

    $tipos1 = $this->paginate('Tipo');
    $this->set(compact('tipos1'));
	}

	function admin_view($id = null) {
	  $this->set("title_for_layout","Tipos &raquo; Ver");
	  $this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Tipo Inválido', true));
      $this->redirect(array("action" => "admin_index"));
		}
		$this->set('tipo', $this->Tipo->read(null, $id));
	}

	function admin_add() {
	  $this->set("title_for_layout","Tipos &raquo; Novo Tipo");
	  $this->layout = 'admin';
		if (!empty($this->data)) {
			$this->Tipo->create();
			if ($this->Tipo->save($this->data)) {
				$this->Session->setFlash(__('Tipo salvo.', true));
        $this->redirect(array("action" => "admin_index"));
			} else {
			}
		}
	}

	function admin_edit($id = null) {
	  $this->set("title_for_layout","Tipos &raquo; Editar Tipo"); 
	  $this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Tipo Inválido', true));
      $this->redirect(array("action" => "admin_index"));
		}
		if (!empty($this->data)) {
			if ($this->Tipo->save($this->data)) {
				$this->Session->setFlash(__('O tipo foi salvo.', true));
        $this->redirect(array("action" => "admin_index"));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tipo->read(null, $id);
		}
	}

	function admin_delete($id = null) {
	  $this->layout = 'admin';
		if (!$id) {
			$this->flash(__('Tipo Inválido', true));
      $this->redirect(array("action" => "admin_index"));
		}
		if ($this->Tipo->delete($id)) {
			$this->flash(__('Tipo excluído', true));
      $this->redirect(array("action" => "admin_index"));
		}
	}

}
?>