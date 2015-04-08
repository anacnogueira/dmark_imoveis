<?php
class StatusController extends AppController {


	var $name = 'Status';
  var $uses = array('Usuario','Imovel');

	function admin_change() {
	  print_r($this->passedArgs);
    $table = $this->passedArgs["table"];
    $field = $this->passedArgs["field"];
    $status = $this->passedArgs["status"];
    $id = $this->passedArgs["id"];
    $this->autoRender = false;
    if(!empty($table) and !empty($field) and !empty($status) and !empty($id)){
      $type = substr(ucfirst($table),0,strlen($table)-1);
      $this->$type->query("UPDATE $table SET $field='$status' WHERE id='$id'");
      $this->redirect($this->referer());
    }
  }
}
?>