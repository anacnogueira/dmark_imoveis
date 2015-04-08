<div class="usuarios index">
<h2><?php __('Usuários');?></h2>
<div class="filtro">
  <?php echo $form->create(array('inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false))); ?>
  <table class="none">
    <tr>
      <td>Nome:</td>
      <td><?php echo $form->input('nome'); ?></td>
      <td>Grupo:</td>
      <td><?php echo $form->input('grupo'); ?></td>
    </tr>
    <tr>
      <td>Status:</td>
      <td><?php echo $form->input('ativo',array('type'=>'select','options'=>$status)); ?></td>
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
		<li><?php echo $html->link(__('Novo Usuário', true), array('action' => 'admin_add')); ?></li>
	</ul>
</div>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('ID','id');?></th>
	<th><?php echo $paginator->sort('NOME','nome');?></th>
	<th><?php echo $paginator->sort('E-MAIL','email');?></th>
  <th><?php echo $paginator->sort('GRUPO','Grupo.name'); ?></th>
  <th>Status</th>
	<th class="actions"><?php __('Ações');?></th>
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
		<td><?php echo $usuario['Usuario']['id']; ?></td>
		<td><?php echo $usuario['Usuario']['nome']; ?></td>
		<td><?php echo $usuario['Usuario']['email']; ?></td>
    <td><?php echo $usuario['Grupo']['name']; ?></td>
		<td><?php echo $statuso->showCurrentStatus('usuarios','ativo',$usuario['Usuario']['ativo'],$usuario['Usuario']['id']); ?></td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action' => 'admin_view', $usuario['Usuario']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action' => 'admin_edit', $usuario['Usuario']['id'])); ?>
			<?php echo $html->link(__('Excluir', true), array('action' => 'admin_delete', $usuario['Usuario']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $usuario['Usuario']['id'])); ?>
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

