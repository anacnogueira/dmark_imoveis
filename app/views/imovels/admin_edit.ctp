<?php
  $script = $javascript->link(array('jquery.selects','jquery.numeric','jquery.price_format.1.3',
  'jquery.maskedinput','mascara_campo','get_bairros_add','ajaxupload','anexa_arquivos'))."\n";
  echo $this->addScript('scripts_for_layout',$script);
?>
<?//php debug($this->data); ?>
<h2>Editar Imóvel</h2>
<div class="imovels form">
<p>Campos com * são obrigatórios</p>
<?php echo $form->create('Imovel',array(
'type'=>'file','inputDefaults' => array('label' => false,'div' => false)));?>
	<fieldset>
 		<legend><?php __('Informações do imóvel');?></legend>
    <table class='none'>
     <tr>
       <td><label for="ImovelDescricao">Descrição:*</label></td>
       <td colspan="3"><?php echo $form->input('descricao'); ?></td>

     </tr>
     <tr>
       <td><label for="ImovelTipoId">Tipo:*</label></td>
       <td colspan="3"><?php echo $form->input('tipo_id'); ?></td>
     </tr>
     <tr>
       <td><label for="ImovelCategoriaId">Categoria:*</label></td>
       <td colspan="3"><?php echo $form->input('categoria_id'); ?></td>
     </tr>
     <tr>
       <td><label for="CidadeId">Cidade:*</label></td>
       <td colspan="3"><?php echo $form->input('cidade_id',array('selected'=>$cidade_id)); ?></td>
     </tr>
     <tr>
       <td><label for="ImovelBairroId">Bairro:*</label></td>
       <td colspan="3"><?php echo $form->input('bairro_id',array('options'=>$bairros1)); ?></td>
     </tr>
     <tr>
       <td><label for="ImovelAreaTerreno">Área Terreno:</label></td>
       <td><?php echo $form->input('area_terreno',array('class'=>'custom','size'=>'10'));  ?>m<sup>2</sup></td>
       <td><label for="ImovelAreaConstruida">Área Construída:</label></td>
       <td><?php echo $form->input('area_construida',array('class'=>'custom','size'=>'9')); ?> m<sup>2</sup></td>
     </tr>
     <tr>
      <td><label for="ImovelDorms">Dormitórios</label></td>
      <td><?php echo $form->input('dorms',array('class'=>'custom onlyNumbers','size'=>'5')); ?></td>
      <td><label for="ImovelSuites">Suítes:</label></td>
      <td><?php echo $form->input('suites',array('class'=>'custom onlyNumbers','size'=>'5'));   ?></td>
    </tr>
    <tr>
      <td><label for="ImovelBanheiros">Banheiros:</label></td>
      <td><?php echo $form->input('banheiros',array('class'=>'custom onlyNumbers','size'=>'5'));?></td>
      <td><label for="ImovelSala">Sala:</label></td>
      <td><?php echo $form->input('sala',array('class'=>'custom onlyNumbers','size'=>'5'));?></td>
     </tr>
     <tr>
       <td><label for="ImovelGaragem">Garagem:</label></td>
       <td colspan="3"><?php echo $form->input('garagem',array('class'=>'custom onlyNumbers','size'=>'5')); ?></td>
     </tr>
     <tr>
      <td><label for="ImovelValor">Valor:*</label></td>
      <td colspan="3"><?php echo $form->input('valor',array('class'=>'custom valor','size'=>'13','maxlength'=>15)); ?></td>
     </tr>
     <tr>
      <td><label for="ImovelObs">Informações Adicionais:</label></td>
      <td colspan="3"><?php echo $form->input('obs'); ?></td>
     </tr>
     <tr>
      <td><label for="ImovelContato">Contato:</label></td>
      <td colspan="3"><?php  echo $form->input('contato');   ?></td>
     </tr>
     <tr>
      <td><label for="ImovelStatus">Ativo:*</label></td>
      <td colspan="2"><?php
         echo $form->radio('status',array('N'=>'Não',
        'S'=>'Sim'),array('legend'=>false,'label'=>false)); ?>

        </td>
       <td><?php echo $form->error('status'); ?></td>
     </tr>
     <tr>
      <td><label for="ImovelStatus">Destaque:*</label></td>
      <td colspan="2"><?php
         echo $form->radio('destaque',array('N'=>'Não',
        'S'=>'Sim'),array('legend'=>false,'label'=>false)); ?>

        </td>
       <td><?php echo $form->error('destaque'); ?></td>
     </tr>
    </table>
  </fieldset><br />
  <fieldset>
   <legend><?php __('Fotos');?></legend>
   <p>Instruções:</p>
   <ul>
    <li>Insira até <?php echo Configure::read('File.max_qtde'); ?> fotos</li>
    <li>Extensões perminitas: jpg, jpeg, png e gif</li>
    <li>Cada imagem não deve ultrapassar <?php echo Configure::read('File.max_file_size_txt'); ?></li>
   </ul>
    <label for="ImovelFoto">Foto:</label>
   <?php echo $form->file('Imovel.foto',array('id'=>'ImovelFoto')); ?>

   <div id="list_images">
    <?php if(isset($this->data['Imovel']['foto_img'])): ?>
      <?php $idx = 0; ?>
      <?php foreach($this->data['Imovel']['foto_img'] as $item): ?>

      <div class="box">
        <?php echo $html->image('/img/imoveis/'.$item['Foto']['foto'])."<br />\n"; ?>
        <?php echo $form->hidden('',array('name'=>'data[Imovel][foto_img][]','value'=>$item['Foto']['foto'],'id'=>'ImovelFotoId'.$idx))."\n"; ?>
        <?php echo $form->button('Excluir',array('onclick'=>'delete_image(this)'))."\n"; ?>
        <?php $idx++; ?>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
   </div>
  </fieldset>


<?php echo $form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Excluir', true), array('action' => 'admin_delete', $form->value('Imovel.id')), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $form->value('Imovel.id'))); ?></li>
		<li><?php echo $html->link(__('Listar Imóveis', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
