<div class="grupos form">
<h2>Adicionar Grupo</h2>
<?php echo $this->Form->create('Grupo');?>
<p>Os campos com * são obrigatórios</p>
	<fieldset>
		<legend><?php __('Informações'); ?></legend>
	<?php
		echo $this->Form->input('name',array('label'=>'Nome:*'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>
<div class="actions">
	<h3><?php __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Grupos', true), array('action' => 'admin_index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Usuários', true), array('controller' => 'usuarios', 'action' => 'admin_index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo Usuário', true), array('controller' => 'usuarios', 'action' => 'admin_add')); ?> </li>
	</ul>
</div>