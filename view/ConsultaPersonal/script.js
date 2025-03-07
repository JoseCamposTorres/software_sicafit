var rol_id = $("#rol_idx").val();
var usu_id = $("#user_idx").val();

/**Inicializar tablas modal */
$(document).ready(function () {
  $.post(
    "../../controller/casoController.php?op=comboBoxUbigeo",
    function (data, status) {
      $("#ubi_id").html(data);
    }
  );

  $.post(
    "../../controller/consultaController.php?op=comboBoxDelito",
    function (data, status) {
      let select = $("#deli_delito_modal");
      select.empty().append(data).selectpicker("refresh");
    }
  );

  $("#deli_delito_modal").change(function () {
    deli_delito_modal = $(this).val();
    $.post(
      "../../controller/consultaController.php?op=comboBoxSubDelito",
      { deli_delito_modal: deli_delito_modal },
      function (data, status) {
        let select = $("#deli_subdelito_modal");
        select.empty().append(data).selectpicker("refresh");
      }
    );
  });

  $("#deli_subdelito_modal").change(function () {
    deli_subdelito_modal = $(this).val();
    $.post(
      "../../controller/consultaController.php?op=comboBoxEspDelito",
      { deli_subdelito_modal: deli_subdelito_modal },
      function (data, status) {
        let select = $("#deli_espdelito_modal");
        select.empty().append(data).selectpicker("refresh");
      }
    );
  });

  $("#deli_espdelito_modal").change(function () {
    deli_espdelito_modal = $(this).val();
    $.post(
      "../../controller/consultaController.php?op=comboBoxDetalleDelito",
      { deli_espdelito_modal: deli_espdelito_modal },
      function (data, status) {
        data = JSON.parse(data);
        $("#deli_detalle_modal").val(data.deli_detalle);
      }
    );
  });
});

/**Funcion para inicializar componentes */
function init() {
  $("#caso_form").on("submit", function (e) {
    updateCaso(e);
  });
}

/**Inicializar tablas modal */
$(document).ready(function () {
  var usu_id = $("#usu_id").val();

  listardatatable(usu_id);
  // }

  $.post(
    "../../controller/consultaController.php?op=comboBoxFiscal",
    function (data, status) {
      let select = $("#usu_id");
      select.empty().append(data).selectpicker("refresh");
    }
  );

  $.post(
    "../../controller/consultaController.php?op=comboBoxDelito",
    function (data, status) {
      let select = $("#deli_delito");
      select.empty().append(data).selectpicker("refresh");
    }
  );
});

/**hacer el filtro */
$(document).on("click", "#btnfiltrar", function () {
  limpiar();
  //Variables
  var usu_id = $("#usu_id").val();
  listardatatable(usu_id);
});

/**hacer el exportar documento */
$(document).on("click", "#btnExportar", function () {
  /**hacer el exportar documento */
  var fecha_proceso_desde = $("#fecha_proceso_desde").val();
  var fecha_proceso_hasta = $("#fecha_proceso_hasta").val();

  if (fecha_proceso_desde === "" || !fecha_proceso_hasta === "") {
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "error",
      title: "Por favor complete la Fecha de Proceso.",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });
  } else {
    //Variables
    var fecha_proceso_desde = $("#fecha_proceso_desde").val();
    var fecha_proceso_hasta = $("#fecha_proceso_hasta").val();
    var usu_id = $("#user_idx").val();

    generar_excel(fecha_proceso_desde, fecha_proceso_hasta, usu_id);
  }
});

/**generar excel*/
function generar_excel(fecha_proceso_desde, fecha_proceso_hasta, usu_id) {
  window.location.href =
    "../../excel/exportar_personal_excel_controller.php?fecha_proceso_desde=" +
    fecha_proceso_desde +
    "&fecha_proceso_hasta=" +
    fecha_proceso_hasta +
    "&usu_id=" +
    usu_id;
}

