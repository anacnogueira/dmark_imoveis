<div class="usuario form">
 <h1>Alterar senha usuário</h1>
 <?php echo $session->flash(); ?>
 <?php echo $form->create('Usuario');?>
 <?php echo $form->input('senhaAtual',array('label'=>'Senha Atual:','type'=>'password')); ?>
 <?php echo $form->input('password1',array('label'=>'Nova Senha:','type'=>'password')); ?>
 <?php echo $form->input('password2',array('label'=>'Redigite a nova senha:','type'=>'password')); ?>
<?php echo $form->end('Enviar');?>
</div>
