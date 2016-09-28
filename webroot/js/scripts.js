

$(function() {

    $(".btn-confirm").on("click", function () {
       var action = $(this).attr('data-action');
       console.log(action);
       $("form").attr('action',action);
    });
    $(".grupo").hide();
    $(".cuenta").hide();
    $(".subcuenta").hide();

    clase = 0;
    grupo = 0;
    cuenta = 0;
    subcuenta = 0;

    $('#id_clase').change(function() {
      if($(this).val() == "1"){
        $('.grupo').fadeIn("slow");
        clase = $(this).val();
        $('.codigounicotext').text("" + codigocentro + clase + lastid);
        $('#codigounico').val("" + codigocentro + clase + lastid);
      }
    });
    $('#id_grupo').change(function(){
      if($(this).val() == "5"){
        $('.cuenta').fadeIn("slow");
        grupo = $(this).val();
        $('.codigounicotext').text("" + codigocentro + clase + grupo + lastid);
        $('#codigounico').val("" + codigocentro + clase + grupo + lastid);
      }
    });

    $('#id_cuenta').change(function(){
      cuenta = $(this).val();
      $('.optcuenta').hide();
      $('.optcuenta').each(function(){
        if($(this).attr('cuenta') == cuenta){
          $(this).show();
        }
      });
      $(".subcuenta").fadeIn("fast");
      $('.id_subcuenta').val("").change();
      $('.codigounicotext').text("" + codigocentro + clase + grupo + cuenta + lastid);
      $('#codigounico').val("" + codigocentro + clase + grupo + cuenta + lastid);
    });
        if(editar == 1){
            $(".ciudad").hide();
          $('#departamento').change(function(){
            departamento = $(this).find(':selected').attr('data-value');
            $('.optciudad').hide();
            $('.optciudad').each(function(){
              if($(this).attr('departamento') == departamento){
                $(this).show();
              }
            });
            $(".ciudad").fadeIn("fast");
            $('.ciudad').val("").change();
          });
        }



    $('#id_subcuenta').change(function(){
      subcuenta = $('option:selected', this).attr('subcuenta');
      $('.codigounicotext').text("" + codigocentro + clase + grupo + cuenta + subcuenta + lastid);
      $('#codigounico').val("" + codigocentro + clase + grupo + cuenta + subcuenta + lastid);
    });


    $("#reportes").DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: 'Guardar Tabla PDF',
                orientation: 'landscape',
                pageSize: 'LETTER',
                title: titulo + ' REPORTE INVENTARIO',
                message: mensaje,
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                },
            }
        ],
        "paging": false,
        "pageLength": 500,
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
    } );
});


 $.fn.datepicker.dates['en'] = {
     days: ["Domingo", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
     daysShort: ["Dom", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
     daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
     months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
     monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
     today: "Hoy",
     clear: "Limpiar",
     format: "mm/dd/yyyy",
     titleFormat: "MM yyyy",
     weekStart: 1
 };

 $('.fecha input').datepicker({
   todayBtn: "linked",
   autoclose: true,
   orientation: "bottom",
   todayHighlight: true,
   format: {
      /*
       * Say our UI should display a week ahead,
       * but textbox should store the actual date.
       * This is useful if we need UI to select local dates,
       * but store in UTC
       */
      toDisplay: function (date, format, language) {
          var d = new Date(date);
          d.setDate(d.getDate() + 1);
          return d.toLocaleDateString();
      },
      toValue: function (date, format, language) {
          var d = new Date(date);
          d.setDate(d.getDate() + 1);
          var year = d.getFullYear();
          var month = d.getMonth() + 1;
          var day = d.getDate();
          //return day + "-" + month + "-" + year;
      }
  }
 });
