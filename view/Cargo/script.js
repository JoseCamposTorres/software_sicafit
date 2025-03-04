/**Variables */
var tabla;

/**Funcion para inicializar componentes */
function init() {
    $("#cargo_form").on("submit", function (e) {
        saveAndEdit(e);
    });
}

/**Inicializar tablas modal */
$(document).ready(function () {
    tabla = $('#cargo_data').dataTable({
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
            url: '../../controller/cargoController.php?op=listar',
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

/**Abri modal */
$(document).on("click", "#btn_cargo_new", function () {
    $('#mdltitulo').html('Registrar Cargo');
    $('#btnAccion').html('Registrar');
    $('#modalmantenimiento').modal('show');
    $('#cargo_id').val('');
    $('#cargo_form')[0].reset();
});

/**Funcion para añadir y editar Cargo */
function saveAndEdit(e) {
    e.preventDefault();
    var formData = new FormData($("#cargo_form")[0]);

    Swal.fire({
        title: '¡Recordatorio!',
        text: "¿Está seguro de realizar esta opción?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'Cancelar'
    }).then((result) => {

        if (result.isConfirmed) {
            $.ajax({
                url: "../../controller/cargoController.php?op=saveAndEdit",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (datos) {
                    console.log(datos);
                    if (datos.status === "error") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: datos.message,
                        });
                    } else {
                        $('#cargo_form')[0].reset();
                        $('#modalmantenimiento').modal('hide');
                        $('#cargo_data').DataTable().ajax.reload();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: datos.message,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }
                }
            });            
        }
    });
}

/**Inicializacion de la función */
init();

/**Funcion para editar Cargo */
function edit(cargo_id) {
    $('#mdltitulo').html('Editar Cargo');
    $('#btnAccion').html('Editar');

    $.post("../../controller/cargoController.php?op=view", { cargo_id: cargo_id }, function (data) {
        data = JSON.parse(data);
        $('#cargo_id').val(data.cargo_id);
        $('#cargo_name').val(data.cargo_name);
    });
    $('#modalmantenimiento').modal('show');
    $('#cargo_data').DataTable().ajax.reload();

}

/**Funcion para desactivar Cargo */
function desactive(cargo_id) {
    Swal.fire({
        title: 'Desactivar',
        text: "¿Está seguro de desactivar el cargo?",
        icon: 'warning', 
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, desactivar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../../controller/cargoController.php?op=desactive", { cargo_id: cargo_id }, function (data) {
                let response = JSON.parse(data);
                if (response.status === "success") {
                    $('#cargo_data').DataTable().ajax.reload();
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
                        title: 'Error al desactivar el cargo',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            });
        }
    });
}

/** Función para activar Cargo */
function active(cargo_id) {  
    Swal.fire({
        title: 'Activar',
        text: "¿Está seguro de activar el cargo?",
        icon: 'warning', 
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, activar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../../controller/cargoController.php?op=active", { cargo_id: cargo_id }, function (data) {
                let response = JSON.parse(data); 
                if (response.status === "success") {
                    $('#cargo_data').DataTable().ajax.reload();
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
                        title: 'Error al activar el cargo',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            });
        }
    });
}
