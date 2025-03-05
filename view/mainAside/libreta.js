$(document).ready(function () {
    function cargarUsuarios() {
        $.ajax({
            url: '../../controller/UsuarioController.php?op=listarLibreta',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                let listaUsuarios = $("#listaUsuarios");
                let totalUsuarios = $("#totalUsuarios");
                listaUsuarios.empty(); // Limpiar lista antes de agregar

                if (data.length > 0) {
                    totalUsuarios.text(data.length);
                    data.forEach(usuario => {
                        let usuarioHtml = `
                            <a href="#" class="list-group-item">
                                <div class="media-left pos-rel">
                                    <img class="img-circle img-xs" src="../../public/${usuario.usu_photo}" alt="Profile Picture">
                                    <i class="badge badge-success badge-stat badge-icon pull-left"></i>
                                </div>
                                <div class="media-body">
                                    <p class="mar-no text-main">${usuario.usu_name} ${usuario.usu_lastname}</p>
                                    <small class="text-muted">${usuario.usu_email}</small><br>
                                    <small class="text-muted">Anexo: ${usuario.usu_anexo}</small>
                                </div>
                            </a>
                        `;
                        listaUsuarios.append(usuarioHtml);
                    });
                } else {
                    listaUsuarios.append('<p class="text-center">No hay usuarios registrados</p>');
                }
            },
            error: function (error) {
                console.error("Error al obtener usuarios:", error.responseText);
            }
        });
    }

    // Llamar la función al cargar la página
    cargarUsuarios();
});
