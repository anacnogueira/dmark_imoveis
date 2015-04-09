<div class="categorias index">
<h2><?php __('Categorias');?></h2>
<div class="filtro">
     <?php echo $form->create(array('inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false))); ?>
     <table class="none">
    <tr>
      <td><label for="CategoriaName">Nome:</label></td>
      <td><?php echo $form->input('name'); ?></td>
      <td><label for="CategoriaQtde">Exibir:</label></td>
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
		<li><?php echo $html->link(__('Nova Categoria', true), array('action' => 'admin_add')); ?></li>
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
foreach ($categorias1 as $categoria):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td><?php echo $categoria['Categoria']['id']; ?></td>
		<td><?php echo $categoria['Categoria']['name']; ?></td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action' => 'admin_view', $categoria['Categoria']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action' => 'admin_edit', $categoria['Categoria']['id'])); ?>
			<?php echo $html->link(__('Excluir', true), array('action' => 'admin_delete', $categoria['Categoria']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $categoria['Categoria']['id'])); ?>
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

