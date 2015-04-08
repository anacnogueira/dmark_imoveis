<?php
class Bairro extends AppModel {

	var $name = 'Bairro';
  var $belongsTo = array('Cidade');
  var $validate = array(
    'name'=>array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Informe o nome do bairro'
    ),
    'cidade_id'=>array(
     'rule'=>array('naoVazio'),
     'required'=>true,
     'message'=>'Selecione a cidade'
    ));

  function naoVazio($field=array()){
    foreach( $field as $key => $value ){

      if($key == 'cidade_id'){

        if(!empty($value))
          return true;

        return false;
      }
    }
  }
}
?>