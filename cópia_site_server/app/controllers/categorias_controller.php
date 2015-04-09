<?php
class CategoriasController extends AppController {

	var $name = 'Categorias';
	var $helpers = array('Html', 'Form');

	function admin_index() {
	  $this->set("title_for_layout","Categorias");
	  $this->layout = 'admin';
		$this->Categoria->recursive = 0;
		//Filtrar condições
    $conditions = array();
    if(empty($this->data))
     $index_qtde = 1;
    else
     $index_qtde  = $this->data['Categoria']['qtde'];

    if(!empty($this->data['Categoria']['name'])){
      $conditions['name LIKE'] = '%'.$this->data['Categoria']['name'].'%';
    }

    $this->paginate['Categoria'] = array(
      'limit'=>$this->qtde[$index_qtde],
      'conditions' => array($conditions),
      'fields' => array('Categoria.*'));

    $categorias1 = $this->paginate('Categoria');
    $this->set(compact('categorias1'));
	}

	function admin_view($id = null) {
	  $this->set("title_for_layout","Categorias &raquo; Ver");
	  $this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Categoria Inválida', true));
      $this->redirect(array("action" => "admin_index"));
		}
		$this->set('categoria', $this->Categoria->read(null, $id));
	}

	function admin_add() {
	  $this->set("title_for_layout","Categorias &raquo; Nova Categoria");
	  $this->layout = 'admin';
		if (!empty($this->data)) {
		  $this->Categoria->set($this->data);
      if($this->Categoria->validates()){
			  $this->Categoria->create();
			  if ($this->Categoria->save($this->data)) {
				  $this->Session->setFlash(__('Categoria salva.', true));
          $this->redirect(array("action" => "admin_index"));
			  }
      }
		}
	}

	function admin_edit($id = null) {
	  $this->set("title_for_layout","Categorias &raquo; Editar Categoria");
	  $this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Categoria Inválida', true));
      $this->redirect(array("action" => "admin_index"));
		}
		if (!empty($this->data)) {
			if ($this->Categoria->save($this->data)) {
				$this->flash(__('A categoria foi salva.', true));
        $this->redirect(array("action" => "admin_index"));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Categoria->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Categoria Inválida', true));
		}
		if ($this->Categoria->delete($id)) {
			$this->Session->setFlash(__('Categoria excluída', true));
      $this->redirect(array("action" => "admin_index"));   
		}
	}

}
?>