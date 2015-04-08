<?php
  $script = $javascript->link(array('jquery.jcarousel','jquery.lightbox-0.5.min'))."\n";
  $script .= $html->css(array('skin','customize.tango','jquery.lightbox-0.5'));
?>
<?php echo $this->addScript('scripts_for_layout',$script); ?>
<h1><?php echo $imovel['Imovel']['descricao']; ?></h1>
<?php echo $html->image('/img/imoveis/'.$imovel['Foto'][0]['foto'],array(
  'alt'=>$imovel['Imovel']['descricao'],'width'=>'250')); ?>
<div id="det_imovel">
  <div id="mycarousel" class="jcarousel-skin-tango">
    <ul>
      <?php foreach($imovel['Foto'] as $foto): ?>
        <li><a href='../../img/imoveis/<?php echo $foto['foto']; ?>' class='lightbox'><?php echo $html->image('/img/imoveis/'.$foto['foto']); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class='inf_imovel'>
    <h2><?php echo $imovel['Categoria']['name']; ?> - <?php echo $imovel['Tipo']['name']; ?></h2>
    <h3><?php echo $imovel['Bairro']['name']; ?> - <?php echo $cidade['Cidade']['name']; ?></h3>
    <ul>
      <?php if(!empty($imovel['Imovel']['dorms'])): ?>
      <li><?php echo $imovel['Imovel']['dorms']; ?> dormitórios</li>
      <?php endif; ?>
      <?php if(!empty($imovel['Imovel']['suites'])): ?>
      <li><?php echo $imovel['Imovel']['suites']; ?> suítes</li>
      <?php endif; ?>
      <?php if(!empty($imovel['Imovel']['banheiros'])): ?>
      <li><?php echo $imovel['Imovel']['banheiros']; ?> banheiros</li>
      <?php endif; ?>
      <?php if(!empty($imovel['Imovel']['garagem'])): ?>
      <li><?php echo $imovel['Imovel']['garagem']; ?> vagas(garagem)</li>
      <?php endif; ?>
      <?php if(!empty($imovel['Imovel']['sala'])): ?>
      <li><?php echo $imovel['Imovel']['sala']; ?> sala</li>
      <?php endif; ?>
      <?php if(!empty($imovel['Imovel']['area_terreno'])): ?>
      <li><?php echo $imovel['Imovel']['area_terreno']; ?>m<sup>2</sup> área total</li>
      <?php endif; ?>
      <?php if(!empty($imovel['Imovel']['area_construida'])): ?>
      <li><?php echo $imovel['Imovel']['area_construida']; ?>m<sup>2</sup> área privativa</li>
      <?php endif; ?>
      <li class='valor'>Valor: R$ <?php echo number_format($imovel['Imovel']['valor'],2,',','.'); ?></li>
  </ul>
  </div>
</div>
<?php if(!empty($imovel['Imovel']['obs'])): ?>
  <div class='obs_imovel'>
    <h4>Outras caracteríscas do imóvel</h4>
      <?php echo nl2br($imovel['Imovel']['obs']); ?>
  </div>
  <?php endif; ?>
  <?php if(!empty($imovel['Imovel']['contato'])): ?>
    <div class='contato_imovel'>
      <h4>Informações para contato</h4>
      <?php echo nl2br($imovel['Imovel']['contato']); ?>
    </div>
  <?php endif; ?>

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
	     imageLoading: '../../img/lightbox-ico-loading.gif',
	     imageBtnClose: '../../img/lightbox-btn-close.gif',
	     imageBtnPrev: '../../img/lightbox-btn-prev.gif',
	     imageBtnNext: '../../img/lightbox-btn-next.gif',
	     containerResizeSpeed: 350,
	     txtImage: 'Imagem',
	     txtOf: 'de'
     });
   });
  });
 </script>   