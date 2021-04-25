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
    var turno = "";
    for (var i = 0; i < elemento.length; i++) {
        if (elemento[i].checked) {
            valor = parseInt(elemento[i].value);
            break;
        }
    }
    switch (valor) {
        case 0:
            turno = "Mañana";
            break;
        case 1:
            turno = "Tarde";
            break;
        case 2:
            turno = "Noche";
            break;
    }
    return turno;
};
var ObtenerSueldoMaximo = function (turno) {
    var sueldo = 0;
    switch (turno) {
        case "Mañana":
            sueldo = 20000;
            break;
        case "Tarde":
            sueldo = 18500;
            break;
        case "Noche":
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
