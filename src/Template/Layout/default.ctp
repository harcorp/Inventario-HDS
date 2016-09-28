<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Hermanas Divino Salvador';
?>
<!DOCTYPE html>
<script>
    var editar = 10;
    var titulo = "";
    var mensaje = "";
</script>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>
        <?= $this->fetch('title') ?> |
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('AdminLTE.min.css') ?>
    <?= $this->Html->css('skins/_all-skins.min.css') ?>
    <?= $this->Html->css('/plugins/iCheck/flat/blue.css') ?>
    <?= $this->Html->css('/plugins/morris/morris.css') ?>
    <?= $this->Html->css('/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>
    <?= $this->Html->css('/plugins/datepicker/datepicker3.css') ?>
    <?= $this->Html->css('/plugins/daterangepicker/daterangepicker-bs3.css') ?>
    <?= $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>
    <?= $this->Html->css('/plugins/tables/datatables.min.css') ?>
    <?= $this->Html->css('tema.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('scripts') ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <header class="main-header">
      <?php echo $this->Html->link(
                        '<span class="logo-mini"><b>I</b> HDS</span><span class="logo-lg"><b>Inventario</b> CDS</span>',
                        ['controller' => 'Dashboard', 'action' => 'index'],
                        ['escape' => false, 'class' => 'logo']
                    ); ?>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                  if($usuario['sexo'] == 1){
                      echo $this->Html->image('avatar5.png', ['alt' => 'CakePHP', 'class' => 'user-image']);
                  }else{
                      echo $this->Html->image('avatar3.png', ['alt' => 'CakePHP', 'class' => 'user-image']);
                  }?>
              <span class="hidden-xs"><?= $usuario['nombres'] . " " . $usuario['apellidos'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                  <?php
                    if($usuario['sexo'] == 1){
                        echo $this->Html->image('avatar5.png', ['alt' => 'CakePHP', 'class' => 'img-circle']);
                    }else{
                        echo $this->Html->image('avatar3.png', ['alt' => 'CakePHP', 'class' => 'img-circle']);
                    }?>

                <p>
                  <?= $usuario['nombres'] . " " . $usuario['apellidos'] ?>
                  <small><?php switch($usuario['role']){
                        case 1:
                            echo "Super Administrador";
                            break;
                        case 2:
                            echo "Administrador";
                            break;
                        case 3:
                            echo "Usuario";
                            break;
                  } ?> </small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <?= $this->Html->link(
    'Cerrar Sesión',
    ['controller' => 'Users', 'action' => 'logout'],
        ['class' => 'btn btn-default btn-flat']
); ?>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>


  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php
            if($usuario['sexo'] == 1){
                echo $this->Html->image('avatar5.png', ['alt' => 'CakePHP', 'class' => 'img-circle']);
            }else{
                echo $this->Html->image('avatar3.png', ['alt' => 'CakePHP', 'class' => 'img-circle']);
            }?>
        </div>
        <div class="pull-left info">
          <p><?= $usuario['nombres'] . " " . $usuario['apellidos'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>En Linea</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Principal</li>
        <li class="treeview">
<?php echo $this->Html->link(
                  '<i class="fa fa-dashboard"></i> <span>Dashboard</span>',
                  ['controller' => 'Dashboard', 'action' => 'index'],
                  ['escape' => false]
              ); ?>
        </li>
        <li class="treeview" <?php if($usuario['role'] != 1){?>style="display:none"<?php } ?>>
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Centros de costo</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><?php echo $this->Html->link(
                  '<i class="fa fa-circle-o"></i> Listar',
                  ['controller' => 'Centros', 'action' => 'index'],
                  ['escape' => false]
              ); ?></li>
            <li><?php echo $this->Html->link(
                  '<i class="fa fa-circle-o"></i> Agregar',
                  ['controller' => 'Centros', 'action' => 'add'],
                  ['escape' => false]
              ); ?></li>
          </ul>
        </li>
        <li <?php if($usuario['role'] == 3){?>style="display:none"<?php } ?>><a href="#">
            <i class="fa fa-th"></i> <span>Usuarios</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <?php echo $this->Html->link(
                    '<i class="fa fa-circle-o"></i> Listar',
                    ['controller' => 'Users', 'action' => 'index'],
                    ['escape' => false]
                ); ?></li>
            <li><?php echo $this->Html->link(
                  '<i class="fa fa-circle-o"></i> Agregar',
                  ['controller' => 'Users', 'action' => 'add'],
                  ['escape' => false]
              ); ?></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Inventarios</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><?php echo $this->Html->link(
                  '<i class="fa fa-circle-o"></i> Listar',
                  ['controller' => 'Inventarios', 'action' => 'index'],
                  ['escape' => false]
              ); ?> </li>
              <li><?php echo $this->Html->link(
                    '<i class="fa fa-circle-o"></i> Agregar',
                    ['controller' => 'Inventarios', 'action' => 'add'],
                    ['escape' => false]
                ); ?> </li>
            <li><?php echo $this->Html->link(
                  '<i class="fa fa-circle-o"></i> Ubicaciones',
                  ['controller' => 'Ubicaciones', 'action' => 'index'],
                  ['escape' => false]
              ); ?> </li>
          <li <?php if($usuario['role'] == 3){?>style="display:none"<?php } ?>><?php echo $this->Html->link(
                '<i class="fa fa-circle-o"></i> Reportes',
                ['controller' => 'Inventarios', 'action' => 'reportes'],
                ['escape' => false]
            ); ?> </li>
          </ul>
        </li>
      </ul>
      <div style="text-align: center; padding: 10px; width: 100%">
        <?= $this->Html->image('logo.png', ['alt' => 'Hermanas del Divino Salvador', 'class' => 'logo', 'style' => 'width: 80%']); ?>
    </div>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $this->fetch('title') ?>
        <small>Panel de control</small>
      </h1>
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Dashboard</li>
      </ol>-->
    </section>

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?= $this->Flash->render() ?>
      <div class="row">
        <?= $this->fetch('content') ?>
      </div>
      </section>


  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versión</b> 1.0.0
    </div>
    Copyright &copy; 2016 - <strong>Hermanas del Divino Salvador.</strong> Todos los derechos reservados | Desarrollado por <strong> <a href="http://harcorp.com.co">Harcorp Colombia</a></strong>
  </footer>

    <?= $this->Html->script('/plugins/jQuery/jQuery-2.2.0.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('/plugins/chartjs/Chart.min.js') ?>
    <?= $this->Html->script('/plugins/datepicker/bootstrap-datepicker.min') ?>
    <?= $this->Html->script('/plugins/tables/datatables.min.js') ?>
    <?= $this->Html->script('/plugins/slimScroll/jquery.slimscroll.min.js') ?>
    <?= $this->Html->script('/plugins/fastclick/fastclick.js') ?>
    <?= $this->Html->script('app.min') ?>
    <?= $this->Html->script('demo') ?>
    <?= $this->Html->script('scripts') ?>
    <script>
      $(function () {

        $('#example2').DataTable({
          "pageLength": 50,
          "language": {
            "lengthMenu": "Mostrar _MENU_ por página",
            "search": "Buscar: ",
            "zeroRecords": "Nada que mostrar",
            "info": "Mostrando _PAGE_ de _PAGES_",
            "infoEmpty": "Ningun registro",
            "infoFiltered": "(filtered from _MAX_ total records)",
            paginate: {
              first:      "Primero",
              previous:   "Anterior",
              next:       "Siguiente",
              last:       "Ultima"
          },
        }
        });
      });
    </script>
    <?php if($this->request->params['controller'] == "Inventarios"){?>
    <script>
      $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);
        var areaChartData = {

          labels: nombres_meses,
          datasets: [
            {
              label: "Valores",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#000",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: valores_depreciacion
            }
          ]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: true,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          //legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          tooltipTemplate: "$<%= addCommas(value) %>",
          scaleLabel: "$<%= addCommas(value) %>",
        };
        areaChartOptions.datasetFill = false;
        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);


      });
      function addCommas(nStr)
    {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1;
    }
    </script>

    <?php } ?>
</body>
</html>
