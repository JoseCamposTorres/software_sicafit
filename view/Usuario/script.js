/**Variables */
var tabla;

/**Funcion para inicializar componentes */
function init() {
    $("#usuario_form").on("submit", function (e) {
        saveAndEdit(e);
    });
    $("#usuario_form_password").on("submit", function (e) {
        newPassaword(e);
    });
}

/**Inicializar tablas modal */
$(document).ready(function () {
    $.post("../../controller/usuarioController.php?op=comboBoxDepen", function (data, status) {
        $('#depen_id').html(data);
    });

    $.post("../../controller/usuarioController.php?op=comboBoxCargo", function (data, status) {
        $('#cargo_id').html(data);
    });

    tabla = $('#usuario_data').dataTable({
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
            url: '../../controller/usuarioController.php?op=listar',
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
$(document).on("click", "#btn_usuario_new", function () {
    $('#mdltitulo').html('Registrar Usuario');
    $('#btnAccion').html('Registrar');
    $('#modalmantenimiento').modal('show');
    $('#usu_id').val('');
    $('#usuario_form')[0].reset();
    $('#usu_rol').val('0').trigger('change'); 
    $('#usu_photo').val('0').trigger('change'); 
    $('#div_usu_password').show();
});

/**Funcion para añadir y editar Cargo */
function saveAndEdit(e) {
    e.preventDefault();
    var usu_dni = $("#usu_dni").val();
    var usu_name = $("#usu_name").val();
    var usu_lastname = $("#usu_lastname").val();
    var usu_email = $("#usu_email").val();
    var usu_rol = $("#usu_rol").val();
    var cargo_id = $("#cargo_id").val();
    var depen_id = $("#depen_id").val();
    if (
        usu_dni === "" ||
        usu_name === "" ||
        usu_lastname === "" ||
        usu_email === "" ||
        usu_rol === "0"||
        cargo_id === "0"||
        depen_id === "0"
    ) {
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: "error",
            title: "Por favor complete todos los campos.",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
        return;
    }

    var formData = new FormData($("#usuario_form")[0]);

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
                url: "../../controller/usuarioController.php?op=saveAndEdit",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (datos) {
                    if (datos.status === "error") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: datos.message,
                        });
                    } else {
                        $('#usuario_form')[0].reset();
                        $('#modalmantenimiento').modal('hide');
                        $('#usuario_data').DataTable().ajax.reload();
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
                },
            });            
        }
    });
}

/**Inicializacion de la función */
init();

/**Funcion para editar usuario */
function edit(usu_id) {
    $('#mdltitulo').html('Editar Usuario');
    $('#btnAccion').html('Editar');

    $.post("../../controller/usuarioController.php?op=view", { usu_id: usu_id }, function (data) {
        data = JSON.parse(data);
        $('#usu_id').val(data.usu_id);
        $('#usu_name').val(data.usu_name);
        $('#usu_lastname').val(data.usu_lastname);
        $('#usu_dni').val(data.usu_dni);
        $('#usu_rol').val(data.usu_rol).trigger("change");
        $('#usu_email').val(data.usu_email);
        $('#usu_telfijo').val(data.usu_telfijo);
        $('#usu_anexo').val(data.usu_anexo);
        $('#usu_cel').val(data.usu_cel);
        $('#usu_password').removeAttr('required'); 
        $('#div_usu_password').hide();
        let photoPath = data.usu_photo.replace(/\\/g, '/'); 
        $('#usu_photo').val(photoPath);
        $('#usu_photo').selectpicker('refresh');
        $('#depen_id').val(data.depen_id).trigger("change");
        $('#cargo_id').val(data.cargo_id).trigger("change");

    });
    $('#modalmantenimiento').modal('show');
    $('#usuario_data').DataTable().ajax.reload();

}

/**CAMBIAR CONTRASEÑA  */
function password(usu_id){
    $('#modalmantenimientoPassword').modal('show');
    $('#mdltituloPassword').html('Cambiar Contraseña');
    $('#btnAccionpassword').html('Editar');

    $.post("../../controller/usuarioController.php?op=view", { usu_id: usu_id }, function (data) {
        data = JSON.parse(data);
        $('#usu_id_password').val(data.usu_id);
        $('#usu_password_new').val(data.usu_password);
    });
    $('#usuario_data').DataTable().ajax.reload();
}

/**Funcion para añadir y editar Cargo */
function newPassaword(e) {
    e.preventDefault();
    var formData = new FormData($("#usuario_form_password")[0]);

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
                url: "../../controller/usuarioController.php?op=newPassword",
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
                        $('#usuario_form_password')[0].reset();
                        $('#modalmantenimientoPassword').modal('hide');
                        $('#usuario_data').DataTable().ajax.reload();
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

/**Funcion para desactivar usuario */
function desactive(usu_id) {
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
            $.post("../../controller/usuarioController.php?op=desactive", { usu_id: usu_id }, function (data) {
                let response = JSON.parse(data);
                if (response.status === "success") {
                    $('#usuario_data').DataTable().ajax.reload();
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
                        title: 'Error al desactivar el usuario',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            });
        }
    });
}

/** Función para activar usuario */
function active(usu_id) {  
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
            $.post("../../controller/usuarioController.php?op=active", { usu_id: usu_id }, function (data) {
                let response = JSON.parse(data); 
                if (response.status === "success") {
                    $('#usuario_data').DataTable().ajax.reload();
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
                        title: 'Error al activar el usuario',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            });
        }
    });
}
