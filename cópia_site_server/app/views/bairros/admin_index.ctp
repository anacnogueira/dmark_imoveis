<div class="bairros index">
<h2><?php __('Bairros');?></h2>
<div class="filtro">
     <?php echo $form->create(array('inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false))); ?>
     <table class="none">
    <tr>
      <td><label for="BairroName">Nome:</label></td>
      <td><?php echo $form->input('name'); ?></td>
      <td><label for="BairroCidade">Cidade:</label></td>
      <td><?php echo $form->input('cidade'); ?></td>
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
		<li><?php echo $html->link(__('Novo Bairro', true), array('action' => 'admin_add')); ?></li>
	</ul>
</div>  
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('ID','id');?></th>
	<th><?php echo $paginator->sort('NOME','name');?></th>
	<th><?php echo $paginator->sort('CIDADE','Cidade.name');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
//echo debug($bairros1);
foreach ($bairros1 as $bairro):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td><?php echo $bairro['Bairro']['id']; ?></td>
		<td><?php echo $bairro['Bairro']['name']; ?></td>
		<td><?php echo $bairro['Cidade']['name']; ?></td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action' => 'admin_view', $bairro['Bairro']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action' => 'admin_edit', $bairro['Bairro']['id'])); ?>
			<?php echo $html->link(__('Excluir', true), array('action' => 'admin_delete', $bairro['Bairro']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $bairro['Bairro']['id'])); ?>
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

