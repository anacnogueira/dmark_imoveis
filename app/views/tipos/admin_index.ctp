<div class="tipos index">
<h2><?php __('Tipos');?></h2>
<div class="filtro">
     <?php echo $form->create(array('inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false))); ?>
     <table class="none">
    <tr>
      <td><label for="TipoName">Nome:</label></td>
      <td><?php echo $form->input('name'); ?></td>
      <td><label for="TipoQtde">Exibir:</label></td>
      <td>
        <?php echo $form->input('qtde',array('type'=>'select','options'=>$qtde,'default'=>1)); ?>
         <?php echo $form->submit('Pesquisar',array('div'=>false)); ?>
      </td>
    </tr>
  </table>
  </form>
  </div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Novo Tipo', true), array('action' => 'admin_add')); ?></li>
	</ul>
</div>  
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('ID','id');?></th>
	<th><?php echo $paginator->sort('NOME','name');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($tipos1 as $tipo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td><?php echo $tipo['Tipo']['id']; ?></td>
		<td><?php echo $tipo['Tipo']['name']; ?></td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action' => 'admin_view', $tipo['Tipo']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action' => 'admin_edit', $tipo['Tipo']['id'])); ?>
			<?php echo $html->link(__('Excluir', true), array('action' => 'admin_delete', $tipo['Tipo']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $tipo['Tipo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('Próximo', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>

