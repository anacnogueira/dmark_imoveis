<?php if($sent =='s'): ?>
<h1>Cadastro de usuário</h1>
  <p>Cadastro concluído com sucesso</p>
  <p>Neste momento estamos mandando um e-mail para você</p>
  <p>Aguardamos sua confirmação</p>

  <p>Obrigado</p>

<?php else: ?>
 <h1>Falha no envio do e-mail</h1>
 <p>Não foi possível enviar o e-mail com seus dados</p>
 <p>Por favor envio um e-mail para <?php echo $html->link('contato@dmarkimoveis.com.br',
 'mailto:contato@dmarkimoveis.com.br?subject=Envio de dados de cadastro'); ?>
 informando nome, e-mail e CPF</p>
<?php endif; ?>

<p><?php echo $html->link('Voltar para a página principal',array('controller'=>'imovels','action' => 'index'),array('class' => 'button')); ?> </p>