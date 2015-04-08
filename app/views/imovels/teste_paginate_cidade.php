<?php
  class PostsController extends AppController {
    public function by_tag ( $tag ) {
      /**
      * This will fetch Posts tagged $tag (say, 'PHP')
      */
      $this->paginate['Imovel'] = array(
        'limit' => 10,
        'contain' => '',
        'conditions' => array('Imovel.status' => 'S'),
        'fields' => array('Imovel.*', 'Bairro.*','Cidade.*'),
        'joins' => array(
                    array(
                      'table' => 'cidades',
                      'type' => 'INNER',
                      'alias' => 'Cidade',
                     'conditions' => array('Cidade.id = Bairro.cidade_id')),
                 ));

    $data = $this->paginate('Imovel');
    $this->set(compact('data'));
    }
  }
?>