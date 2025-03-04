/**Inicializar tablas modal */
$(document).ready(function () {
  $.post(
    "../../controller/casoController.php?op=comboBoxUbigeo",
    function (data, status) {
      $("#ubi_id").html(data);
    }
  );

  $.post(
    "../../controller/casoController.php?op=comboBoxDelito",
    function (data, status) {
      let select = $("#deli_delito");
      select.empty().append(data).selectpicker("refresh");
    }
  );

  $("#deli_delito").change(function () {
    deli_delito = $(this).val();
    $.post(
      "../../controller/casoController.php?op=comboBoxSubDelito",
      { deli_delito: deli_delito },
      function (data, status) {
        let select = $("#deli_subdelito");
        select.empty().append(data).selectpicker("refresh");
      }
    );
  });

  $("#deli_subdelito").change(function () {
    deli_subdelito = $(this).val();
    $.post(
      "../../controller/casoController.php?op=comboBoxEspDelito",
      { deli_subdelito: deli_subdelito },
      function (data, status) {
        let select = $("#deli_espdelito");
        select.empty().append(data).selectpicker("refresh");
      }
    );
  });

  $("#deli_espdelito").change(function () {
    deli_espdelito = $(this).val();
    $.post(
      "../../controller/casoController.php?op=comboBoxDetalleDelito",
      { deli_espdelito: deli_espdelito },
      function (data, status) {
        data = JSON.parse(data);
        $("#deli_detalle").val(data.deli_detalle);
      }
    );
  });
});

/**Funcion para inicializar componentes */
function init() {
  $("#caso_form").on("submit", function (e) {
    e.preventDefault();
    saveCaso(e);
    
  });
}

/**Funcion para añadir Caso */
function saveCaso(e) {
  e.preventDefault();
  var caso_situacional = $("#caso_situacional").val();
  var caso_medidas = $("#caso_medidas").val();
  var deli_delito = $("#deli_delito").val();
  var ubi_id = $("#ubi_id").val();
  if (
    ubi_id === "0" ||
    deli_delito === "0" ||
    caso_medidas === "0" ||
    caso_situacional === "0"
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

  var formData = new FormData($("#caso_form")[0]);

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
        url: "../../controller/casoController.php?op=save",
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
            $("#caso_form")[0].reset();
            $('#ubi_id').val('0').trigger('change').selectpicker("refresh"); 
            $('#caso_situacional').val('0').trigger('change').selectpicker("refresh"); 
            $('#caso_medidas').val('0').trigger('change').selectpicker("refresh"); 
            $('#deli_delito').val('0').trigger('change').selectpicker("refresh"); 
            $('#deli_subdelito').val('0').trigger('change').selectpicker("refresh");
            $('#deli_espdelito').val('0').trigger('change').selectpicker("refresh"); 
            Swal.fire({
              toast: true,
              position: "top-end",
              icon: "success",
              title: datos.message,
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
            });
          }
        },
      });
    }
  });
}

/**Inicializacion de la función */
init();
