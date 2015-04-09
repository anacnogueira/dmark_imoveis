<?php
/* Grupo Test cases generated on: 2011-06-01 17:01:42 : 1306958502*/
App::import('Model', 'Grupo');

class GrupoTestCase extends CakeTestCase {
	var $fixtures = array('app.grupo', 'app.usuario', 'app.imovel', 'app.tipo', 'app.categoria', 'app.bairro', 'app.cidade', 'app.foto');

	function startTest() {
		$this->Grupo =& ClassRegistry::init('Grupo');
	}

	function endTest() {
		unset($this->Grupo);
		ClassRegistry::flush();
	}

}
?>