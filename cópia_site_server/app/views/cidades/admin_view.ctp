<div class="cidades view">
<h2><?php  __('Cidade');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cidade['Cidade']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cidade['Cidade']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Cidade', true), array('action' => 'admin_edit', $cidade['Cidade']['id'])); ?> </li>
		<li><?php echo $html->link(__('Excluir Cidade', true), array('action' => 'admin_delete', $cidade['Cidade']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $cidade['Cidade']['id'])); ?> </li>
		<li><?php echo $html->link(__('Listar Cidades', true), array('action' => 'admin_index')); ?> </li>
		<li><?php echo $html->link(__('Nova Cidade', true), array('action' => 'admin_add')); ?> </li>
	</ul>
</div>
