<div class="col-lg-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Lista de inventario</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
<?= $this->Html->link('Agregar producto', ['action' => 'add'], ['class' => 'btn btn-primary margen-inferior']) ?>

<table class="table table-bordered table-hover" id="example2">
  <thead>
    <tr>
        <th>Codigo</th>
        <th>Nombre de Producto</th>
        <th>Ubicación</th>
        <th>Cuenta</th>
        <th>Sub Cuentas</th>
        <th>Cantidad</th>
    </tr>
  </thead>
    <!-- Aquí es donde iteramos nuestro objeto de consulta $articles, mostrando en pantalla la información del artículo -->
    <tbody>
    <?php foreach ($inventarios as $inventario): ?>
    <tr>
        <td><?= $inventario->id_centro . $inventario->id_clase . $inventario->id_grupo . $inventario->id_cuenta . $inventario->id_subcuenta_real . $inventario->idinventarios; ?></td>
        <td>
            <?= $this->Html->link($inventario->nombre,
            ['controller' => 'Inventarios', 'action' => 'view', $inventario->idinventarios]) ?>
        </td>
        <td><?php foreach($ubicaciones as $ubicacion){
          if($inventario->id_ubicacion == $ubicacion->idubicaciones){
            echo $ubicacion->nombre;
          }
        } ?></td>
        <td><?php foreach($cuentas as $cuenta){
            if($inventario->id_cuenta == $cuenta->idcuentas_puc){
              echo $cuenta->nombre;
            }
        } ?></td>
        <td><?php foreach($subcuentas as $subcuenta){
            if($inventario->id_subcuenta == $subcuenta->idsubcuentas_puc){
              echo $subcuenta->nombre;
            }
        } ?>
      </td>
      <td>
        <?= $inventario->cantidad; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <tfooter>
    <tr>
        <th>Codigo</th>
        <th>Nombre de Producto</th>
        <th>Ubicación</th>
        <th>Cuenta</th>
        <th>Sub Cuentas</th>
        <th>Cantidad</th>
    </tr>
  </tfooter>
</table>

</div>
</div>
</div>
