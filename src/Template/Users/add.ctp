<?php

$this->assign('title', 'Agregar usuario');

?>
<div class="col-lg-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Aquí puede agregar un nuevo usuario rellenando el formulario.</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

      <?= $this->Form->create($user) ?>
        <div class="container">
          <div class="row">
            <div class="col-md-2">
              <?= $this->Form->input('username', ['label' => 'Nombre de usuario','class' => 'form-control']) ?>
            </div>
            <div class="col-md-2">
              <?= $this->Form->input('password', ['label' => 'Contraseña','class' => 'form-control']) ?>
            </div>
            <div class="col-md-3">
              <?= $this->Form->input('nombres', ['label' => 'Nombres','class' => 'form-control']) ?>
            </div>
            <div class="col-md-3">
              <?= $this->Form->input('apellidos', ['label' => 'Apellidos','class' => 'form-control']) ?>
            </div>
          </div>
          <div class="row margen-superior">
            <div class="col-md-3">
            <?= $this->Form->input('email', ['label' => 'Correo electronico','class' => 'form-control']) ?>
            </div>
            <div class="col-md-2">
                <label for="sexo">Genero</label>
                <?= $this->Form->select('sexo', ['1' => 'Masculino', '2' => 'Femeinino'], ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-2">
              <?php if($role == 1){ ?>
              <?= $this->Form->input('role', [
                  'options' => ['1' => 'Super Administrador', '2' => 'Admininistrador', '3' => 'Usuario'], 'class' => 'form-control']) ?>
              <?php }else{ ?>
                <?= $this->Form->input('role', [
                    'options' => ['3' => 'Usuario'], 'class' => 'form-control']) ?>
              <?php }?>


            </div>
            <?php if($role == 1){ ?>
            <div class="col-md-3">
              <label for="id_centro">Centro de costo</label>
              <select name="id_centro" id="id_centro" class="form-control" required="required">
                <?php foreach($centros as $centro){ ?>
                  <option value="<?= $centro['idcentros'] ?>"><?= $centro['id'] . " | " . $centro['nombre'] . " | " . $centro['ciudad'] ?></option>
                <?php } ?>
              </select>
            </div>
            <?php }else{ ?>
                  <input type="hidden" name="id_centro" value="<?= $usuario['id_centro']; ?>" />
              <?php } ?>
          </div>
          <div class="row margen-superior">
            <div class="col-md-12">
              <?= $this->Form->button(__('Crear usuario'), ['class' => 'btn btn-primary']); ?>
            </div>
          </div>
        </div>


<?= $this->Form->end() ?>
</div>
</div>
</div>
