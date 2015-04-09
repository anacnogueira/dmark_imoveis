<div class="menu">
 <ul>
  <li><?php echo $html->link('Home',array('controller'=>'admin','action'=>'index','admin'=>false));?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $html->link('Grupos',array('controller'=>'grupos','action'=>'index','admin'=>true)); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $html->link('Usuários',array('controller'=>'usuarios','action'=>'index','admin'=>true)); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $html->link('Imóveis',array('controller'=>'imovels','action'=>'index','admin'=>true)); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $html->link('Categorias',array('controller'=>'categorias','action'=>'index','admin'=>true)); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $html->link('Tipos',array('controller'=>'tipos','action'=>'index','admin'=>true)); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $html->link('Cidades',array('controller'=>'cidades','action'=>'index','admin'=>true)); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $html->link('Bairros',array('controller'=>'bairros','action'=>'index','admin'=>true)); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $html->link('Páginas',array('controller'=>'paginas','action'=>'index','admin'=>true)); ?></li>
 </ul>
</div>
