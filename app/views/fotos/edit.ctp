<div class="fotos form">
<?php echo $form->create('Foto');?>
	<fieldset>
 		<legend><?php __('Edit Foto');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('imovel_id');
		echo $form->input('foto');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Foto.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Foto.id'))); ?></li>
		<li><?php echo $html->link(__('List Fotos', true), array('action' => 'index'));?></li>
	</ul>
</div>
