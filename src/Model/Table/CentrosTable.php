<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CentrosTable extends Table {

  public function initialize(array $config){
    $this->addBehavior('Timestamp');
  }

  public function validationDefault(Validator $validator){
      $validator
          ->notEmpty('id')
          ->notEmpty('nombre')
          ->notEmpty('direccion')
          ->notEmpty('telefono')
          ->notEmpty('ciudad')
          ->notEmpty('departamento');

    $validator->add('id', 'unique', [
    'rule' => 'validateUnique',
    'provider' => 'table',
    'message' => 'Ya existe este ID'
]);
      return $validator;
  }
}
