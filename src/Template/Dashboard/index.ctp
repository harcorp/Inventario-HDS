<section class="content">
    <div class="row">
      <div <?php if($usuario['role'] != 1){ ?> class="col-lg-6 col-xs-6" <?php }else{ ?>class="col-lg-3 col-xs-6"<?php } ?>>
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?= $cant_productos ?></h3>

            <p>Producto(s)</p>
          </div>
          <div class="icon">
            <i class="ion ion-cube"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6" <?php if($usuario['role'] != 1){ ?> style="display:none" <?php } ?>>
        <!-- small box -->
        <div class="small-box bg-red" >
          <div class="inner">
            <h3><?= $cant_usuarios ?></h3>

            <p>Usuario(s)</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-stalker"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= $valor_total ?></h3>

            <p>Costo total inventario</p>
          </div>
          <div class="icon">
            <i class="ion ion-social-usd"></i>
          </div>
        </div>
      </div>
    </div>

</div>
