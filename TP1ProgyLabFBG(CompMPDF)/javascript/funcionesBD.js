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
window.onload = function () {
    CargarFrmAoM();
    CargarFrmMostrar();
};
var AjaxBD = /** @class */ (function () {
    function AjaxBD() {
        var _this = this;
        this.Post = function (ruta, success, params, error) {
            if (params === void 0) { params = ""; }
            _this._xhr.open('POST', ruta, true);
            if (typeof (params) == "string") {
                _this._xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            }
            else {
                _this._xhr.setRequestHeader("enctype", "multipart/form-data");
            }
            _this._xhr.send(params);
            _this._xhr.onreadystatechange = function () {
                if (_this._xhr.readyState === AjaxBD.DONE) {
                    if (_this._xhr.status === AjaxBD.OK) {
                        success(_this._xhr.responseText);
                    }
                    else {
                        if (error !== undefined) {
                            error(_this._xhr.status);
                        }
                    }
                }
            };
        };
        this.Get = function (ruta, success, params, error) {
            if (params === void 0) { params = ""; }
            ruta = params.length > 0 ? ruta + "?" + params : ruta;
            _this._xhr.open('GET', ruta);
            _this._xhr.send();
            _this._xhr.onreadystatechange = function () {
                if (_this._xhr.readyState === AjaxBD.DONE) {
                    if (_this._xhr.status === AjaxBD.OK) {
                        success(_this._xhr.responseText);
                    }
                    else {
                        if (error !== undefined) {
                            error(_this._xhr.status);
                        }
                    }
                }
            };
        };
        this._xhr = new XMLHttpRequest();
        AjaxBD.DONE = 4;
        AjaxBD.OK = 200;
    }
    return AjaxBD;
}());
var CargarFrmAoM = function () {
    var ajax = new AjaxBD();
    ajax.Post("./index2.php", SuccessAoM, "");
};
var CargarFrmMostrar = function () {
    var ajax = new AjaxBD();
    ajax.Post("./backendBD/mostrar_BD.php", SuccessMostrar, "");
};
var SuccessAoM = function (respuesta) {
    document.getElementById("divFrm").innerHTML = respuesta;
};
var SuccessMostrar = function (respuesta) {
    document.getElementById("divEmpleados").innerHTML = respuesta;
};
var CargarDatos = function () {
    var ajax = new AjaxBD();
    var form = new FormData();
    var dni = document.getElementById("txtDni").value;
    var apellido = document.getElementById("txtApellido").value;
    var nombre = document.getElementById("txtNombre").value;
    var sexo = document.getElementById("cboSexo").value;
    var legajo = document.getElementById("txtLegajo").value;
    var sueldo = document.getElementById("txtSueldo").value;
    var turno = ObtenerTurnoSeleccionado();
    var foto = document.getElementById("idFoto").files;
    var hidden = document.getElementById("hdnModificar").value;
    form.append("txtDni", dni);
    form.append("txtApellido", apellido);
    form.append("txtNombre", nombre);
    form.append("cboSexo", sexo);
    form.append("txtLegajo", legajo);
    form.append("txtSueldo", sueldo);
    form.append("rdoTurno", turno);
    form.append("foto", foto[0]);
    form.append("hdnModificar", hidden);
    ajax.Post("./backendBD/administracion_BD.php", Recargar, form);
};
var Recargar = function () {
    CargarFrmAoM();
    CargarFrmMostrar();
};
var AModificar = function (dni) {
    var ajax = new AjaxBD();
    var param = "txtDni=" + dni;
    ajax.Post("./index2.php", SuccessAoM, param);
};
var AEliminar = function (legajo) {
    var ajax = new AjaxBD();
    var param = "legajo=" + legajo;
    ajax.Get("./backendBD/eliminar_BD.php", CargarFrmMostrar, param);
};
