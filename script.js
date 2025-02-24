if (performance.navigation.type === 1) { 
    window.location.href = "./";
}

document.addEventListener("DOMContentLoaded", function () {
    const dniInput = document.getElementById("usu_dni");
    const passwordInput = document.getElementById("hide-show-password");
    const btnIngresar = document.getElementById("btnIngresar");

    dniInput.value = localStorage.getItem("usu_dni") || "";
    passwordInput.value = localStorage.getItem("usu_password") || "";

    function validarCampos() {
        btnIngresar.disabled = !(dniInput.value.trim() !== "" && passwordInput.value.trim() !== "");
    }

    validarCampos();

    dniInput.addEventListener("input", function () {
        localStorage.setItem("usu_dni", dniInput.value.trim());
        validarCampos();
    });

    passwordInput.addEventListener("input", function () {
        localStorage.setItem("usu_password", passwordInput.value.trim());
        validarCampos();
    });

    dniInput.addEventListener("change", validarCampos);
    passwordInput.addEventListener("change", validarCampos);
});

document.addEventListener("DOMContentLoaded", function () {
    if (localStorage.getItem("usu_dni")) {
        document.getElementById("usu_dni").value = localStorage.getItem("usu_dni");
        document.getElementById("hide-show-password").value = localStorage.getItem("usu_password");
        document.getElementById("signed-in").checked = true;
    }

    document.getElementById("login_form").addEventListener("submit", function () {
        if (document.getElementById("signed-in").checked) {
            localStorage.setItem("usu_dni", document.getElementById("usu_dni").value);
            localStorage.setItem("usu_password", document.getElementById("hide-show-password").value);
        } else {
            localStorage.removeItem("usu_dni");
            localStorage.removeItem("usu_password");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const dniInput = document.getElementById("usu_dni");

    dniInput.addEventListener("input", function (e) {
        let fieldValue = e.target.value.replace(/\D/g, ''); 
        if (fieldValue.length > 8) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: 'Solo se permiten 8 números.',
                showConfirmButton: false,
                timer: 2000
            });
            fieldValue = fieldValue.substring(0, 8);
        }
        e.target.value = fieldValue;
    });
});
