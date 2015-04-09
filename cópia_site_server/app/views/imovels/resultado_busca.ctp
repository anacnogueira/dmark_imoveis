<h1>Resultado da Busca</h1>
<?php if(sizeof($imoveis) > 0): ?>
 <?php echo $this->element("list1_imovels"); ?>
 <?php else: ?>
 <div class='noResults'>Nenhum resultado encontrado para essa busca</div>
 <?php endif; ?>

