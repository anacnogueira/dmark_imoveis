<div class="grupos view">
<h2><?php  __('Grupo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grupo['Grupo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grupo['Grupo']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php __('Usuários Relacionados');?></h3>
  <div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Novo Usuário', true), array('controller' => 'usuarios', 'action' => 'admin_add'));?> </li>
		</ul>
	</div>
	<?php if (!empty($grupo['Usuario'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('ID'); ?></th>
		<th><?php __('NOME'); ?></th>
		<th><?php __('E-MAIL'); ?></th>
		<th><?php __('STATUS'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($grupo['Usuario'] as $usuario):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $usuario['id'];?></td>
			<td><?php echo $usuario['nome'];?></td>
			<td><?php echo $usuario['email'];?></td>
			<td><?php echo $usuario['ativo'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver', true), array('controller' => 'usuarios', 'action' => 'admin_view', $usuario['id'])); ?>
				<?php echo $this->Html->link(__('Editar', true), array('controller' => 'usuarios', 'action' => 'admin_edit', $usuario['id'])); ?>
				<?php echo $this->Html->link(__('Excluir', true), array('controller' => 'usuarios', 'action' => 'admin_delete', $usuario['id']), null, sprintf(__('Tem certeza de que deseja excluir o registro # %s?', true), $usuario['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
 <div class="actions">

	<ul>
		<li><?php echo $this->Html->link(__('Editar Grupo', true), array('action' => 'admin_edit', $grupo['Grupo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir Grupo', true), array('action' => 'admin_delete', $grupo['Grupo']['id']), null, sprintf(__('Tem certeza de que deseja excluir o registro # %s?', true), $grupo['Grupo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Grupos', true), array('action' => 'admin_index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo Grupo', true), array('action' => 'admin_add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Usuários', true), array('controller' => 'usuarios', 'action' => 'admin_index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo Usuário', true), array('controller' => 'usuarios', 'action' => 'admin_add')); ?> </li>
	</ul>
</div>

</div>
