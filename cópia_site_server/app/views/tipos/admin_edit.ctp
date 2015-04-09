<div class="tipos form">
<h2>Editar Tipo</h2>
<?php echo $form->create('Tipo');?>
	<fieldset>
 		<legend><?php __('Informações');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name',array('label'=>'Nome:'));
	?>
	</fieldset>
<?php echo $form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Excluir', true), array('action' => 'admin_delete', $form->value('Tipo.id')), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $form->value('Tipo.id'))); ?></li>
		<li><?php echo $html->link(__('Listar Tipos', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
