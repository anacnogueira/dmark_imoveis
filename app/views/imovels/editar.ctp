<?php
  $script = $javascript->link(array('jquery.selects','jquery.numeric','jquery.price_format.1.3',
  'jquery.maskedinput','mascara_campo','get_bairros_add','ajaxupload','anexa_arquivos'))."\n";
  echo $this->addScript('scripts_for_layout',$script);
?>
<h1>Alterar Imóvel</h1>
<?php echo $session->flash(); ?>
<?php if(!isset($error)): ?>
<p>Campos com * são obrigatórios</p>
<p>Obs: O imóvel será publicado no site após aprovação do moderador</p>
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
       <td colspan="3"><?php echo $form->input('cidade_id',array('selected'=>$this->data['Cidade']['id'])); ?></td>
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
    <?php echo $form->file('Imovel.foto'); ?>

   <div id="list_images">
    <?php if($imagens): ?>
      <?php for($idx=0;$idx<sizeof($imagens);$idx++): ?>
         <div class="box">
          <?php echo $html->image('/img/imoveis/'.$imagens[$idx]['Foto']['foto'])."<br />\n"; ?>
          <?php echo $form->hidden('',array('name'=>'data[Imovel][foto_img][]','value'=>$imagens[$idx]['Foto']['foto'],'id'=>'ImovelFotoId'.$idx))."\n"; ?>
          <?php echo $form->button('Excluir',array('onclick'=>'delete_image(this)'))."\n"; ?>
         </div>
      <?php endfor; ?>
    <?php endif; ?>
   </div>
  </fieldset>
  <?php echo $form->hidden('status',array('value'=>'N')); ?>
  <?php echo $form->hidden('destaque',array('value'=>'N')); ?>
<?php echo $form->end('Enviar');?>
<?php endif; ?>
<p><?php echo $html->link('Voltar para Meus Imóveis','/meus_imoveis'); ?></p>