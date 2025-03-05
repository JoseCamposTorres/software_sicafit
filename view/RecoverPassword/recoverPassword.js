$(document).on("click", "#btnupdate", function () {
    var pass = $('#txtpass').val().trim();
    var newpass = $('#txtpassnew').val().trim();

    if (pass === "" || newpass === "") {
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: "warning",
            title: "Ingrese todos los campos requeridos",
            showConfirmButton: false,
            timer: 3000
        });
    } else {
        if (pass === newpass) {
            Swal.fire({
                title: "¿Está seguro?",
                text: "Se actualizará su contraseña, ¿desea continuar?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Sí, actualizar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    var usu_id = $('#user_idx').val();
                    $.post("../../controller/usuarioController.php?op=password", { usu_id: usu_id, usu_pass: newpass }, function (data) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "success",
                            title: "Contraseña actualizada correctamente",
                            showConfirmButton: false,
                            timer: 3000
                        });
                        limpiarCampos();
                    });
                }
            });
        } else {
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "Las contraseñas no coinciden",
                showConfirmButton: false,
                timer: 3000
            });
        }
    }
});

function limpiarCampos() {
    $('#txtpass').val("");
    $('#txtpassnew').val("");
}
