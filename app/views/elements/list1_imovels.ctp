<?php if(isset($imoveis) and is_array($imoveis)): ?>
<?php foreach($imoveis as $imovel): ?>
 <div class="box">
  <?php if(isset($imovel['Foto'][0])): ?>
  <?php echo $html->image("/img/imoveis/".$imovel['Foto'][0]['foto'],array('alt'=>$imovel['Imovel']['descricao'])); ?>
  <?php else: ?>
  <?php echo $html->image("no_image.jpg",array('alt'=>'Imóvem sem imagem')); ?>
  <?php endif; ?>
  <p class="desc"><?php echo $imovel['Imovel']['descricao']; ?></p>
  <p>
    <?php if(!empty($imovel['Imovel']['dorms'])): ?>
    <?php echo $imovel['Imovel']['dorms']; ?> dorms
   <?php endif; ?>
  <?php if(!empty($imovel['Imovel']['garagem'])): ?>
  <?php echo $imovel['Imovel']['garagem']; ?> vaga
  <?php endif; ?>
  <?php if(!empty($imovel['Imovel']['area_terreno'])): ?>
  <?php echo $imovel['Imovel']['area_terreno']; ?> m<sup>2</sup>
  </p>
  <?php endif; ?>
  <p class='valor'>R$ <?php echo number_format($imovel['Imovel']['valor'],2,",","."); ?></p>
  <p class='detalhes'><?php echo $html->link('Detalhes &raquo;',
   array('controller' => 'imovels', 'action' => 'detalhes', $imovel['Imovel']['id']),array('escape' => false)); ?></p>
 </div>
<?php endforeach; ?>
<div class="pag">
  <?php echo $paginator->prev('« Anterior ', null, null); ?>
  <?php echo $paginator->numbers(); ?>
  <?php echo $paginator->prev('Próximo » ', null, null); ?>
</div>
<?php endif; ?>
