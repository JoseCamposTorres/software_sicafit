$(document).ready(function () {
  let rowCount = 1;

  // Evento delegado para cambiar el label y restricciones del input según el tipo de documento seleccionado
  $("#detenidosContainer").on(
    "change",
    "#tipo_documento, .tipo-documento",
    function () {
      let select = $(this);
      let row = select.closest(".row"); // Encuentra la fila en la que está el select
      let label = row.find("label[for^='detenido_dni_']");
      let input = row.find(".dni-input");

      switch (select.val()) {
        case "DNI":
          label.text("DNI");
          input.attr("placeholder", "Ingrese su DNI");
          input.attr("maxlength", "8");
          input.attr("onkeypress", "return OnlyNumbers(event);");
          break;

        case "Cedula":
          label.text("Cédula de Identidad");
          input.attr("placeholder", "Ingrese su cédula");
          input.attr("maxlength", "10");
          input.attr("onkeypress", "return OnlyNumbers10(event);");
          break;

        case "Pasaporte":
          label.text("Pasaporte");
          input.attr("placeholder", "Ingrese su pasaporte");
          input.attr("maxlength", "20");
          input.attr("onkeypress", "return Alphanumeric20(event);");
          break;

        case "Carnet":
          label.text("Carnet de Extranjería");
          input.attr("placeholder", "Ingrese su carnet");
          input.attr("maxlength", "12");
          input.attr("onkeypress", "return Alpha12(event);");
          break;
      }
    }
  );

  // Agregar una nueva fila al hacer clic en el botón
  $("#addRow").click(function () {
    rowCount++;
    let newRowId = `row_${rowCount}`;

    let newRow = `
        <div class="row detenido-row" id="${newRowId}">
            <div class="col-lg-2">
                <div class="form-group has-success">
                    <label class="form-label semibold" for="tipo_documento_${rowCount}">Tipo de Documento</label>
                    <div class="form-control-wrapper">
                        <select class="form-control tipo-documento" id="tipo_documento_${rowCount}" name="tipo_documento[]" required>
                            <option value="DNI">DNI</option>
                            <option value="Cedula">Cédula de Identidad</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="Carnet">Carnet de Extranjería</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group has-success">
                    <label class="form-label semibold" for="detenido_dni_${rowCount}">DNI</label>
                    <div class="form-control-wrapper">
                        <div class="input-group mar-btm">
                            <input type="text" class="form-control dni-input" id="detenido_dni_${rowCount}" name="detenido_dni[]" 
                                onkeypress="return OnlyNumbers(event);" placeholder="Ingrese número de DNI" required autocomplete="off">
                            <span class="input-group-addon">
                                <i class="fa fa-search buscar-dni" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group has-success">
                    <label class="form-label semibold">Nombres</label>
                    <div class="form-control-wrapper has-error">
                        <input type="text" class="form-control nombre-input" name="detenido_name[]" 
                            placeholder="Ingrese su nombre" required autocomplete="off" onkeypress="return OnlyLetters(event);">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group has-success">
                    <label class="form-label semibold">Apellidos</label>
                    <div class="form-control-wrapper has-error">
                        <input type="text" class="form-control apellido-input" name="detenido_lastname[]" 
                            placeholder="Ingrese su apellido" required autocomplete="off" onkeypress="return OnlyLetters(event);">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="form-label semibold">Edad</label>
                    <div class="form-control-wrapper has-success">
                        <input type="text" class="form-control edad-input" name="detenido_age[]" 
                            placeholder="Ingrese su edad" autocomplete="off" onkeypress="return OnlyNumbers2(event);">
                    </div>
                </div>
            </div>
            <div class="col-sm-1">
                <button type="button" class="btn btn-danger btn-circle removeRow" data-row="${newRowId}">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
    `;

    $("#detenidosContainer").append(newRow);
  });

  // Eliminar fila al hacer clic en el botón rojo
  $(document).on("click", ".removeRow", function () {
    let rowId = $(this).data("row");
    $("#" + rowId).remove();
  });

  // Evento para manejar la búsqueda de DNI en todas las filas dinámicas
  $(document).on("click", ".buscar-dni", function () {
    let dniInput = $(this).closest(".input-group").find(".dni-input");
    buscarUsuario(dniInput);
  });

  $(document).on("keypress", ".dni-input", function (event) {
    if (event.which == 13) {
      buscarUsuario($(this));
    }
  });

  function buscarUsuario(dniInput) {
    var dni = dniInput.val();
    let nombreInput = dniInput.closest(".detenido-row").find(".nombre-input");
    let apellidoInput = dniInput
      .closest(".detenido-row")
      .find(".apellido-input");
    let timerInterval;

    Swal.fire({
      title: "Buscando detenido...",
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
      },
    });

    $.ajax({
      url: "../../controller/reniecController.php",
      type: "post",
      data: { dni: dni },
      dataType: "json",
      success: function (r) {
        Swal.close();
        if (r.numeroDocumento == dni) {
          let apellidoPaterno = capitalizarTexto(r.apellidoPaterno);
          let apellidoMaterno = capitalizarTexto(r.apellidoMaterno);
          let nombres = capitalizarTexto(r.nombres);

          apellidoInput.val(apellidoPaterno + " " + apellidoMaterno);
          nombreInput.val(nombres);

          Swal.fire({
            toast: true,
            position: "top-end",
            icon: "success",
            title: "Detenido encontrado correctamente",
            showConfirmButton: false,
            timer: 2000,
          });
        } else {
          Swal.fire({
            toast: true,
            position: "top-end",
            icon: "error",
            title: "No se encontró el usuario",
            text: r.error || "El DNI ingresado no existe.",
            showConfirmButton: false,
            timer: 3000,
          });

          apellidoInput.val("");
          nombreInput.val("");
        }
      },
      error: function () {
        Swal.close();
        Swal.fire({
          toast: true,
          position: "top-end",
          icon: "error",
          title: "Error de conexión",
          text: "No se pudo cargar los datos.",
          showConfirmButton: false,
          timer: 3000,
        });

        apellidoInput.val("");
        nombreInput.val("");
      },
    });
  }
});

