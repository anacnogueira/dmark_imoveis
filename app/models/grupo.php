<?php
class Grupo extends AppModel {
	var $name = 'Grupo';
 
  var $hasMany = array('Usuario');
	var $validate = array(
	 'name' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Prrencha o nome do grupo',
				'allowEmpty' => false,
				'required' => true
			),
		),
	);


}
?>