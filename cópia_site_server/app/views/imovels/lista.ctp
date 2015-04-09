<h1>Meus Imóveis</h1>
<?php echo $session->flash(); ?>
<?php if(sizeof($imovels) > 0): ?>
 <?php echo $this->element("list2_imovels"); ?>
 <?php else: ?>
 <div class='noResults'>Nenhum imóvel ecnontrado</div>
 <?php endif; ?>
