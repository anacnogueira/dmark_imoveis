<?php
  $script = $html->css(array('login_admin'));
  if($type){
    $link = '/admin/usuarios/esqueci_senha/';
  }
  else
   $link = '/usuarios/esqueci_senha/';
?>
<?php echo $this->addScript('scripts_for_layout',$script); ?>
<div class='space'>&nbsp;</div>
<?php echo $session->flash(); ?>
<div class="login form">
 <?php echo $form->create('Usuario',array('url'=>'/usuarios/login/'.$type))."\n"; ?>
 <?php
  echo $form->input('username',array('label'=>'E-mail:','size'=>40));
  echo $form->input('senha',array('label'=>'Senha:','type'=>'password','size'=>40,'maxlength'=>15));
  echo $form->end('Enviar');
 ?>
</div>
<p><?php echo $html->link('Esqueci a senha',$link); ?></p>