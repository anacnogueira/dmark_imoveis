<div class="fotos view">
<h2><?php  __('Foto');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $foto['Foto']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imovel Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $foto['Foto']['imovel_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Foto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $foto['Foto']['foto']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Foto', true), array('action' => 'edit', $foto['Foto']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Foto', true), array('action' => 'delete', $foto['Foto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $foto['Foto']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Fotos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Foto', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
