<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */

class AppController extends Controller {
   var $helpers = array('Html','Form','Javascript','Session');
   var $components = array('Email','Session','RequestHandler');
   var $uses = array('Imovel','Cidade','Bairro');
   var $qtde =array('10','20','30','50','100');

   function beforeRender(){

      //Usuarios
      $status = array('0'=>'Todos','S'=>'Sim','N'=>'Não');

      //Imoveis
      $categorias = $this->Imovel->Categoria->find('list');
      $tipos = $this->Imovel->Tipo->find('list');
      $cidades = $this->Cidade->find('list');
       array_unshift($cidades,'Selecione');
      //Qtde de registros - ADmin
      $qtde = $this->qtde;

      if(isset($this->data['Imovel']['Cidade']) and !empty($this->data['Imovel']['Cidade'])){
        $bairros = $this->Bairro->find('list',array('conditions'=>
        array('cidade_id'=>$this->data['Imovel']['Cidade'])));
      }
      else
        $bairros = '';

      $estados_a = $this->__estados_br();
      $this->set(compact('categorias','tipos','cidades','bairros','estados_a'));
      $this->set(compact('status'));
      $this->set(compact('qtde'));
   }

   function __estados_br(){
     $arraEstados = array("AC"=>"Acre","AL"=>"Alagoas","AM"=>"Amazonas","AP"=>"Amapá",
     "BA"=>"Bahia","CE"=>"Ceará","DF"=>"Distrito Federal","ES"=>"Espirito Santo","GO"=>"Goiás",
     "MA"=>"Maranhão","MG"=>"Minas Gerais","MG"=>"Mato Grosso do Sul","MT"=>"Mato Grosso","PA"=>"Pará",
     "PB"=>"Paraíba","PE"=>"Pernambuco","PI"=>"Piauí","PR"=>"Paraná","RJ"=>"Rio de Janeiro",
    "RN"=>"Rio Grande Norte","RO"=>"Rondônia","RR"=>"Roraima","RS"=>"Rio Grande do Sul",
    "SC"=>"Santa Catarina","SP"=>"São Paulo","SE"=>"Sergipe","TO"=>"Tocantins");
    asort($arraEstados);
    array_unshift($arraEstados,"Selecione");
    return $arraEstados;
   }

/*--------------------------------------------------------------------------------'
'   													Função conversora de Data														'
'   1 =  AAAA-MM-DD para DD/MM/AAAA                   														'
'   2 =  DD/MM/AAAA para AAAA-MM-DD                  														  '
'   3 = DD/MM/AAAA 00:00:00 para AAAA-MM-DD 00:00:00  														'
'   4 = AAAA-MM-DD 00:00:00 para DD/MM/AAAA 00:00:00  														'
---------------------------------------------------------------------------------*/
   function format_date($date,$cod_format){
    $date = str_replace("'","",$date);
    switch($cod_format){
      case 1:
        $conv1 = explode("-",$date);
        $out = implode("/",array_reverse($conv1));
        break;
      case 2:
        $conv1 = explode("/",$date);
        $out = implode("-",array_reverse($conv1));
        break;
      case 3:
        $convHora = explode(" ",$date);
        $ConvData = explode("/",$convHora[0]);
        $out = implode("-",array_reverse($ConvData))." ".$convHora[1];
        break;
      case 4:
        $convHora = explode(" ",$date);
        $ConvData = explode("-",$convHora[0]);
        $out = implode("/",array_reverse($ConvData))." ".$convHora[1];
        break;
      }
      return $out;
   }

   function convert_number_to_en_format($valor){

     $out = str_replace('.','',$valor);
     $out = str_replace(',','.',$out);

     return $out;
   }

   function convert_number_to_br_format($value = null){

   }
   /* Front-end*/
   function checkSession(){
     if(!$this->Session->check('usuario')){
       $this->Session->setFlash(__('Por favor,ss faça seu login',true));
       $this->Session->write('redirect_page',$this->params['url']);
       $this->redirect('/usuarios/login');
     }
   }
   /* ADMIN */
   function checkAdminSession(){
    if(!$this->Session->check('usuario') or $this->Session->read('usuario.type') != 'Admin'){
      //Set flash message and redirect
      $this->Session->setFlash(__('Por favor, faça seu login como administrador',true));
      $this->redirect('/admin/login');
    }
   }

    function beforeFilter(){
      // print_r($this->params);
      $exceptions = array('admin_esqueci_senha','admin_cadastrar_nova_senha','admin_nova_senha_cadastrada');


      if((isset($this->params['admin']) or $this->params['controller'] == 'admin')
       and !in_array($this->params['action'],$exceptions)){
        $this->checkAdminSession();
      }
    }

}
?>