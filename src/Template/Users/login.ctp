<!-- File: src/Template/Users/login.ctp -->
<?php
$this->layout = 'login';
 ?>
<div class="login-box">
  <div class="login-logo">
    <?= $this->Html->image('logo.png', ['alt' => 'Hermanas del Divino Salvador', 'class' => 'logo', 'style' => 'width: 30%']); ?>
    <a href="/"><b>Inventario</b>CDS</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingrese para iniciar una sesión</p>

    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
      <div class="form-group has-feedback">
        <?= $this->Form->input('username', ['class' => 'form-control', 'placeholder' => 'Nombre de usuario', 'label' => false]) ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?= $this->Form->input('password', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'label' => false]) ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <?= $this->Form->button(__('Ingresar'), ['class' => 'btn btn-primary btn-block btn-flat']); ?>
        </div>
        <!-- /.col -->
      </div>
    <?= $this->Form->end() ?>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
