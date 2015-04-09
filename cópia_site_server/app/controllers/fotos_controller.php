<?php
class FotosController extends AppController {

	var $name = 'Fotos';
	var $helpers = array('Html', 'Form');

	function index() {
	  $this->layout = 'admin';
		$this->Foto->recursive = 0;
		$this->set('fotos', $this->paginate());
	}

	function view($id = null) {
	  $this->layout = 'admin';
		if (!$id) {
			$this->flash(__('Invalid Foto', true), array('action'=>'index'));
		}
		$this->set('foto', $this->Foto->read(null, $id));
	}

	function add() {
	  $this->layout = 'admin';
		if (!empty($this->data)) {
			$this->Foto->create();
			if ($this->Foto->save($this->data)) {
				$this->flash(__('Foto saved.', true), array('action'=>'index'));
        $this->redirect(array("action" => "index"));
			} else {
			}
		}
		$imovels = $this->Foto->Imovel->find('list');
		$this->set(compact('imovels'));
	}

	function edit($id = null) {
	  $this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Foto', true), array('action'=>'index'));
      $this->redirect(array("action" => "index"));
		}
		if (!empty($this->data)) {
			if ($this->Foto->save($this->data)) {
				$this->flash(__('The Foto has been saved.', true), array('action'=>'index'));
        $this->redirect(array("action" => "index"));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Foto->read(null, $id);
		}
		$imovels = $this->Foto->Imovel->find('list');
		$this->set(compact('imovels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Foto', true), array('action'=>'index'));
		}
		if ($this->Foto->del($id)) {
			$this->flash(__('Foto deleted', true), array('action'=>'index'));
      $this->redirect(array("action" => "index"));   
		}
	}

}
?>