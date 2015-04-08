<?php
class GruposController extends AppController {

	var $name = 'Grupos';

  /* ADMIN */
	function admin_index() {

	  $this->layout = 'admin';
		$this->Grupo->recursive = 0;
		//Filtrar condições
    $conditions = array();
    if(empty($this->data))
     $index_qtde = 1;
    else
     $index_qtde  = $this->data['Grupo']['qtde'];

    if(!empty($this->data['Grupo']['name'])){
      $conditions['name LIKE'] = '%'.$this->data['Grupo']['name'].'%';
    }

    $this->paginate['Grupo'] = array(
      'limit'=>$this->qtde[$index_qtde],
      'conditions' => array($conditions),
      'fields' => array('Grupo.*'));

    $grupos = $this->paginate('Grupo');
    $this->set(compact('grupos'));
	}

	function admin_view($id = null) {
	  $this->set("title_for_layout","Grupos &raquo; Ver");
	  $this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Grupo inválido', true));
			$this->redirect(array('action' => 'admin_index'));
		}
		$this->set('grupo', $this->Grupo->read(null, $id));
	}

	function admin_add() {
	  $this->set("title_for_layout","Grupos &raquo; Novo Grupo");
	  $this->layout = 'admin';
		if (!empty($this->data)) {
		  $this->Grupo->set($this->data);
      if($this->Grupo->validates()){
        $this->Grupo->create();
			  if ($this->Grupo->save($this->data)) {
				  $this->Session->setFlash(__('O grupo foi salvo', true));
				  $this->redirect(array('action' => 'admin_index'));
			  } else {
				  $this->Session->setFlash(__('O grupo não pode ser salvo. Por favor, tente novamente.', true));
			  }
      }

		}
	}

	function admin_edit($id = null) {
	  $this->set("title_for_layout","Grupos &raquo; Editar Grupo ");
	  $this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Grupo inválido', true));
			$this->redirect(array('action' => 'admin_index'));
		}
		if (!empty($this->data)) {
		  $this->Grupo->set($this->data);
		  if($this->Grupo->validates()){
        if ($this->Grupo->save($this->data)) {
				  $this->Session->setFlash(__('O grupo foi salvo', true));
				  $this->redirect(array('action' => 'admin_index'));
			  } else {
				  $this->Session->setFlash(__('O grupo não pode ser salvo. Por favor, tete novamente.', true));
			  }
      }
		}
		if (empty($this->data)) {
			$this->data = $this->Grupo->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Identificação inválida para o grupo', true));
			$this->redirect(array('action'=>'admin_index'));
		}
		if ($this->Grupo->delete($id)) {
			$this->Session->setFlash(__('Grupo excluído', true));
			$this->redirect(array('action'=>'admin_index'));
		}
		$this->Session->setFlash(__('Grupo was not deleted', true));
		$this->redirect(array('action' => 'admin_index'));
	}
}
?>