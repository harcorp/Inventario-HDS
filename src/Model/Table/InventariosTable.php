<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class InventariosTable extends Table {

  public function initialize(array $config){
    $this->addBehavior('Timestamp');

    //$this->belongsTo('Users');
  }

  public function validationDefault(Validator $validator){
      $validator
          ->notEmpty('nombre')
          ->notEmpty('fecha_compra')
          ->notEmpty('valor')
          ->notEmpty('id_clase')
          ->notEmpty('id_grupo')
          ->notEmpty('id_clase')
          ->notEmpty('cantidad')
          ->notEmpty('tiempo_depreciacion');
      return $validator;
  }

    public function isOwnedBy($inventarioId, $userId)
    {
        return $this->exists(['idinventarios' => $inventarioId, 'id_centro' => $userId]);
    }
}
