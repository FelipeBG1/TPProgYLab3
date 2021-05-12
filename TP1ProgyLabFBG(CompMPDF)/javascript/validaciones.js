var ValidarCamposVacios = function (id) {
    var valor = document.getElementById(id).value;
    valor = valor.replace(/ /g, "");
    if (valor === "" || valor == undefined) {
        return false;
    }
    else {
        return true;
    }
};
var ValidarRangoNumerico = function (numeroAValidar, rangoMinimo, rangoMaximo) {
    if (numeroAValidar >= rangoMinimo && numeroAValidar <= rangoMaximo) {
        return true;
    }
    else {
        return false;
    }
};
var ValidarCombo = function (id, valorIncorrecto) {
    var valor = document.getElementById(id).value;
    if (valor != valorIncorrecto) {
        return true;
    }
    else {
        return false;
    }
};
var ObtenerTurnoSeleccionado = function () {
    var elemento = (document.querySelectorAll('input[name="rdoTurno"]'));
    var valor = 0;
    for (var i = 0; i < elemento.length; i++) {
        if (elemento[i].checked) {
            valor = parseInt(elemento[i].value);
            break;
        }
    }
    return valor;
};
var ObtenerSueldoMaximo = function (turno) {
    var sueldo = 0;
    switch (turno) {
        case 0:
            sueldo = 20000;
            break;
        case 1:
            sueldo = 18500;
            break;
        case 2:
            sueldo = 25000;
            break;
    }
    return sueldo;
};
var AdministrarSpanError = function (id, bool) {
    var span = document.getElementById(id);
    if (bool) {
        span.style.display = "block";
    }
    else {
        span.style.display = "none";
    }
};
var VerificarValidacionesLogin = function () {
    var spanDni = document.getElementById("spanTxtDni").style.display;
    var spanApellido = document.getElementById("spanTxtApellido").style.display;
    if (spanDni === "none" && spanApellido === "none") {
        return true;
    }
    return false;
};
var AdministrarModificar = function ($dni) {
    var input = document.getElementById("hiddenInput");
    var form = document.getElementById("formMostrar");
    input.value = $dni;
    form.submit();
};