function OnlyLetters(e) {
  let key = e.keyCode || e.which;
  let tecla = String.fromCharCode(key);
  let letters =
    "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnopqrstuvwxyzáéíóú.- ";
  let specialKeys = [8, 13]; // 8 = Backspace, 13 = Enter

  // Permitir teclas especiales
  if (specialKeys.includes(key)) return true;

  // Validar si la tecla presionada está en el conjunto permitido
  if (!letters.includes(tecla)) {
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "warning",
      title: "Solo se permiten letras",
      showConfirmButton: false,
      timer: 2000,
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
      position: "top-end",
      icon: "warning",
      title: "Ingrese solo números",
      showConfirmButton: false,
      timer: 2000,
    });
    return false;
  }

  // Validar que no se ingresen más de 8 dígitos
  let fieldValue = e.target.value.replace(/[^\d]/g, ""); // Filtrar solo números
  if (fieldValue.length >= 8) {
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "warning",
      title: "Solo se permiten 8 números",
      showConfirmButton: false,
      timer: 2000,
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
      position: "top-end",
      icon: "warning",
      title: "Ingrese solo números",
      showConfirmButton: false,
      timer: 2000,
    });
    return false;
  }

  // Validar que no se ingresen más de 8 dígitos
  let fieldValue = e.target.value.replace(/[^\d]/g, ""); // Filtrar solo números
  if (fieldValue.length >= 2) {
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "warning",
      title: "Solo se permiten 2 números",
      showConfirmButton: false,
      timer: 2000,
    });
    return false;
  }
}

function capitalizarTexto(texto) {
  return texto.toLowerCase().replace(/\b\w/g, (letra) => letra.toUpperCase());
}

$(document).on("input", ".edad-input", function () {
  let edad = $(this).val().trim();
  let row = $(this).closest(".detenido-row");
  let nombreInput = row.find(".nombre-input");
  let apellidoInput = row.find(".apellido-input");

  let nombreCompleto = nombreInput.data("full-name") || nombreInput.val();
  let apellidoCompleto =
    apellidoInput.data("full-lastname") || apellidoInput.val();

  // Guardar nombres completos si no están almacenados
  if (!nombreInput.data("full-name"))
    nombreInput.data("full-name", nombreCompleto);
  if (!apellidoInput.data("full-lastname"))
    apellidoInput.data("full-lastname", apellidoCompleto);

  if (edad === "" || parseInt(edad, 10) >= 18) {
    // Mostrar nombre y apellido completos si la edad es vacía o mayor o igual a 18
    nombreInput.val(nombreInput.data("full-name"));
    apellidoInput.val(apellidoInput.data("full-lastname"));
  } else {
    // Convertir a iniciales si la edad es menor de 18
    let inicialNombre =
      nombreCompleto
        .split(" ")
        .map((n) => n.charAt(0))
        .join(". ") + ".";
    let inicialApellido =
      apellidoCompleto
        .split(" ")
        .map((a) => a.charAt(0))
        .join(". ") + ".";

    nombreInput.val(inicialNombre);
    apellidoInput.val(inicialApellido);
  }
});

document.addEventListener("DOMContentLoaded", function () {
  let fechaInput = document.getElementById("fecha_proceso_desde");
  let horaInput = document.getElementById("fecha_proceso_hasta");

  // Abre el selector de fecha al hacer clic en cualquier parte del input
  fechaInput.addEventListener("click", function () {
    this.showPicker(); // Abre el selector de fecha (solo funciona en navegadores modernos)
  });

  horaInput.addEventListener("click", function () {
    this.showPicker(); // Abre el selector de fecha (solo funciona en navegadores modernos)
  });
});

$(document).ready(function () {
  $("#caso_situacional, #usu_id, #deli_delito").select2({
    placeholder: "Seleccionar",
    allowClear: true,
  });
});

// Función para determinar el tipo de documento según la longitud del DNI
function getTipoDocumento(dni) {
  let length = dni.length;
  if (length === 8) return "DNI";
  if (length === 10) return "Cedula";
  if (length === 20) return "Pasaporte";
  if (length === 12) return "Carnet";
  return "DNI"; // Valor por defecto
}

// Función para obtener la longitud máxima permitida en el input
function getMaxLength(tipoDocumento) {
  let maxLengthMap = {
    DNI: 8,
    Cedula: 10,
    Pasaporte: 20,
    Carnet: 12,
  };
  return maxLengthMap[tipoDocumento] || 8;
}

// Función para obtener la validación correcta según el tipo de documento
function getValidationFunction(tipoDocumento) {
  let validationMap = {
    DNI: OnlyNumbers,
    Cedula: OnlyNumbers10,
    Pasaporte: Alphanumeric20,
    Carnet: Alpha12,
  };
  return validationMap[tipoDocumento] || OnlyNumbers;
}
