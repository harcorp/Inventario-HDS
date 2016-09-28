<div class="col-lg-12">
  <div class="box">
    <!-- /.box-header -->
    <div class="box-body">
<h1>Agregar ubicación</h1>
<?php
    echo $this->Form->create($ubicacion);
    echo $this->Form->input('nombre', ['class' => 'form-control input-lg']);
    echo $this->Form->button(__('Agregar'), ['class' => 'btn btn-primary margen-superior']);
    echo $this->Form->end();
?>
</div>
</div>
</div>
