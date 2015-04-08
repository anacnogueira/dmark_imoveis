<div class="grupos form">
<h2>Editar Grupo</h2>
<?php echo $this->Form->create('Grupo');?>
<p>Os campos com * são obrigatórios</p>
	<fieldset>
		<legend><?php __('Informações'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Nome:*'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>
<div class="actions">
	<h3><?php __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Excluir', true), array('action' => 'admin_delete', $this->Form->value('Grupo.id')), null, sprintf(__('Tem certeza de que deseja excluir o registro # %s?', true), $this->Form->value('Grupo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Grupos', true), array('action' => 'admin_index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Usuários', true), array('controller' => 'usuarios', 'action' => 'admin_index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo Usuário', true), array('controller' => 'usuarios', 'action' => 'admin_add')); ?> </li>
	</ul>
</div>