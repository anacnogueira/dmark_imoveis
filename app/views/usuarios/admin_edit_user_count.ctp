<?php
  $script = $javascript->link(array('jquery.maskedinput','mascara_campo'))."\n";
  echo $this->addScript('scripts_for_layout',$script);
?>
<div class="usuario form">
 <h2>Alterar dados usuário</h2>
 <?php echo $form->create('Usuario');?>
<p>Os campos com * são obrigatórios</p>
	<fieldset>
 <legend>Informações Pessoais</legend>
 <?php echo $form->input('nome',array('label'=>'Nome:*','maxlength'=>'50'))."\n"; ?>
 <?php echo $form->input('data_nascimento',array('type'=>'text','label'=>'Data Nasc.:*',
 'class'=>'data','maxlength'=>'10','after'=>"<span class='instrucoes'> dd/mm/aaaa</span>"))."\n"; ?>
<?php echo $form->input('cpf',array('label'=>'CPF:','class'=>'cpf','maxlength'=>'14',
'after'=>"<span class='instrucoes'> 999.999.999-99</span>"))."\n"; ?>
</fieldset>
<br />
<fieldset>
  <legend>Informações para contato</legend>
  <?php echo $form->input('telefone',array('label'=>'Telefone:*','class'=>'telefone',
 'maxlength'=>'13','after'=>"<span class='instrucoes'> (99)9999-9999</span>"))."\n"; ?>
<?php echo $form->input('celular',array('label'=>'Celular:','class'=>'telefone',
'maxlength'=>'13','after'=>"<span class='instrucoes'> (99)9999-9999</span>"))."\n"; ?>
</fieldset>
<br />
<fieldset>
  <legend>Endereço</legend>
  <?php echo $form->input('endereco',array('label'=>'Endereço:*','maxlength'=>'50'))."\n"; ?>
  <?php echo $form->input('complemento',array('label'=>'Complemento:','maxlength'=>'50'))."\n"; ?>
  <?php echo $form->input('bairro',array('label'=>'Bairro:*','maxlength'=>'50'))."\n"; ?>
  <?php echo $form->input('cidade',array('type'=>'text','label'=>'Cidade:*','maxlength'=>'50'))."\n"; ?>
  <?php echo $form->input('estado',array('options'=>$estados_a,'type'=>'select','label'=>'Estado:*'))."\n"; ?>
  <?php echo $form->input('cep',array('label'=>'CEP:','class'=>'cep','maxlength'=>'9',
  'after'=>"<span class='instrucoes'> 99999-999</span>"))."\n"; ?>
</fieldset>
<br />
<fieldset>
  <legend>Informações de acesso</legend>
  <?php echo $form->input('email',array('label'=>'Email:*','maxlength'=>'50')); ?>
</fieldset>
<?php echo $form->end('Enviar');?>
</div>
