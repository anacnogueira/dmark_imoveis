,
    'data_nascimento'=>array(
      'date' => array(
        'rule'=>array('date','dmy'),
        'message'=>'Formato de data inválido'
      ),
      'notEmpty'=>array(
       'rule'=>'notEmpty',
       'required'=>true,
       'Message'=>'O campo não pode ficar em branco'
      )
    ),
    'telefone'=>array(
     'custom' => array(
       'rule' => array('custom', '/^\([0-9]{2}\)[0-9]{4}\-[0-9]{4}$/'),
       'message' => 'Formato de telefone inválido'
      ),
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'O campo não pode ficar em branco'
      )
    ),
    'endereco'=>array(
      'rule'=>'notEmpty',
      'message'=>'O campo não pode ficar em branco'
    ),
    'bairro'=>array(
      'rule'=>'notEmpty',
      'message'=>'O campo não pode ficar em branco'
    ),
    'cidade'=>array(
      'rule'=>'notEmpty',
      'message'=>'O campo não pode ficar em branco'
    ),
    'estado'=>array(
      'rule'=>'notEmpty',
      'message'=>'O campo não pode ficar em branco'
    ),
    'email' => array(
      'email' => array(
      'rule' => 'email',
      'message' => 'Insira um formato de e-mail válido'
      ),
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'O campo não pode ficar em branco'
      )
    ),
    'password' => array(
        'rule' => array('between', 6,15),
        'message' => 'Senha deve possuir entre 6 e 15 caracteres.'
    )