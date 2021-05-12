var AdministrarValidaciones = function (e) {
    var sueldo = parseInt(document.getElementById("txtSueldo").value);
    var sueldoMax = parseInt(ObtenerSueldoMaximo(ObtenerTurnoSeleccionado()));
    var dniObtenido = parseInt(document.getElementById("txtDni").value);
    var legajoObtenido = parseInt(document.getElementById("txtLegajo").value);
    if (!ValidarCamposVacios("txtDni")) {
        AdministrarSpanError("spanTxtDni", true);
    }
    else {
        AdministrarSpanError("spanTxtDni", false);
    }
    if (!ValidarCamposVacios("txtApellido")) {
        AdministrarSpanError("spanTxtApellido", true);
    }
    else {
        AdministrarSpanError("spanTxtApellido", false);
    }
    if (!ValidarCamposVacios("txtNombre")) {
        AdministrarSpanError("spanTxtNombre", true);
    }
    else {
        AdministrarSpanError("spanTxtNombre", false);
    }
    if (!ValidarCamposVacios("txtSueldo")) {
        AdministrarSpanError("spanTxtSueldo", true);
    }
    else {
        AdministrarSpanError("spanTxtSueldo", false);
    }
    if (!ValidarCamposVacios("txtLegajo")) {
        AdministrarSpanError("spanTxtLegajo", true);
    }
    else {
        AdministrarSpanError("spanTxtLegajo", false);
    }
    if (!ValidarRangoNumerico(sueldo, 8000, sueldoMax)) {
        AdministrarSpanError("spanTxtSueldo", true);
    }
    else {
        AdministrarSpanError("spanTxtSueldo", false);
    }
    if (!ValidarRangoNumerico(dniObtenido, 1000000, 55000000)) {
        AdministrarSpanError("spanTxtDni", true);
    }
    else {
        AdministrarSpanError("spanTxtDni", false);
    }
    if (!ValidarRangoNumerico(legajoObtenido, 100, 550)) {
        AdministrarSpanError("spanTxtLegajo", true);
    }
    else {
        AdministrarSpanError("spanTxtLegajo", false);
    }
    if (!ValidarCombo("cboSexo", "---")) {
        AdministrarSpanError("spanCboSexo", true);
    }
    else {
        AdministrarSpanError("spanCboSexo", false);
    }
    if (!ValidarCamposVacios("idFoto")) {
        AdministrarSpanError("spanFoto", true);
    }
    else {
        AdministrarSpanError("spanFoto", false);
    }
    e.preventDefault();
    if (ValidarCamposVacios("txtNombre") &&
        ValidarCamposVacios("txtApellido") &&
        ValidarCamposVacios("idFoto") &&
        ValidarCombo("cboSexo", "---") &&
        ValidarRangoNumerico(dniObtenido, 1000000, 55000000) &&
        ValidarRangoNumerico(legajoObtenido, 100, 550) &&
        ValidarRangoNumerico(sueldo, 8000, sueldoMax)) {
        CargarDatos();
    }
};
var AdministrarValidacionesLogin = function (e) {
    var dniObtenido = parseInt(document.getElementById("txtDni").value);
    if (!ValidarRangoNumerico(dniObtenido, 1000000, 55000000)) {
        AdministrarSpanError("spanTxtDni", true);
    }
    else {
        AdministrarSpanError("spanTxtDni", false);
    }
    if (!ValidarCamposVacios("txtApellido")) {
        AdministrarSpanError("spanTxtApellido", true);
    }
    else {
        AdministrarSpanError("spanTxtApellido", false);
    }
    if (!VerificarValidacionesLogin()) {
        e.preventDefault();
    }
};
