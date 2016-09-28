<?php

$this->assign('title', 'Agregar centro de costo');

?>

<script>
  var editar = 1
</script>

<div class="col-lg-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Aquí puede agregar un nuevo usuario rellenando el formulario.</h3>
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
              <label for="departamento">Seleccionar Departamento*</label>
              <select name="departamento" id="departamento" class="form-control" required="required">
                <option value="" disabled selected>Seleccione una opción</option>
              <?php foreach($departamentos as $departamento){ ?>
                <option class="optdepartamento" value="<?php echo $departamento['nombre']; ?>" data-value="<?= $departamento['iddepartamentos'] ?>">
                  <?= $departamento['nombre'] ?>
                </option>
              <?php } ?>
              </select>
            </div>
            <div class="col-md-4 ciudad">
              <label for="ciudad">Seleccionar Ciudad*</label>
              <select name="ciudad" id="ciudad" class="form-control ciudad" required="required">
                <option value="" disabled selected>Seleccione una opción</option>
              <?php foreach($ciudades as $ciudad){ ?>
                <option class="optciudad" value="<?php echo $ciudad['nombre']; ?>" data-value="<?= $ciudad['idciudades'] ?>" departamento="<?= $ciudad['departamentos_iddepartamentos'] ?>">
                  <?= $ciudad['nombre'] ?>
                </option>
              <?php } ?>
              </select>
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
