<?php

$this->assign('title', 'Editar centro de costos');

?>
<div class="col-lg-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Editando el centro de costos <b><?= $centro['nombre'] ?></b></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?= $this->Form->create($centro) ?>
        <div class="container">
          <div class="row">
            <div class="col-md-2">
              <?= $this->Form->input('id', ['label' => 'ID centro de costo','class' => 'form-control', 'type' => 'number']) ?>
            </div>
            <div class="col-md-8">
              <?= $this->Form->input('nombre', ['label' => 'Nombre', 'class' => 'form-control']) ?>
            </div>
          </div>
          <div class="row margen-superior">
            <div class="col-md-4">
              <?= $this->Form->input('direccion', ['label' => 'Dirección', 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-4">
              <?= $this->Form->input('telefono', ['label' => 'Teléfono', 'class' => 'form-control']) ?>
            </div>
          </div>
          <div class="row margen-superior">
            <div class="col-md-4 departamento">
              <?= $this->Form->input('departamento', ['label' => 'Departamento', 'class' => 'form-control', 'disabled' => true]) ?>
            </div>
            <div class="col-md-4 ciudad">
              <?= $this->Form->input('ciudad', ['label' => 'Ciudades', 'class' => 'form-control', 'disabled' => true]) ?>
            </div>
          </div>
          <div class="row margen-superior">
            <div class="col-md-12">
              <?= $this->Form->button(__('Crear centro de costo'), ['class' => 'btn btn-primary']); ?>
            </div>
          </div>
        </div>
        <?= $this->Form->end; ?>
    </div>
  </div>
</div>

<script>
  var editar = 1;
</script>