/**Listar tabla*/
function listardatatable(usu_id) {
  tabla = $("#consulta_data")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom:
        "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      searching: true,
      lengthChange: true,
      colReorder: true,
      buttons: [
        {
          extend: "excelHtml5",
          footer: true,
          text: '<i class="fa fa-file-excel-o" style="color: green;"></i>',
        },
        //Botón para PDF
        {
          extend: "pdf",
          footer: true,
          text: '<i class="fa fa-file-pdf-o" style="color: red;"></i>',
          exportOptions: {
            columns: [0, ":visible"],
          },
        },
        //Botón para copiar
        {
          extend: "copyHtml5",
          footer: true,
          title: "Reporte de usuarios",
          filename: "Reporte de usuarios",
          text: '<i class="fa fa-copy" style="color: blue;"></i>',
          exportOptions: {
            columns: [0, ":visible"],
          },
        },
        //Botón para print
        {
          extend: "print",
          footer: true,
          filename: "Export_File_print",
          text: '<i class="fa fa-print" style="color: #000;"></i>',
        },
        //Colvis
        {
          extend: "colvis",
          text: '<i class="fa fa-columns" style="color: #34495e;"></i>',
          postfixButtons: ["colvisRestore"],
        },
      ],
      ajax: {
        url: "../../controller/consultaController.php?op=listar",
        type: "post",
        dataType: "json",
        data: {
          usu_id: usu_id,
        },
        error: function (e) {
          console.log(e.responseText);
        },
      },
      ordering: true,
      bDestroy: true,
      responsive: true,
      bInfo: true,
      iDisplayLength: 10,
      autoWidth: false,
      ordering: true,
      bDestroy: true,
      responsive: true,
      bInfo: true,
      iDisplayLength: 5,
      autoWidth: false,
      language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando un total de 0 registros",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
        },
      },
    })
    .DataTable();
}

/**Limpiar */
function limpiar() {
  //limpiamos la tabla
  $("#table").html(
    "<table id='consulta_data' class='table table-bordered table-vcenter js-dataTable-full'>" +
      "<thead>" +
      "<tr>" +
      "<th style='width: 3%;'>N°</th>" +
      "<th style='width: 5%;'>Fecha de Proceso</th>" +
      "<th style='width: 10%'>Fiscal</th>" +
      "<th style='width: 10%'>Delito</th>" +
      "<th style='width: 10%'>Estado Situacional</th>" +
      "<th style='width: 5%;'>Estado</th>" +
      "<th style='width: 5%;'></th>" +
      "<th style='width: 5%;'></th>" +
      "</tr>" +
      "</thead>" +
      "<tbody>" +
      "</tbody>" +
      "</table>"
  );
}

/**Actualizar caso */
function updateCaso(e) {
  e.preventDefault();

  const formData = new FormData($("#caso_form")[0]);

  var caso_situacional_modal = $("#caso_situacional").val();
  var caso_medidas = $("#caso_medidas").val();
  var deli_delito_modal = $("#deli_delito_modal").val();
  var deli_subdelito_modal = $("#deli_subdelito_modal").val();
  var deli_espdelito_modal = $("#deli_espdelito_modal").val();
  var ubi_id = $("#ubi_id").val();

  if (
    ubi_id === "0" ||
    deli_delito_modal === "0" ||
    caso_medidas === "0" ||
    caso_situacional_modal === "0" ||
    deli_subdelito_modal === "0" ||
    deli_espdelito_modal === "0"
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
  } else {
    Swal.fire({
      title: "Confirmación",
      text: "¿Desea guardar los cambios?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/consultaController.php?op=update",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (response) {
            if (response.status === "success") {
              Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: response.message,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
              });
              $("#caso_form")[0].reset();
              $("#modalmantenimiento").modal("hide");
              $("#consulta_data").DataTable().ajax.reload();
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: response.message,
              });
            }
          },
        });
      }
    });
  }
}

/**Funcion para desactivar caso */
function desactive(caso_id) {
  Swal.fire({
    title: "Desactivar",
    text: "¿Está seguro de desactivar el caso?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, desactivar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../controller/consultaController.php?op=desactive",
        { caso_id: caso_id },
        function (data) {
          let response = JSON.parse(data);
          if (response.status === "success") {
            $("#consulta_data").DataTable().ajax.reload();
            Swal.fire({
              toast: true,
              position: "top-end",
              icon: "success",
              title: response.message,
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
            });
          } else {
            Swal.fire({
              toast: true,
              position: "top-end",
              icon: "error",
              title: "Error al desactivar el caso",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
            });
          }
        }
      );
    }
  });
}

/** Función para activar caso */
function active(caso_id) {
  Swal.fire({
    title: "Activar",
    text: "¿Está seguro de activar el caso?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, activar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../controller/consultaController.php?op=active",
        { caso_id: caso_id },
        function (data) {
          let response = JSON.parse(data);
          if (response.status === "success") {
            $("#consulta_data").DataTable().ajax.reload();
            Swal.fire({
              toast: true,
              position: "top-end",
              icon: "success",
              title: response.message,
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
            });
          } else {
            Swal.fire({
              toast: true,
              position: "top-end",
              icon: "error",
              title: "Error al activar el caso",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
            });
          }
        }
      );
    }
  });
}

