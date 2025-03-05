/**Variables */
var tabla;
var usu_id = $("#user_idx").val();

/**Inicializar tablas modal */
$(document).ready(function () {
    tabla = $('#detenido_data').dataTable({
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
            url: '../../controller/detenidoController.php?op=listar',
            type: "post",
            data: {
                usu_id: usu_id,
              },
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

/**Funcion para desactivar Detenido */
function desactive(detenido_id) {
    Swal.fire({
        title: 'Desactivar',
        text: "¿Está seguro de desactivar el detenido?",
        icon: 'warning', 
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, desactivar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../../controller/detenidoController.php?op=desactive", { detenido_id: detenido_id }, function (data) {
                let response = JSON.parse(data);
                if (response.status === "success") {
                    $('#detenido_data').DataTable().ajax.reload();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al desactivar el detenido',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            });
        }
    });
}

/** Función para activar detenido */
function active(detenido_id) {  
    Swal.fire({
        title: 'Activar',
        text: "¿Está seguro de activar el detenido?",
        icon: 'warning', 
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, activar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../../controller/detenidoController.php?op=active", { detenido_id: detenido_id }, function (data) {
                let response = JSON.parse(data); 
                if (response.status === "success") {
                    $('#detenido_data').DataTable().ajax.reload();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al activar el detenido',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            });
        }
    });
}
