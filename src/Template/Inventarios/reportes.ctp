<?php
$this->assign('title', 'Reportes');
$titulo = "";
?>
<div class="col-lg-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Generar Reportes</h3>
    </div>
    <!-- /.box-header -->
    <?php
		// The base url is the url where we'll pass the filter parameters
		$base_url = array('controller' => 'Inventarios', 'action' => 'reportes');
		echo $this->Form->create("Filter",['url' => $base_url, 'class' => 'filter']);
        ?>
    <div class="box-body">
        <div class="row" <?php if($filtros[0] == 0){ ?>style="display: none"<?php } ?>>
            <div class="col-lg-12">
                <p>Filtrado por:
                    <?php
                    if($filtros[0] > 0){
                        foreach($clases as $clase){
                            if($filtros[0] == $clase->idclases_puc){
                              echo "<b>Clase: " . $clase->nombre . "</b>";
                              $titulo = $clase->nombre;
                            }
                        }
                    }
                    if($filtros[1] > 0){
                        foreach($grupos as $grupo){
                            if($filtros[1] == $grupo->idgrupos_puc){
                              echo "<b> | Grupo: " . $grupo->nombre . "</b>";
                              $titulo = $grupo->nombre;
                            }
                        }
                    }
                    if($filtros[2] > 0){
                        foreach($cuentas as $cuenta){
                            if($filtros[2] == $cuenta->idcuentas_puc){
                              echo "<b> | Cuenta: " . $cuenta->nombre . "</b>";
                              $titulo = $cuenta->nombre;
                            }
                        }
                    }
                    if($filtros[3] > 0){
                        foreach($subcuentas as $subcuenta){
                            if($filtros[3] == $subcuenta->idsubcuentas_puc){
                              echo "<b> | Subcuenta: " . $subcuenta->nombre . "</b>";
                              $titulo = $subcuenta->nombre;
                            }
                        }
                    }
                    ?>
                </p>
            </div>
        </div>
        <div class="row" <?php if($filtros[0] > 0){ ?>style="display: none"<?php } ?>>

            <div class="col-md-6 clase margen-superior">
              <label for="id_clase">Seleccionar clase*</label>
              <select name="id_clase" id="id_clase" class="form-control">
                <option value="" disabled selected>Seleccione una opción</option>
              <?php foreach($clases as $clase){ ?>
                <option value="<?php echo $clase['idclases_puc']; ?>">
                  <?php echo $clase['idclases_puc'] . " - " . $clase['nombre']; ?>
                </option>
              <?php } ?>
              </select>
            </div>
            <div class="col-md-6 grupo margen-superior">
              <label for="id_grupo">Seleccionar grupo*</label>
              <select name="id_grupo" id="id_grupo" class="form-control">
                <option value="" disabled selected>Seleccione una opción</option>
              <?php foreach($grupos as $grupo){ ?>
                <option value="<?php echo $grupo['idgrupos_puc']; ?>" clase="<?php echo $grupo['clases_puc_idclases_puc']; ?>">
                  <?php echo $grupo['idgrupos_puc'] . " - " . $grupo['nombre']; ?>
                </option>
              <?php } ?>
              </select>
            </div>
            <div class="col-md-6 cuenta margen-superior">
              <label for="id_cuenta">Seleccionar cuenta*</label>
              <select name="id_cuenta" id="id_cuenta" class="form-control">
                <option value="" disabled selected>Seleccione una opción</option>
              <?php foreach($cuentas as $cuenta){ ?>
                <option value="<?php echo $cuenta['idcuentas_puc']; ?>" grupo="<?php echo $cuenta['grupos_puc_idgrupos_puc']; ?>">
                  <?php echo $cuenta['idcuentas_puc'] . " - " . $cuenta['nombre']; ?>
                </option>
              <?php } ?>
              </select>
            </div>

            <div class="col-md-6 subcuenta margen-superior">
              <label for="id_subcuenta">Seleccionar subcuenta</label>
              <select name="id_subcuenta" id="id_subcuenta" class="form-control id_subcuenta">
                <option value="" disabled selected>Seleccione una opción</option>
              <?php foreach($subcuentas as $subcuenta){ ?>
                <option class="optcuenta" value="<?php echo $subcuenta['idsubcuentas_puc']; ?>" subcuenta="<?php echo $subcuenta['id']; ?>"cuenta="<?php echo $subcuenta['cuentas_puc_idcuentas_puc']; ?>">
                  <?php echo $subcuenta['id'] . " - " . $subcuenta['nombre']; ?>
                </option>
              <?php } ?>
              </select>
            </div>
        </div>
        <div class="row margen-superior">
            <div class="col-md-1" <?php if($filtros[0] > 0){ ?>style="display: none"<?php } ?>>
                <?= $this->Form->submit('Generar', ['class' => 'btn btn-primary']);?>
            </div>
            <div class="col-md-1" <?php if($filtros[0] == 0){ ?>style="display: none"<?php } ?>>
                <?php echo $this->Html->link(
                      'Reiniciar Filtros',
                      ['controller' => 'Inventarios', 'action' => 'reportes'],
                      ['class' => 'btn btn-primary']
                  ); ?>
            </div>
        </div>
        <div class="row margen-superior">
          <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?= $resultado[0]['cant_total'] ?></h3>

                <p>Producto(s)</p>
              </div>
              <div class="icon">
                <i class="ion ion-cube"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-5 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?= $resultado[0]['val_total']  ?></h3>

                <p>Valor Inventario</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-5 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?= $resultado[0]['dep_total']  ?></h3>

                <p>Depreciación Total</p>
              </div>
              <div class="icon">
                <i class="ion ion-social-usd"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="row margen-superior">
            <div class="col-md-12">
                <table class="table table-bordered table-hover" id="reportes">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Producto</th>
                        <th>Costo</th>
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
                        <td><?php setlocale(LC_MONETARY, 'en_US.UTF-8');
$valor = money_format('%.0n', $inventario->valor); $valor = str_replace(",", ".", $valor); echo $valor;?></td>
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
                          <?= $inventario->cantidad ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfooter>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Producto</th>
                        <th>Costo</th>
                        <th>Cuenta</th>
                        <th>Sub Cuentas</th>
                        <th>Cantidad</th>
                    </tr>
                  </tfooter>
                </table>
            </div>
    </div>
</div>

<script>
    var titulo = "<?= $titulo ?>";
    var mensaje = "Cantidad Productos: <?= $resultado[0]['cant_total'] ?> | Valor Inventario: <?= $resultado[0]['val_total'] ?> | Depreciación Total: <?= $resultado[0]['dep_total'] ?>";
</script>
