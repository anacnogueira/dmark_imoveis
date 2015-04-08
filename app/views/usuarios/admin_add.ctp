<?php
  $script = $javascript->link(array('jquery.maskedinput','mascara_campo'))."\n";
  echo $this->addScript('scripts_for_layout',$script);
?>
<h2>Adicionar Usuário</h2>
<div class="usuarios form">
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
  <?php echo $form->input('password',array('label'=>'Senha:*','maxlength'=>'15')); ?>
  <span class='instrucoes' style='margin-left: 120px'>Sua senha deve conter entre 6 e 15 caracteres</span>
</fieldset>
<fieldset>
  <legend>Informações Adicionais</legend>
  <?php echo $form->input('grupo_id',array('label'=>'Grupo:*')); ?>
  <label>Status:*</label>
  <?php echo $form->radio('ativo',array(
   'N'=>'Não',
   'S'=>'Sim'),array('legend'=>false,'label'=>false)); ?>
   <?php echo $form->error('ativo'); ?>
   <div><label for="UsuarioCod">Gerar cód. ativação:</label>
  <?php echo $form->checkbox('cod',array('value'=>'S')); ?></div>
</fieldset>

<?php echo $form->end('Enviar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Usuários', true), array('action' => 'admin_index'));?></li>
	</ul>
</div>
