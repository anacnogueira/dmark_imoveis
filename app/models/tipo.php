<?php
class Tipo extends AppModel {

	var $name = 'Tipo';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Imovel' => array(
			'className' => 'Imovel',
			'foreignKey' => 'tipo_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

  var $validate = array(
    'name'=>array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Informe o tipo do imóvel'
    )
  );
}
?>