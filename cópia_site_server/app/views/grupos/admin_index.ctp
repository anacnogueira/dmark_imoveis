<div class="grupos index">
	<h2><?php __('Grupos');?></h2>
  <div class="filtro">
     <?php echo $form->create(array('inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false))); ?>
     <table class="none">
    <tr>
      <td>Nome:</td>
      <td><?php echo $form->input('name'); ?></td>
      <td>Exibir:</td>
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
		<li><?php echo $this->Html->link(__('Novo Grupo', true), array('action' => 'admin_add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar Usuários', true), array('controller' => 'usuarios', 'action' => 'admin_index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo Usuario', true), array('controller' => 'usuarios', 'action' => 'admin_add')); ?> </li>
	</ul>
</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('ID','id');?></th>
			<th><?php echo $this->Paginator->sort('NOME','name');?></th>
			<th class="actions"><?php __('AÇÔES');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($grupos as $grupo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $grupo['Grupo']['id']; ?>&nbsp;</td>
		<td><?php echo $grupo['Grupo']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'admin_view', $grupo['Grupo']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'admin_edit', $grupo['Grupo']['id'])); ?>
			<?php echo $this->Html->link(__('Excluir', true), array('action' => 'admin_delete', $grupo['Grupo']['id']), null, sprintf(__('Tem certeza de que deseja excluir o registro # %s?', true), $grupo['Grupo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>


	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('Anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('Próximo', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
