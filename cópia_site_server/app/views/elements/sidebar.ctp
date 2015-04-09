<?php $actions = array('login','esqueci_senha','cadastrar_nova_senha','nova_senha_cadastrada'); ?>

<?php if(!in_array($this->params['action'],$actions)): ?>
<div id="sidebar">
        <div id="forms">
          <div id="busca">
            <h2>Busca</h2>
            <?php echo $form->create('Imovel',array('url' => '/imovels/resultado_busca')); ?>
            <?php echo $form->input('Categoria',array('label'=>'Categoria:')); ?>
            <?php echo $form->input('Tipo',array('label'=>'Tipo:')); ?>
            <?php echo $form->input('Cidade',array('label'=>'Cidade:','type'=>'select','id'=>'ImovelCidadeId')); ?>
            <?php echo $form->input('Bairro',array('label'=>'Bairro:','type'=>'select','id'=>'ImovelBairroId','empty'=>'Escolha a cidade')); ?>
            <?php echo $form->end('BUSCAR'); ?>
          </div>
          <div id="login">
          <?php if($session->check('usuario')): ?>
            <p>Olá, <strong><?php echo $session->read('usuario.nome'); ?></strong></p>
            <ul>
              <li><?php echo $html->link('Alterar Cadastro','/usuarios/alterar_cadastro/'.$session->read('Auth.Usuario.id')); ?></li>
              <li><?php echo $html->link('Alterar Senha','/usuarios/alterar_senha/'.$session->read('Auth.Usuario.id')); ?></li>
              <li><?php echo $html->link('Meus Imóveis','/meus_imoveis/'.$session->read('Auth.Usuario.id')); ?></li>
              <li><?php echo $html->link('Sair','/usuarios/logout'); ?></li>
            </ul>
          <?php else: ?>
            <h2>Anuncie seu imóvel</h2>
            <p>Faça seu login e cadastre seu imóvel</p>
            <?php echo $form->create('Usuario',array('action' =>'login')); ?>
            <?php echo $form->input('username',array('label'=>'Email:','id'=>'usulogin')); ?>
            <?php echo $form->input('senha',array('label' =>'Senha:','id'=>'usupassword','type'=>'password')); ?>
            <?php echo $form->end('ENTRAR'); ?>
            <span style='margin-left:6em'><?php echo $html->link('Esqueci a senha','/usuarios/esqueci_senha'); ?></span>
            <div id="cadastro">
             <p>Não possui cadastro?</p>
            <p><?php echo $html->link('Cadastre-se agora',array('controller'=>'usuarios','action'=>'cadastro')); ?></p>
            </div>
           <?php endif; ?>
          </div>
        </div>
        <div id="consultenos">
          <h1>Consulte-nos!</h1>
          <span class="telefone">(12) 3029-2869</span>
          <span class="email"><a href='mailto:contato@dmarkimoveis.com.br'>contato@dmarkimoveis.com.br</a></span>
      </div>
      </div>
<?php endif; ?>