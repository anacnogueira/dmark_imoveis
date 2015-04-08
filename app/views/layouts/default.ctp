<?php echo $html->docType('xhtml-strict'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>D'Mark Imóveis <?php echo $title_for_layout; ?></title>
  <?php echo $html->meta('description','Venda, compra e aluguel de imóveis')."\n";?>
  <?php echo $html->meta('keywords','casa, apartamento, chácara, lote, venda, compra, aluga')."\n";?>
  <meta name="author" content="Ana Claudia Nogueira - www.anaclaudia.com.br" />
  <?php echo $html->charset('UTF-8'); ?>
	<?php echo $html->css('styles');?>
  <?php echo $javascript->link(array('jquery','jquery.selects','get_bairros')); ?>
  <?php echo $scripts_for_layout; ?>
  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26326565-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
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