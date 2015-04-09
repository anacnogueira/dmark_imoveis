<?php
  $script = $javascript->link(array('jquery.jcarousel','jquery.lightbox-0.5.min'))."\n";
  $script .= $html->css(array('skin','customize.tango','jquery.lightbox-0.5'));
?>
<?php echo $this->addScript('scripts_for_layout',$script); ?>
<div class="imovels view">
<h2><?php  __('Imóvel');?></h2>
<fieldset>
  <legend><?php __('Informações do imóvel');?></legend>
    <table class='none'>
       <tr>
        <td><label>Descrição:</label></td>
        <td colspan="3"><?php echo $imovel['Imovel']['descricao']; ?></td>
      </tr>
      <tr>
        <td><label>Tipo:</label></td>
        <td colspan="3"><?php echo $imovel['Tipo']['name']; ?></td>
     </tr>
     <tr>
        <td><label>Categoria:</label></td>
        <td colspan="3"><?php echo $imovel['Categoria']['name']; ?></td>
     </tr>
     <tr>
        <td><label>Cidade:</label></td>
        <td colspan="3"><?php echo $imovel['Cidade']['name']; ?></td>
     </tr>
     <tr>
        <td><label>Bairro:</label></td>
        <td colspan="3"><?php echo $imovel['Bairro']['name']; ?></td>
     </tr>
     <tr>
        <td><label>Área Terreno:</label></td>
        <td><?php echo $imovel['Imovel']['area_terreno'];  ?>m<sup>2</sup></td>
        <td><label>Área Construída:</label></td>
        <td><?php echo $imovel['Imovel']['area_construida']; ?> m<sup>2</sup></td>
     </tr>
     <tr>
        <td><label>Dormitórios:</label></td>
        <td><?php echo $imovel['Imovel']['dorms']; ?></td>
        <td><label>Suites:</label></td>
        <td><?php echo $imovel['Imovel']['suites']; ?></td>
    </tr>
    <tr>
        <td><label>Banheiros:</label></td>
        <td><?php echo $imovel['Imovel']['banheiros'];?></td>
        <td><label>Sala:</label></td>
        <td><?php echo $imovel['Imovel']['sala'];?></td>
     </tr>
     <tr>
        <td><label>Garagem:</label></td>
        <td colspan="3"><?php echo $imovel['Imovel']['garagem']; ?></td>
     </tr>
     <tr>
        <td><label>Valor:</label></td>
        <td colspan="3"><?php echo $imovel['Imovel']['valor']; ?></td>
     </tr>
     <tr>
        <td><label>Informações Adicionais:</label></td>
        <td colspan="3" ><?php echo nl2br($imovel['Imovel']['obs']); ?></td>
     </tr>
     <tr>
        <td><label>Contato:</label></td>
        <td colspan="3"><?php echo nl2br($imovel['Imovel']['contato']);   ?></td>
     </tr>
     <tr>
        <td><label>Ativo:</label></td>
        <td><?php echo ife($imovel['Imovel']['status']=='S','Sim','Não'); ?></td>
     </tr>
    </table>
  </fieldset>
  <?php if(!empty($fotos)): ?>
  <fieldset>
   <legend><?php __('Fotos');?></legend>


    <div id="mycarousel" class="jcarousel-skin-tango">
    <ul>
      <?php for($idx=0;$idx<sizeof($fotos);$idx++): ?>
        <li><a href='../../../img/imoveis/<?php echo$fotos[$idx]['Foto']['foto']; ?>' class='lightbox'><?php echo $html->image('/img/imoveis/'.$fotos[$idx]['Foto']['foto']); ?></a></li>
      <?php endfor; ?>
    </ul>
  </div>
  </fieldset>
  <?php endif; ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Imóvel', true), array('action' => 'admin_edit', $imovel['Imovel']['id'])); ?> </li>
		<li><?php echo $html->link(__('Exclui Imóvel', true), array('action' => 'admin_delete', $imovel['Imovel']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $imovel['Imovel']['id'])); ?> </li>
		<li><?php echo $html->link(__('Listar Imóveis', true), array('action' => 'admin_index')); ?> </li>
		<li><?php echo $html->link(__('Novo Imóvel', true), array('action' => 'admin_add')); ?> </li>
	</ul>
</div>
<script type="text/javascript">
  $(document).ready(function(){
   $("#mycarousel").jcarousel({
     scroll: 1,
     visible: 3
   });

   $(function() {
     $('a.lightbox').lightBox({
       overlayBgColor: '#999',
	     overlayOpacity: 0.6,
	     imageLoading: '../../../img/lightbox-ico-loading.gif',
	     imageBtnClose: '../../../img/lightbox-btn-close.gif',
	     imageBtnPrev: '../../../img/lightbox-btn-prev.gif',
	     imageBtnNext: '../../../img/lightbox-btn-next.gif',
	     containerResizeSpeed: 350,
	     txtImage: 'Imagem',
	     txtOf: 'de'
     });
   });
  });
 </script>