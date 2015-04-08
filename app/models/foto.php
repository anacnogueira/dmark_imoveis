<?php
class Foto extends AppModel {

	var $name = 'Foto';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Imovel' => array(
			'className' => 'Imovel',
			'foreignKey' => 'imovel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>