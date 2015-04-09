<div class="cidades form">
<h2>Adicionar Cidade</h2>
<?php echo $form->create('Cidade');?>
	<fieldset>
 		<legend><?php __('Informações');?></legend>
	<?php
		echo $form->input('name',array('label'=>'Nome:'));
	?>
	</fieldset>
<?php echo $form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Cidades', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
