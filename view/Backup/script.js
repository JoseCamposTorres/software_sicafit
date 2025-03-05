function generarBackup() {
  // Mostrar la barra de progreso
  var urlBase = "http://localhost/SICAFIT/";
  const progressBarContainer = document.getElementById("progress-container");
  const progressBar = document.getElementById("progress-bar");
  progressBarContainer.style.display = "block";
  progressBar.style.width = "0%";
  progressBar.innerText = "0%";

  // Simulación de progreso (opcional)
  let progress = 0;
  const interval = setInterval(() => {
    if (progress < 90) {
      progress += 10;
      progressBar.style.width = progress + "%";
      progressBar.innerText = progress + "%";
    } else {
      clearInterval(interval);
    }
  }, 300); // Simula el progreso

  // Hacer la petición para generar la copia de seguridad
  fetch(urlBase + "controller/api/backupController.php?op=generar")

    .then((response) => {
      clearInterval(interval);
      progressBar.style.width = "100%";
      progressBar.innerText = "100%";

      if (response.ok) {
        // Si la petición se completa correctamente, mostrar mensaje de éxito
        Swal.fire({
          icon: "success",
          title: "Copia de seguridad generada",
          text: "La base de datos ha sido guardada exitosamente.",
        });
      } else {
        // Si hay algún error en la petición, mostrar mensaje de error
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un problema al generar la copia de seguridad de la base de datos.",
        });
      }

      // Ocultar la barra después de 2s solo si el proceso terminó correctamente
      setTimeout(() => {
        progressBarContainer.style.display = "none";
      }, 2000);
    })
    .catch((error) => {
      clearInterval(interval);
      console.error("Error al generar la copia de seguridad:", error);
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Hubo un problema al conectar con el servidor.",
      });

      // Ocultar la barra de progreso inmediatamente
      progressBarContainer.style.display = "none";
    });
}

/**Variables */
var tabla;

/**Inicializar tablas modal */
$(document).ready(function () {
    tabla = $('#backup_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "searching": true,
        lengthChange: true,
        colReorder: true,
        buttons: [{
            extend: 'excelHtml5',
            footer: true,
            text: '<i class="fa fa-file-excel-o" style="color: green;"></i>'
        },
        //Botón para PDF
        {
            extend: 'pdf',
            footer: true,
            text: '<i class="fa fa-file-pdf-o" style="color: red;"></i>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<i class="fa fa-copy" style="color: blue;"></i>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<i class="fa fa-print" style="color: #000;"></i>'
        },
        //Colvis
        {
            extend: 'colvis',
            text: '<i class="fa fa-columns" style="color: #34495e;"></i>',
            postfixButtons: ['colvisRestore']
        }
        ],
        "ajax": {
            url: '../../controller/api/backupController.php?op=listar',
            type: "post",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "ordering": true,
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 5,
        "autoWidth": false,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();
});
