<?php
  class Contato extends AppModel{
    var $useTable = false;
    var $_schema = array(
    'nome'   =>array('type'=>'string', 'length'=>100),
    'email'		=>array('type'=>'string', 'length'=>255),
    'telefone' => array('type'=>'string','length'=>13),
    'mensagem'	=>array('type'=>'text')
    );
   var $validate = array(
    'nome' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'Informe seu nome'
      )
    ),
    'email' => array(
      'email' => array(
      'rule' => 'email',
      'message' => 'Endereço de e-mail inválido'
      ),
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Informe seu e-mail'
      )
    ),
    'telefone' => array(
      'custom' => array(
       'rule' => array('custom', '/^\([0-9]{2}\)[0-9]{4}-[0-9]{4}$/'),
       'message' => 'Informe o telefone corretamente')
      ),
    'mensagem'=>array(
      'rule'=>'notEmpty',
      'required'=>true,
      'message'=>'Informe o texto da mensagem'
    )
  );

  }
?>