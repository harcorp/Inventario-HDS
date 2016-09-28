<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class GruposPucTable extends Table {

  public function initialize(array $config){
    $this->addBehavior('Timestamp');
  }
}
