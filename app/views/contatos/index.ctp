<?php
  $script = $javascript->link(array('jquery.maskedinput','mascara_campo'))."\n";
  echo $this->addScript('scripts_for_layout',$script);
?>
<h1>Contato</h1>
<div class = "contatos form">
 <p>Preencha os dados abaixo corretamente para enviar sua mensagem</p>
 <p>Os campos marcados com * são obrigatórios</p>
 <?php
  echo $form->create('Contato')."\n";

  echo $form->input('nome',array('label'=>'Nome:*'))."\n";
  echo $form->input('email',array('label'=>'E-mail:*'))."\n";

  echo $form->input('telefone',array('label'=>'Telefone:*','class'=>'telefone','maxlength'=>13,
  'after' => "<span class='instrucoes'>Ex:(99)9999-9999</span>"))."\n";
  echo $form->input('mensagem',array('label'=>'Mensagem:*'))."\n";
  echo $form->end('ENVIAR')."\n";

  ?>
</div>