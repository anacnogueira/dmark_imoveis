<div class="bairros view">
<h2><?php  __('Bairro');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bairro['Bairro']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bairro['Bairro']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cidade:'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bairro['Cidade']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Bairro', true), array('action' => 'admin_edit', $bairro['Bairro']['id'])); ?> </li>
		<li><?php echo $html->link(__('Excluir Bairro', true), array('action' => 'admin_delete', $bairro['Bairro']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $bairro['Bairro']['id'])); ?> </li>
		<li><?php echo $html->link(__('Listar Bairros', true), array('action' => 'admin_index')); ?> </li>
		<li><?php echo $html->link(__('Novo Bairro', true), array('action' => 'admin_add')); ?> </li>
	</ul>
</div>
