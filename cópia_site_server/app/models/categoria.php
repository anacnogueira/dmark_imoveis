<?php
class Categoria extends AppModel {

	var $name = 'Categoria';
  var $validate = array(
    'name'=>array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Informe o nome da categoria'
    )
  );
}
?>