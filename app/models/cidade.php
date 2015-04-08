<?php
class Cidade extends AppModel {

	var $name = 'Cidade';
  var $hasMany = array('Bairro');
  var $validate = array(
    'name'=>array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Informe o nome da cidade'
    )
  );
}
?>