/**editar caso */
function edit(caso_id) {
  $("#modalmantenimiento").modal("show");
  $("#mdltitulo").html("Editar Caso");
  $("#btnAccion").html("Actualizar");

  $.post(
    "../../controller/consultaController.php?op=view",
    { caso_id: caso_id },
    function (data) {
      data = JSON.parse(data);
      console.log(data.deli_espdelito);

      // Llenar datos del caso
      $("#caso_id").val(data.caso_id);
      $("#caso_date").val(data.caso_date);
      $("#caso_hour").val(data.caso_hour);
      $("#ubi_id").val(data.ubi_id).trigger("change");
      $("#caso_situacional_modal").val(data.caso_situacional).trigger("change");
      $("#caso_medidas").val(data.caso_medidas).trigger("change");
      $("#deli_delito_modal").val(data.deli_delito).trigger("change");

      setTimeout(() => {
        $("#deli_subdelito_modal").val(data.deli_subdelito).trigger("change");
      }, 500);

      // Espera a que el delito específico cargue antes de asignarlo
      $("#deli_subdelito_modal").on("change", function () {
        setTimeout(() => {
          $("#deli_espdelito_modal").val(data.deli_espdelito).trigger("change");
        }, 300);
      });

      $("#deli_detalle_modal").val(data.deli_detalle);

      // Vaciar contenedor de detenidos antes de agregar nuevos
      $("#detenidosContainer").empty();

      // Agregar los detenidos dinámicamente
      if (data.detenidos && data.detenidos.length > 0) {
        data.detenidos.forEach((detenido, index) => {
          let tipoDocumento = getTipoDocumento(detenido.dni);

          let detenidoRow = `
              <div class="row detenido-row">
                  <div class="col-lg-2">
                      <div class="form-group has-success">
                          <label class="form-label semibold" for="tipo_documento_${index}">Tipo de Documento</label>
                          <div class="form-control-wrapper">
                              <select class="form-control tipo-documento" id="tipo_documento_${index}" name="tipo_documento[]" required>
                                  <option value="DNI" ${
                                    tipoDocumento === "DNI" ? "selected" : ""
                                  }>DNI</option>
                                  <option value="Cedula" ${
                                    tipoDocumento === "Cedula" ? "selected" : ""
                                  }>Cédula de Identidad</option>
                                  <option value="Pasaporte" ${
                                    tipoDocumento === "Pasaporte"
                                      ? "selected"
                                      : ""
                                  }>Pasaporte</option>
                                  <option value="Carnet" ${
                                    tipoDocumento === "Carnet" ? "selected" : ""
                                  }>Carnet de Extranjería</option>
                              </select>
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-2">
                      <div class="form-group has-success">
                          <label class="form-label semibold" for="detenido_dni_${index}">${tipoDocumento}</label>
                          <div class="form-control-wrapper">
                              <div class="input-group mar-btm">
                                  <input type="text" class="form-control dni-input" id="detenido_dni_${index}" name="detenido_dni[]" value="${
            detenido.dni
          }" required autocomplete="off" maxlength="${getMaxLength(
            tipoDocumento
          )}" placeholder="Ingrese su ${tipoDocumento}" onkeypress="return getValidationFunction(tipoDocumento)(event);">
                                  <span class="input-group-addon"><i class="fa fa-search buscar-dni" style="cursor: pointer;"></i></span>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-3">
                      <div class="form-group has-success">
                          <label class="form-label semibold">Nombres</label>
                          <input type="text" class="form-control nombre-input" name="detenido_name[]" value="${
                            detenido.nombre
                          }" required autocomplete="off">
                      </div>
                  </div>

                  <div class="col-sm-3">
                      <div class="form-group has-success">
                          <label class="form-label semibold">Apellidos</label>
                          <input type="text" class="form-control apellido-input" name="detenido_lastname[]" value="${
                            detenido.apellido
                          }" required autocomplete="off">
                      </div>
                  </div>

                  <div class="col-sm-2">
                      <div class="form-group  has-success">
                          <label class="form-label semibold">Edad</label>
                          <input type="text" class="form-control edad-input" name="detenido_age[]" value="${
                            detenido.edad
                          }" autocomplete="off">
                      </div>
                  </div>
              </div>`;

          $("#detenidosContainer").append(detenidoRow);
        });
      }

      // Refrescar selectpickers si se están usando
      $(".selectpicker").selectpicker("refresh");
    }
  );

  $("#consulta_data").DataTable().ajax.reload();
}

/**generar pdf */
function pdfPersonal(caso_id) {
  if (!caso_id) {
    console.error("caso_id es inválido");
    return;
  }

  fetch("../../pdf/exportar_pdf_controller.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "caso_id=" + encodeURIComponent(caso_id),
  })
    .then((response) => response.blob()) // Recibir el PDF
    .then((blob) => {
      let url = URL.createObjectURL(blob);
      window.open(url, "_blank"); // Abrir en nueva pestaña sin mostrar caso_id en la URL
    })
    .catch((error) => console.error("Error al generar el PDF:", error));
}

/**Inicializacion de la función */
init();
