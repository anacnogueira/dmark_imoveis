<?php $script = $html->css(array('login_admin'));  ?>
<?php echo $this->addScript('scripts_for_layout',$script); ?>
<div class='space'>&nbsp;</div>
<?php
if(isset($msg))
  echo '<p>'.$msg.'</p>';

?>
<div class="login form">
<h2>Esqueci a senha</h2>
<?php
 echo $form->create('Usuario')."\n";
 echo $form->input('email',array('label'=>'E-mail:'))."\n";
 echo $form->end('OK')."\n";
?>
</div>
<p><?php echo $html->link('Login','/admin/login'); ?></p>