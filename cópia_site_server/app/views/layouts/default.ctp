<?php echo $html->docType('xhtml-strict'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>D'Mark Imóveis <?php echo $title_for_layout; ?></title>
  <?php echo $html->charset('UTF-8'); ?>
	<?php echo $html->css('styles');?>
  <?php echo $javascript->link(array('jquery','jquery.selects','get_bairros')); ?>
  <?php echo $scripts_for_layout; ?>
</head>
<body>
  <div id="container">
    <div id="content">
      <?php echo $this->element('top'); ?>
      <?php echo $this->element('menu'); ?>
      <div id="conteudo">
        <?php echo $content_for_layout;?> 
      </div>
      <?php echo $this->element('sidebar'); ?>
      <div id="empty">&nbsp;</div>
      <?php echo $this->element('footer'); ?>
	  </div>
	</div>
</body>
</html>