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
var AdministrarValidaciones = function (e) {
    var sueldo = document.getElementById("txtSueldo").value;
    var sueldoMax = ObtenerSueldoMaximo(ObtenerTurnoSeleccionado());
    var dniObtenido = document.getElementById("txtDni").value;
    var legajoObtenido = document.getElementById("txtLegajo").value;
    if (!ValidarCamposVacios("txtDni")
        || !ValidarCamposVacios("txtApellido")
        || !ValidarCamposVacios("txtNombre")
        || !ValidarCamposVacios("txtSueldo")
        || !ValidarCamposVacios("txtLegajo")) {
        alert("Uno o varios campos se encuentran sin completar");
        e.preventDefault();
    }
    if (!ValidarRangoNumerico(parseInt(sueldo), 8000, sueldoMax)) {
        alert("El sueldo no se encuentra dentro de los limites");
        e.preventDefault();
    }
    if (!ValidarRangoNumerico(parseInt(dniObtenido), 1000000, 55000000)) {
        alert("Dni incorrecto.");
        e.preventDefault();
    }
    if (!ValidarRangoNumerico(parseInt(legajoObtenido), 100, 550)) {
        alert("Legajo incorrecto.");
        e.preventDefault();
    }
    if (!ValidarCombo("cboSexo", "---")) {
        alert("Seleccione sexo");
        e.preventDefault();
    }
};
