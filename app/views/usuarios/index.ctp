<div class="usuarios index">
<h2><?php __('Usuarios');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('nome');?></th>
	<th><?php echo $paginator->sort('email');?></th>
	<th><?php echo $paginator->sort('cpf');?></th>
	<th><?php echo $paginator->sort('telefone');?></th>
	<th><?php echo $paginator->sort('celular');?></th>
	<th><?php echo $paginator->sort('cep');?></th>
	<th><?php echo $paginator->sort('endereco');?></th>
	<th><?php echo $paginator->sort('complemento');?></th>
	<th><?php echo $paginator->sort('bairro');?></th>
	<th><?php echo $paginator->sort('cidade');?></th>
	<th><?php echo $paginator->sort('estado');?></th>
	<th><?php echo $paginator->sort('data_nascimento');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($usuarios as $usuario):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $usuario['Usuario']['id']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['nome']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['email']; ?>
		</td>

		<td>
			<?php echo $usuario['Usuario']['cpf']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['telefone']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['celular']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['cep']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['endereco']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['complemento']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['bairro']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['cidade']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['estado']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['data_nascimento']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['created']; ?>
		</td>
		<td>
			<?php echo $usuario['Usuario']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $usuario['Usuario']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $usuario['Usuario']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $usuario['Usuario']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usuario['Usuario']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Usuario', true), array('action' => 'add')); ?></li>
	</ul>
</div>
