<?php
class Imovel extends AppModel {

	var $name = 'Imovel';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Tipo' => array(
			'className' => 'Tipo',
			'foreignKey' => 'tipo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Categoria' => array(
			'className' => 'Categoria',
			'foreignKey' => 'categoria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Bairro' => array(
			'className' => 'Bairro',
			'foreignKey' => 'bairro_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Foto' => array(
			'className' => 'Foto',
			'foreignKey' => 'imovel_id',
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
    'descricao'=>array(
      'rule'=>'notEmpty',
      'requred'=>true,
      'message'=>'Informe a descrição do imóvel'
    ),
    'cidade_id' => array(
      'rule' => array('naoVazio'),
       'required'=>true,
      'message' => 'Selecione a cidade'
    ),
    'bairro_id' => array(
      'rule' => array('naoVazio'),
      'required' => true,
      'message' => 'Selecione o bairro'
    ),
    'valor' => array(
      'rule' => 'notEmpty',
      'required'=>true,
      'message' => 'Informe o valor do imóvel'
    ),
    'status'=>array(
      'rule'=>array('inList', array('S', 'N')),
      'message'=>'Informe o status do imóvel'
    ),
    'destaque'=>array(
      'rule'=>array('inList', array('S', 'N')),
      'message'=>'Informe se o imóvel irá aparecer na página inicial'));

  function naoVazio($field=array()){
    foreach( $field as $key => $value ){

      if($key == 'cidade_id' or $key == 'bairro_id'){

        if(!empty($value))
          return true;

        return false;
      }
    }
  }
}
?>