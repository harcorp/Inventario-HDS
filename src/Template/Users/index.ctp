<?php

$this->assign('title', 'Usuarios');

?>

<div class="col-lg-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Lista de usuarios</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
<?= $this->Html->link('Agregar usuario', ['action' => 'add'], ['class' => 'btn btn-primary margen-inferior']) ?>
<table class="table table-bordered table-hover" id="example2">
  <thead>
    <tr>
        <th>Nombre Usuario</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Role</th>
        <th>Sexo</th>
        <th>Acciones</th>
    </tr>
  </thead>
    <!-- Aquí es donde iteramos nuestro objeto de consulta $articles, mostrando en pantalla la información del artículo -->
    <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user->username ?></td>
        <td>
            <?= $user->nombres ?>
        </td>
        <td>
            <?= $user->apellidos ?>
          </td>
          <td>
            <?php
              switch($user->role ){
                case 1:
                  echo "Super Admininistrador";
                  break;
                case 2:
                  echo "Administrador";
                  break;
                case 3:
                  echo "Usuario";
                  break;
              }
             ?>
         </td>
         <td>
             <?php
                switch($user->sexo){
                    case 1:
                        echo "Masculino";
                        break;
                    case 2:
                        echo "Femenino";
                        break;
                }
                ?>
        <td>
          <!--<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> -->
        <?php if($user['role'] == 1) ?><?= $this->Html->link('Cambiar Contraseña', ['action' => 'change_password', $user->id], ['class' => 'btn btn-sm btn-primary']) ?> <?php ; ?>
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
                                      $user->id
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
      <th>Nombre Usuario</th>
      <th>Nombres</th>
      <th>Apellidos</th>
      <th>Role</th>
      <th>Sexo</th>
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
        <p>Esta seguro que desea eliminar esta usuario.</p>
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
