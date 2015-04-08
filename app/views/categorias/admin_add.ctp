<div class="categorias form">
 <h2>Adicionar Categoria</h2>
<?php echo $form->create('Categoria');?>
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
		<li><?php echo $html->link(__('Listar Categorias', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
