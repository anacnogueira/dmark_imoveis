<?php echo $html->docType('xhtml-strict'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>D'mark Imoveis</title>
  <?php echo $html->charset('UTF-8'); ?>
  <style type='text/css'>
    body{ color: #333; }
    h1 { font-size: 14px;text-align:center;  }

    div#container{
      background: #FFFFCC;
      border: 1px solid #333;
      width: 600px;
      margin: 0 auto;
      font-size: 12px;
      padding: 10px;
    }
    div.signature{
      margin-top: 20px;
      color: #666;
    }

  </style>
</head>

<body>
  <div id="container">
    <div id="top">
      <?php echo $html->image('http://www.dmarkimoveis.com.br/site_teste/app/webroot/img/logo.png',array('alt'=>'D\'mark Imóveis')); ?>
    </div>
    <div id="conteudo">
       <?php echo $content_for_layout;?>
    </div>

    <div class='signature'>
      --<br />
      D'Mark Imóveis<br />
      Consultoria Imobiliária<br />
      Tel: (12) 3029-2869 <br />
      E-mail: contato@dmarkimoveis.com.br <br />
    </div>
  </div>
</body>
</html>