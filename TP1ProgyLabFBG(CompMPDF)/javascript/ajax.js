window.onload = function () {
    CargarFrmAoM();
    CargarFrmMostrar();
};
var Ajax = /** @class */ (function () {
    function Ajax() {
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
                if (_this._xhr.readyState === Ajax.DONE) {
                    if (_this._xhr.status === Ajax.OK) {
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
                if (_this._xhr.readyState === Ajax.DONE) {
                    if (_this._xhr.status === Ajax.OK) {
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
        Ajax.DONE = 4;
        Ajax.OK = 200;
    }
    return Ajax;
}());
var CargarFrmAoM = function () {
    var ajax = new Ajax();
    ajax.Post("./index.php", SuccessAoM, "");
};
var CargarFrmMostrar = function () {
    var ajax = new Ajax();
    ajax.Post("./backend/mostrar.php", SuccessMostrar, "");
};
var SuccessAoM = function (respuesta) {
    document.getElementById("divFrm").innerHTML = respuesta;
};
var SuccessMostrar = function (respuesta) {
    document.getElementById("divEmpleados").innerHTML = respuesta;
};
var CargarDatos = function () {
    var ajax = new Ajax();
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
    ajax.Post("./backend/administracion.php", Recargar, form);
};
var Recargar = function () {
    CargarFrmAoM();
    CargarFrmMostrar();
};
var AModificar = function (dni) {
    var ajax = new Ajax();
    var param = "txtDni=" + dni;
    ajax.Post("./index.php", SuccessAoM, param);
};
var AEliminar = function (legajo) {
    var ajax = new Ajax();
    var param = "legajo=" + legajo;
    ajax.Get("./backend/eliminar.php", CargarFrmMostrar, param);
};
