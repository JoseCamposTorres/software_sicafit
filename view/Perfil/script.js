/**Funcion para editar usuario */
function edit(usu_id) {
  $("#btnAccion").html("Editar Perfil");

  $.post(
    "../../controller/usuarioController.php?op=view",
    { usu_id: usu_id },
    function (data) {
      data = JSON.parse(data);
      $("#usu_id").val(data.usu_id);
      $("#usu_name").val(data.usu_name);
      $("#usu_lastname").val(data.usu_lastname);
      $("#usu_dni").val(data.usu_dni);
      $("#usu_rol").val(data.usu_rol).trigger("change");
      $("#usu_email").val(data.usu_email);
      $("#usu_telfijo").val(data.usu_telfijo);
      $("#usu_anexo").val(data.usu_anexo);
      $("#usu_cel").val(data.usu_cel);
      $("#usu_password").removeAttr("required");
      $("#div_usu_password").hide();
      let photoPath = data.usu_photo.replace(/\\/g, "/");
      $("#usu_photo").val(photoPath);
      $("#usu_photo").selectpicker("refresh");
      $("#depen_id").val(data.depen_id).trigger("change");
      $("#cargo_id").val(data.cargo_id).trigger("change");

      $("#profile-name").text(data.usu_name + " " + data.usu_lastname);
      $("#profile-role").text(data.cargo_name);
      $("#profile-email").text(data.usu_email);
      $("#profile-telfijo").text(data.usu_telfijo);
      $("#profile-anexo").text(data.usu_anexo);
      $("#profile-cel").text(data.usu_cel);
      $("#profile-dependencia").text(data.depen_name);

      let photoPathnew = "../../public/" + data.usu_photo.replace(/\\/g, "/");
      $("#profile-picture").attr("src", photoPathnew);
    }
  );
  $("#modalmantenimiento").modal("show");
  $("#usuario_data").DataTable().ajax.reload();
}

$(document).ready(function () {
  $.post(
    "../../controller/usuarioController.php?op=comboBoxDepen",
    function (data, status) {
      $("#depen_id").html(data);
    }
  );

  $.post(
    "../../controller/usuarioController.php?op=comboBoxCargo",
    function (data, status) {
      $("#cargo_id").html(data);
    }
  );
  var usu_id = $("#usu_idx").val();
  edit(usu_id);
});

/**Funcion para inicializar componentes */
function init() {
  $("#usuario_form").on("submit", function (e) {
    saveAndEdit(e);
  });
}

/**Funcion para añadir y editar Cargo */
function saveAndEdit(e) {
  e.preventDefault();
  var usu_name = $("#usu_name").val();
  var usu_lastname = $("#usu_lastname").val();
  var usu_email = $("#usu_email").val();
  var cargo_id = $("#cargo_id").val();
  var depen_id = $("#depen_id").val();
  if (
    usu_name === "" ||
    usu_lastname === "" ||
    usu_email === "" ||
    cargo_id === "0" ||
    depen_id === "0"
  ) {
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "error",
      title: "Por favor complete todos los campos.",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });
    return;
  }

  var formData = new FormData($("#usuario_form")[0]);

  Swal.fire({
    title: "¡Recordatorio!",
    text: "¿Está seguro de realizar esta opción?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../../controller/perfilController.php?op=saveAndEdit",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (datos) {
          if (datos.status === "error") {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: datos.message,
            });
          } else {
            Swal.fire({
              toast: true,
              position: "top-end",
              icon: "success",
              title: datos.message,
              showConfirmButton: false,
              timer: 1000,
              timerProgressBar: true,
            }).then(() => {
              location.reload(); // Recargar la web después de la alerta
            });
          }
        },
      });
    }
  });
}

/**Inicializacion de la función */
init();
