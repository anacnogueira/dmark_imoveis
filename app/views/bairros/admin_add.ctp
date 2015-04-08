<div class="bairros form">
<h2>Adicionar Bairro</h2>
<p>Os campos com * são obrigatórios</p>
<?php echo $form->create('Bairro');?>
	<fieldset>
 		<legend><?php __('Informações');?></legend>
	<?php
  		echo $form->input('name',array('label'=>'Nome:'));
		echo $form->input('cidade_id',array('label'=>'Cidade:'));
	?>
	</fieldset>
<?php echo $form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Bairros', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
