<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ClasesPucTable extends Table {

  public function initialize(array $config){
    $this->addBehavior('Timestamp');
  }
}
