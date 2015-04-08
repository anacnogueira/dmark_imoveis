<div id="menu_temp">
 <h2>Adm temporária</h2>
 <ul>
  <li><?php echo $html->link('Grupos',array('controller'=>'grupos','action'=>'admin_index')); ?></li>
  <li><?php echo $html->link('Usuários',array('controller'=>'usuarios','action'=>'admin_index')); ?></li>
  <li><?php echo $html->link('Imóveis',array('controller'=>'imovels','action'=>'lista')); ?></li>
  <li><?php echo $html->link('Categorias',array('controller'=>'categorias','action'=>'index')); ?></li>
  <li><?php echo $html->link('Tipos',array('controller'=>'tipos','action'=>'index')); ?></li>
  <li><?php echo $html->link('Cidades',array('controller'=>'cidades','action'=>'index')); ?></li>
  <li><?php echo $html->link('Bairros',array('controller'=>'bairros','action'=>'index')); ?></li>
  <li><?php echo $html->link('Páginas',array('controller'=>'paginas','action'=>'index')); ?></li>
 </ul>
</div>
