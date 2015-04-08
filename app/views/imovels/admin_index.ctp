<?php
$script = $javascript->link(array('jquery.selects','jquery.numeric','jquery.price_format.1.3',
  'jquery.maskedinput','mascara_campo','get_bairros'))."\n";
  echo $this->addScript('scripts_for_layout',$script);
?>
<div class="imoveis index">
<h2><?php __('Imóveis');?></h2>
<div class="filtro">
  <?php echo $form->create(array('inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false))); ?>
  <table class="none" border="1">
    <tr>
      <td><label for="ImovelDescricao">Descrição:</label></td>
      <td><?php echo $form->input('descricao'); ?></td>
      <td><label for="ImovelTipoId">Tipo:</label></td>
      <td><?php echo $form->input('tipo_id',array('empty'=>'Todos')); ?></td>
      <td><label for="ImovelCategoriaId">Categoria:</label></td>
      <td><?php echo $form->input('categoria_id',array('empty'=>'Todos')); ?></td>
    </tr>
    <tr>
      <td><label for="ImovelAreaTerreno">Área Terreno:</label></td>
      <td><?php echo $form->input('area_terreno',array('class'=>'custom','size'=>'10')); ?></td>
      <td><label for="ImovelAreaConstruida">Área Construída:</label></td>
      <td><?php echo $form->input('area_construida',array('class'=>'custom','size'=>'10')); ?></td>
      <td><label for="ImovelDorms">Dormitórios:</label></td>
      <td><?php echo $form->input('dorms',array('class'=>'custom onlyNumbers','size'=>'5')); ?></td>
    </tr>

    <tr>
      <td><label for="ImovelSuites">Suítes:</label></td>
      <td><?php echo $form->input('suites',array('class'=>'custom onlyNumbers','size'=>'5')); ?></td>
      <td><label for="ImovelBanheiros">Banheiros:</label></td>
      <td><?php echo $form->input('banheiros',array('class'=>'custom onlyNumbers','size'=>'5'));?></td>
      <td><label for="ImovelSala">Sala:</label></td>
      <td><?php echo $form->input('sala',array('class'=>'custom onlyNumbers','size'=>'5'));?></td>
    </tr>
    <tr>
    <td><label for="ImovelGaragem">Garagem:</label></td>
    <td><?php echo $form->input('garagem',array('class'=>'custom onlyNumbers','size'=>'5')); ?></td>
    <td><label>Valor:</label></td>
    <td colspan="4">
       de: <?php echo $form->input('valor_from',array('class'=>'custom valor','size'=>'10')); ?>
       ate: <?php echo $form->input('valor_to',array('class'=>'custom valor','size'=>'10')); ?>
    </td>
   </tr>
   <tr>
    <td><label for="ImovelAtivo">Status:</label></td>
    <td><?php echo $form->input('status',array('type'=>'select','options'=>$status)); ?></td>
    <td><label for="ImovelDestaque">Destaque:</label></td>
    <td><?php echo $form->input('destaque',array('type'=>'select','options'=>$destaque)); ?></td>
    <td><label for="ImovelCidade">Cidade:</label></td>
    <td><?php echo $form->input('cidade',array('id'=>'ImovelCidadeId')); ?></td>
   </tr>
   <tr>
   <td><label for="ImovelBairro">Bairro:</label></td>
   <td><?php echo $form->input('bairro_id',array('id'=>'ImovelBairroId')); ?></td>
    <td><label for="ImovelQtde">Exibir:</label></td>
      <td colspan="4">
        <?php echo $form->input('qtde',array('type'=>'select','options'=>$qtde,'default'=>1)); ?>
        <?php echo $form->submit('Pesquisar',array('div'=>false)); ?>
      </td>
    </tr>
  </table>
  </form>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Novo Imóvel', true), array('action' => 'admin_add')); ?></li>
	</ul>
</div>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('ID','id');?></th>
	<th><?php echo $paginator->sort('DESCRIÇÃO','descricao');?></th>
  <th><?php echo $paginator->sort('CIDADE','Cidade.name');?></th>
  <th><?php echo $paginator->sort('BAIRRO','Bairro.name');?></th>
  <th><?php echo $paginator->sort('VALOR','valor');?></th>
  <th>STATUS</th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($imovels1 as $imovel):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td><?php echo $imovel['Imovel']['id']; ?></td>
		<td><?php echo $imovel['Imovel']['descricao']; ?></td>
    <td><?php echo $imovel['Cidade']['name']; ?></td>
		<td><?php echo $imovel['Bairro']['name']; ?></td>
    <td><?php echo number_format($imovel['Imovel']['valor'],2,",","."); ?></td>
    <td><?php echo $statuso->showCurrentStatus('imovels','status',$imovel['Imovel']['status'],$imovel['Imovel']['id']); ?></td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action' => 'admin_view', $imovel['Imovel']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action' => 'admin_edit', $imovel['Imovel']['id'])); ?>
			<?php echo $html->link(__('Excluir', true), array('action' => 'admin_delete', $imovel['Imovel']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $imovel['Imovel']['id'])); ?>
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

