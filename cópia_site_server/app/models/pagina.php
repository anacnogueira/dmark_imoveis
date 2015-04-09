<?php
class Pagina extends AppModel {

	var $name = 'Pagina';
  var $validate = array(
    'name'=>array(
     'rule'=>'notEmpty',
     'required'=>true,
     'message'=>'Informe o nome da página'
    ),
    'titulo'=>array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Informe o título da página'
    ),
    'content'=>array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Informe o contéudo da página'
    )
  );
}
?>