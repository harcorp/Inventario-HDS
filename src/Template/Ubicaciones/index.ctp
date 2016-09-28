<?php

$this->assign('title', 'Ubicaciones');

?>

<div class="col-lg-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Lista de ubicaciones</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
<?= $this->Html->link('Agregar ubicación', ['action' => 'add'], ['class' => 'btn btn-primary margen-inferior']) ?>
<table class="table table-bordered table-hover" id="example2">
  <thead>
    <tr>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
  </thead>
    <!-- Aquí es donde iteramos nuestro objeto de consulta $articles, mostrando en pantalla la información del artículo -->
    <tbody>
    <?php foreach ($ubicaciones as $ubicacion): ?>
    <tr>
        <td>
            <?= $ubicacion->nombre ?>
        </td>
        <td>
          <?= $this->Html->link('Editar', ['action' => 'edit', $ubicacion->idubicaciones], ['class' => 'btn btn-sm btn-primary']) ?>
          <?= $this->Html->link(
               $this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')),
               '#',
               array(
                  'class'=>'btn btn-danger btn-confirm',
                  'data-toggle'=> 'modal',
                  'data-target' => '#myModal',
                  'data-action'=> $this->Url->build([
                                     "controller" => "Users",
                                     "action" => "delete",
                                     $ubicacion->idubicaciones
                                 ]),
                  'escape' => false),
           false);
         ?>
        </td>
    </tr>
    <?php endforeach; ?>
  </tbody>

  <tfood>
    <tr>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
  </tfood>
</table>
</div>
</div>

 <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">¿Esta Seguro?</h4>
      </div>
      <div class="modal-body">
        <p>Esta seguro que desea eliminar esta ubicación.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?= $this->Form->postLink(
            'Eliminar',
            ['action' => 'delete'],
            ['class' => 'btn btn-danger boton-eliminar'],
            false)
        ?>
      </div>
    </div>
  </div>
</div>
 </div>
