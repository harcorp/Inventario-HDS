<div class="col-lg-12">
  <div class="box">
      <div class="box-header">
        <h3 class="box-title">Editar ubicación</h3>
      </div>
    <div class="box-body">
<?php
    echo $this->Form->create($ubicacion);
    echo $this->Form->input('nombre', ['class' => 'form-control']);
    echo $this->Form->button(__('Guardar ubicación'), ['class' => 'btn btn-primary margen-superior']);
    echo $this->Form->end();
?>

</div>
</div>
</div>
