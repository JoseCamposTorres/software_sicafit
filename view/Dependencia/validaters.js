function SoloLetras(event) {
    var charCode = event.which ? event.which : event.keyCode;
    var charStr = String.fromCharCode(charCode);
    var regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ1234567890-°.,;:¨"\s]+$/;
    
    if (!regex.test(charStr)) {
        return false; // Bloquea la entrada si no es una letra o un espacio
    }
    return true;
}