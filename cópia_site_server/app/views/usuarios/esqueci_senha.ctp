<?php $script = $html->css(array('login_admin')); ?>
<?php echo $this->addScript('scripts_for_layout',$script); ?>
<div class='space'>&nbsp;</div>
<h1>Esqueci a senha</h1>
<?php echo $session->flash(); ?>
<div class="login form">
<?php
 echo $form->create('Usuario')."\n";
 echo $form->input('email',array('label'=>'E-mail:'))."\n";
 echo $form->end('OK')."\n";  
?>
</div>
<?php if(isset($msg)): ?>
<p><?php echo $msg ?></p>
<?php endif; ?>