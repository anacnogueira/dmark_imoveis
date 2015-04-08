<div class="tipos view">
<h2><?php  __('Tipo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipo['Tipo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipo['Tipo']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Tipo', true), array('action' => 'admin_edit', $tipo['Tipo']['id'])); ?> </li>
		<li><?php echo $html->link(__('Excluir Tipo', true), array('action' => 'admin_delete', $tipo['Tipo']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $tipo['Tipo']['id'])); ?> </li>
		<li><?php echo $html->link(__('Listar Tipos', true), array('action' => 'admin_index')); ?> </li>
		<li><?php echo $html->link(__('Novo Tipo', true), array('action' => 'admin_add')); ?> </li>
	</ul>
</div>
