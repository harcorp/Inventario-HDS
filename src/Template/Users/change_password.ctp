<?php

$this->assign('title', 'Cambiar Contraseña');

?>
<div class="col-lg-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Cambiar la contraseña de <b><?= $user['nombres'] . " " . $user['apellidos'] ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
   <?= $this->Form->create($user) ?>
   <div class="container">
     <div class="row">
        <div class="col-md-3">
        <?= $this->Form->input('old_password', ['type' => 'password','label' => 'Antigua Contraseña','class' => 'form-control']) ?>
        </div>
        <div class="col-md-3">
          <?= $this->Form->input('password1',['type'=>'password' ,'label'=>'Nueva Contraseña','class' => 'form-control']) ?>
        </div>
        <div class="col-md-3">
          <?= $this->Form->input('password2',['type' => 'password' , 'label'=>'Repetir Contraseña','class' => 'form-control'])?>
        </div>
      </div>
      <div class="row margen-superior">
        <div class="col-md-12">
          <?= $this->Form->button(__('Cambiar Contraseña'), ['class' => 'btn btn-primary']); ?>
        </div>
      </div>
    </div>
   <?= $this->Form->end() ?>
 </div>
 </div>
 </div>
