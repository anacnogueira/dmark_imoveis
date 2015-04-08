<?php
class AdminController extends AppController {

	var $name = 'Admin';
	var $uses = array('Imovel');

  function index(){
   $this->set("title_for_layout","Home");
   $this->layout = 'admin';
   $conditions = array('status'=>'S','destaque'=>'S');
    $imovels = $this->paginate($conditions);
    $fields = array('Imovel.id','Imovel.descricao','Imovel.dorms','Imovel.garagem',
    'Bairro.name','Imovel.area_terreno','Imovel.valor');

    $this->paginate['Imovel'] = array(
      'limit'=>9,
      'conditions' => $conditions,
      'fields' => $fields,
      'order'=>'Imovel.created DESC');

    $imoveis = $this->paginate('Imovel');

    $this->set(compact('imovels'));
  }



}
?>