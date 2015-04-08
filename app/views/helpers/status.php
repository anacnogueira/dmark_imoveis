<?php
  class StatusHelper extends AppHelper{
    function showCurrentStatus($table,$field,$status,$id){
      /*if(!empty($table) and !empty($field) and !empty($status) and !empty($id)){
        if($status == 'S'){
          $out = '<img src="img/icon_status_greeen.gif" alt="" />';
          $out .= '<a href="/statusChange/table:$table/field:$field/status:N/id:$id">
                  <img src="/img/icon_status_red_light.gif" alt="Desativar" /><a/>';
        } else if($status == 'N'){
          $out = '<a href="/statusChange/table:$table/field:$field/$status:S/id:$id">
                  <img src="/img/icon_status_red_light.gif" alt=Ativar" /><a/>';
          $out .= '<img src="img/icon_status_red.gif" alt="" />';
        }
      }
      else{
       trigger_error(sprintf('No comments found',get_class($this)),E_USER_NOTICE);
      }


       return $this->output($out); */
    }

    function changeStatus($table,$field,$status,$id){
     if(!empty($table) and !empty($field) and !empty($status) and !empty($id)){
      $this->query("UPDATE $table SET $field='$status' WHERE id='$id'");
      $this->redirect($this->referer());
     }
    }
  }
?>
