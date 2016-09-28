
<?php
$titulos = "";
$this->assign('title', $inventario->nombre . " - " . $inventario->codigounico);
foreach($clases as $clase){if($clase['idclases_puc'] == $inventario['id_clase']){ $titulos = "Clase: <b>" . $clase['nombre'] . "</b> - " ;} };
foreach($grupos as $grupo){if($grupo['idgrupos_puc'] == $inventario['id_grupo']){ $titulos .= "Grupo: <b>" . $grupo['nombre'] . "</b> - " ;} };
foreach($cuentas as $cuenta){if($cuenta['idcuentas_puc'] == $inventario['id_cuenta']){ $titulos .= "Cuenta: <b>" . $cuenta['nombre'] . "</b>" ;} };
foreach($subcuentas as $subcuenta){if($subcuenta['idsubcuentas_puc'] == $inventario['id_subcuenta']){ $titulos .= " - Subuenta: <b>" . $subcuenta['nombre'] . "</b>" ;} };
?>
<div class="col-lg-12">
  <div class="box">
    <div class="box-header">
      <div class="col-md-9">
      <h3 class="box-title" style="font-size: 16px"><?php echo $titulos; ?></h3>
    </div>
      <?php
      if($usuario['role'] == 3){ ?>
          <a href="#" class="btn btn-app pull-right disabled"><i class="fa fa-remove"></i> Eliminar</a>
          <a href="#" class="btn btn-app pull-right disabled"><i class="fa fa-edit"></i> Editar</a>
    <?php
}else{
      echo $this->Html->link(
            '<i class="fa fa-remove"></i> Eliminar',
            ['controller' => 'Inventarios', 'action' => 'delete', $inventario->idinventarios],
            ['class' => 'btn btn-app pull-right', 'escape' => false]
        );
        echo $this->Html->link(
            '<i class="fa fa-edit"></i> Editar',
            ['controller' => 'Inventarios', 'action' => 'edit', $inventario->idinventarios],
            ['class' => 'btn btn-app pull-right', 'escape' => false]
        ); }?>

    </div>
    <!-- /.box-header -->
    <div class="box-body">
<h1><?= h($inventario->nombre) ?> - <?= h($codigounico) ?></h1>
<div class="row margen-superior">
  <div class="col-md-6" style="font-size: 18px">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Datos del producto</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
        <b>Fecha de compra: </b> <br>
        <?= $inventario->fecha_compra; ?><br>
        <?php if(!$resultado[0]['valor_dep'] < 0){
          ?>
          <b>Valor actual: </b><br><span style="color: #ff0000"><?= $resultado[0]['valor_dep'] ?></span><br />
        <?php }else{
          ?>
          <b>Valor actual: </b><br><?= $resultado[0]['valor_dep'] ?><br />
          <?php
        } ?>

    <b>Cantidad: </b><br><?= $inventario->cantidad ?><br />
    <b>Valor compra:</b><br><?= $resultado[0]['valor_com'] ?><br />
    <b>Tiempo de depreciación:</b><br><?= h($inventario->tiempo_depreciacion) ?> Años<br />
          <?php if($inventario->observaciones){ ?>
    <b>Observaciones:</b><br>
      <?php
      echo $inventario->observaciones;
    } ?>
  </div>
</div>
  </div>

    <div class="col-md-6">
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Grafica de depreciación</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="areaChart" style="height:250px"></canvas>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
</div>
</div>

<script>var valores_depreciacion = [];
            var nombres_meses = [];
  <?php foreach($resultado as $d){
          foreach($d['valores'] as $n){
    ?>
       valores_depreciacion.push(<?php echo $n['mes']; ?>);
 <?php
}
    foreach($d['nombres'] as $s){
      ?>
      nombres_meses.push("<?php echo $s['nom']; ?>");
      <?php
    }
}
?>
    </script>
