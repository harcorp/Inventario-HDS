<!-- File: src/Template/Inventarios/add.ctp -->

<?php
$this->assign('title', 'Agregar inventarios');
?>
<script type="text/javascript">
   var lastid = 0;
   lastid = <?php echo $lastid + 1 ?>;
   var codigocentro = 0;
   codigocentro = <?php echo $idcentro; ?>;
</script>
<div class="col-lg-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Agregar producto</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
<div style="display:block; width:100%; text-align: right">
Codigo unico: <b><span class="codigounicotext"></span></b>
</div>
<form method="post" accept-charset="utf-8" action="/~davidrodriguez/inventario/inventarios/add">
  <div class="col-md-12">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" length="70" required="required" maxlength="70" id="nombre">
  </div>
  <div class="col-md-3 fecha margen-superior">
    <label>Fecha de compra*</label>
    <input type="text" class="form-control" name="fecha_compra" required="required" id="fecha_compra">
  </div>
  <div class="col-md-3 margen-superior">
    <label for="valor">Valor de la compra*</label>
    <input type="number" class="form-control" required="required" name="valor" id="valor">
  </div>
  <div class="col-md-2 margen-superior">
    <label for="cantidad">Cantidad*</label>
    <input type="number" class="form-control" required="required" name="cantidad" id="cantidad" value="1" />
  </div>
  <div class="col-md-4 margen-superior">
    <label for="id_ubicacion">Seleccione ubicación</label>
    <select name="id_ubicacion" id="id_ubicacion" class="form-control">
      <option value="" disabled selected>Seleccione una opción</option>
    <?php foreach($ubicaciones as $ubicacion){ ?>
      <option value="<?php echo $ubicacion['idubicaciones']; ?>">
        <?php echo $ubicacion['nombre']; ?>
      </option>
    <?php } ?>
    </select>
  </div>
  <div class="col-md-5 margen-superior">
      <label for="metodo_depreciacion">Metodo de depreciación</label>
      <input type="text" disabled class="form-control" value="Depreciación Lineal" name="metodo_depreciacion" id="metodo_depreciacion">
  </div>
  <div class="col-md-5 margen-superior">
      <label for="metodo_depreciacion">Tiempo de depreciación</label>
      <input type="number" class="form-control" value="1" name="tiempo_depreciacion" id="tiempo_depreciacion" required="required">
  </div>
  <div class="col-md-6 clase margen-superior">
    <label for="id_clase">Seleccionar clase*</label>
    <select name="id_clase" id="id_clase" class="form-control" required="required">
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
    <select name="id_grupo" id="id_grupo" class="form-control" required="required">
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
    <select name="id_cuenta" id="id_cuenta" class="form-control" required="required">
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
  <div class="col-md-12 margen-superior">
      <label for="textarea1">Observaciones</label>
  <textarea id="observaciones" name="observaciones" class="form-control" maxlength="255" length="255"></textarea>

</div>
<input name="codigounico" id="codigounico" value="<?php echo $lastid + 1; ?>" type="hidden" />
  <div class="col-md-12 margen-superior">
  <button type="submit" class="btn btn-lg btn-primary">Guardar Producto</button>
</div>
</form>
</div>
</div>
</div>
