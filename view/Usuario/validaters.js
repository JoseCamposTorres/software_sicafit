$('#buscar').click(function () {
    buscarUsuario();
});

$('#usu_dni').keypress(function (event) {
    if (event.which == 13) {
        buscarUsuario();
    }
});

function buscarUsuario() {
    var dni = $('#usu_dni').val();
    let timerInterval;

    Swal.fire({
        title: "Buscando usuario...",
        html: "Espere <b></b> segundos.",
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    });

    $.ajax({
        url: '../../controller/reniecController.php',
        type: 'post',
        data: { dni: dni },
        dataType: 'json',
        success: function (r) {
            Swal.close();
            if (r.numeroDocumento == dni) {
                let apellidoPaterno = capitalizarTexto(r.apellidoPaterno);
                let apellidoMaterno = capitalizarTexto(r.apellidoMaterno);
                let nombres = capitalizarTexto(r.nombres);


               $('#usu_lastname').val(apellidoPaterno + ' ' + apellidoMaterno);
                $('#usu_name').val(nombres);

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Usuario encontrado correctamente',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
           
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'No se encontró el usuario',
                    text: r.error || 'El DNI ingresado no existe.',
                    showConfirmButton: false,
                    timer: 3000
                });
                $('#usu_lastname').val('');
                $('#usu_name').val('');

            }
        },
        error: function () {
            Swal.close();
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo cargar los datos.',
                showConfirmButton: false,
                timer: 3000
            });
            $('#usu_lastname').val('');
            $('#usu_name').val('');
        }
    });
}

function OnlyLetters(e) {
    let key = e.keyCode || e.which;
    let tecla = String.fromCharCode(key);
    let letters = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnopqrstuvwxyzáéíóú.- ";
    let specialKeys = [8, 13]; // 8 = Backspace, 13 = Enter

    // Permitir teclas especiales
    if (specialKeys.includes(key)) return true;

    // Validar si la tecla presionada está en el conjunto permitido
    if (!letters.includes(tecla)) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'warning',
            title: 'Solo se permiten letras',
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    }
}

function OnlyNumbers(e) {
    let key = e.keyCode || e.which;
    let tecla = String.fromCharCode(key);
    let numbers = "0123456789";
    let specialKeys = [8, 13]; // 8 = Backspace, 13 = Enter

    // Permitir teclas especiales
    if (specialKeys.includes(key)) return true;

    // Validar si la tecla presionada es un número
    if (!numbers.includes(tecla)) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'warning',
            title: 'Ingrese solo números',
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    }

    // Validar que no se ingresen más de 8 dígitos
    let fieldValue = e.target.value.replace(/[^\d]/g, ''); // Filtrar solo números
    if (fieldValue.length >= 8) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'warning',
            title: 'Solo se permiten 8 números',
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    }
}

function OnlyNumbers2(e) {
    let key = e.keyCode || e.which;
    let tecla = String.fromCharCode(key);
    let numbers = "0123456789";
    let specialKeys = [8, 13]; // 8 = Backspace, 13 = Enter

    // Permitir teclas especiales
    if (specialKeys.includes(key)) return true;

    // Validar si la tecla presionada es un número
    if (!numbers.includes(tecla)) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'warning',
            title: 'Ingrese solo números',
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    }

    // Validar que no se ingresen más de 8 dígitos
    let fieldValue = e.target.value.replace(/[^\d]/g, ''); // Filtrar solo números
    if (fieldValue.length >= 9) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'warning',
            title: 'Solo se permiten 9 números',
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    }
}

function OnlyNumbers3(e) {
    let key = e.keyCode || e.which;
    let tecla = String.fromCharCode(key);
    let numbers = "0123456789";
    let specialKeys = [8, 13]; // 8 = Backspace, 13 = Enter

    // Permitir teclas especiales
    if (specialKeys.includes(key)) return true;

    // Validar si la tecla presionada es un número
    if (!numbers.includes(tecla)) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'warning',
            title: 'Ingrese solo números',
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    }

    // Validar que no se ingresen más de 8 dígitos
    let fieldValue = e.target.value.replace(/[^\d]/g, ''); // Filtrar solo números
    if (fieldValue.length >= 5) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'warning',
            title: 'Solo se permiten 5 números',
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    }
}

function capitalizarTexto(texto) {
    return texto.toLowerCase().replace(/\b\w/g, letra => letra.toUpperCase());
}