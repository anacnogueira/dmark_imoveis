<?php
/* Grupos Test cases generated on: 2011-06-01 17:04:11 : 1306958651*/
App::import('Controller', 'Grupos');

class TestGruposController extends GruposController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class GruposControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.grupo', 'app.usuario', 'app.imovel', 'app.tipo', 'app.categoria', 'app.bairro', 'app.cidade', 'app.foto');

	function startTest() {
		$this->Grupos =& new TestGruposController();
		$this->Grupos->constructClasses();
	}

	function endTest() {
		unset($this->Grupos);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>