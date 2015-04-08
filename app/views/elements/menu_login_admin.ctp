<div class="menu_login">
 <ul>
  <li>Olá <?php echo $this->Session->read('usuario.nome'); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $html->link('Alterar Dados',array('controller'=>'usuarios','action'=>'edit_user_count','admin'=>true)); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $html->link('Alterar Senha',array('controller'=>'usuarios','action'=>'edit_user_password','admin'=>true)); ?></li>
  <li>&nbsp;|&nbsp;</li>
  <li><?php echo $html->link('Sair',array('controller'=>'usuarios','action'=>'logout','admin'=>false,'admin')); ?></li>
 </ul>
</div>
