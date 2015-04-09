<?php if(isset($imovels) and is_array($imovels)): ?>
  <div class="actions">
	<ul>
		<li><?php echo $html->link(__('Novo Imóvel', true), array('action' => 'adicionar')); ?></li>
	</ul>
</div>
<br />
<div class="imoveis index">
  <table cellpadding="1" cellspacing="1">
<tr>
	<th><?php echo $paginator->sort('ID','Imovel.id');?></th>
	<th><?php echo $paginator->sort('Descrição','Imovel.descricao');?></th>
  <th><?php echo $paginator->sort('Cidade','Cidade.name');?></th>
  <th><?php echo $paginator->sort('Bairro','Bairro.name');?></th>
  <th><?php echo $paginator->sort('Valor','valor');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php foreach ($imovels as $imovel): ?>
	<tr>
		<td><?php echo $imovel['Imovel']['id']; ?></td>
		<td><?php echo $imovel['Imovel']['descricao']; ?></td>
    <td><?php echo $imovel['Cidade']['name']; ?></td>
		<td><?php echo $imovel['Bairro']['name']; ?></td>
    <td><?php echo $imovel['Imovel']['valor']; ?></td>
		<td class="actions">

			<?php echo $html->link(__('Alterar', true), array('action' => 'editar', $imovel['Imovel']['id'])); ?>
			<?php echo $html->link(__('Excluir', true), array('action' => 'excluir', $imovel['Imovel']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $imovel['Imovel']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<div class="pag">
	<?php echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('Próximo', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
</div>
<?php endif; ?>
