<div class="fotos form">
<?php echo $form->create('Foto');?>
	<fieldset>
 		<legend><?php __('Add Foto');?></legend>
	<?php
		echo $form->input('imovel_id');
		echo $form->input('foto');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Fotos', true), array('action' => 'index'));?></li>
	</ul>
</div>
