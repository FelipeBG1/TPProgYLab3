window.onload = () =>
{
    CargarFrmAoM();
    CargarFrmMostrar();
}

class Ajax {
    
    private _xhr: XMLHttpRequest;

    private static DONE : number;
    private static OK : number;

    public constructor() {
        this._xhr = new XMLHttpRequest();
        Ajax.DONE = 4;
        Ajax.OK = 200;
    }

    public Post = (ruta: string, success: Function, params: string | FormData = "",error?: Function):void => {

        this._xhr.open('POST', ruta, true);
        if(typeof(params) == "string")
        {
            this._xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        }
        else
        {
            this._xhr.setRequestHeader("enctype", "multipart/form-data");
        }
        
        this._xhr.send(params);

        this._xhr.onreadystatechange = ():void => {

            if (this._xhr.readyState === Ajax.DONE) {
                if (this._xhr.status === Ajax.OK) {
                    success(this._xhr.responseText);
                } else {
                    if (error !== undefined){
                        error(this._xhr.status);
                    }
                }
            }
        };
    };

    public Get = (ruta: string, success: Function, params: string = "", error?: Function):void => {
        
        ruta = params.length > 0 ? ruta + "?" + params: ruta;

        this._xhr.open('GET', ruta);
        this._xhr.send();

        this._xhr.onreadystatechange = () => {

            if (this._xhr.readyState === Ajax.DONE) {
                if (this._xhr.status === Ajax.OK) {
                    success(this._xhr.responseText);
                } else {
                    if (error !== undefined){
                        error(this._xhr.status);
                    }
                }
            }

        };
    };
}

var CargarFrmAoM :Function = () =>{

    let ajax : Ajax = new Ajax();
    ajax.Post("http://localhost/TP1ProgyLabGeneral(AJAX)/index.php",SuccessAoM,"");    
}

var CargarFrmMostrar:Function = () =>{

    let ajax : Ajax = new Ajax();
    ajax.Post("http://localhost/TP1ProgyLabGeneral(AJAX)/backend/mostrar.php",SuccessMostrar,"");    
}

var SuccessAoM : Function = (respuesta : string) =>{

    (<HTMLDivElement>document.getElementById("divFrm")).innerHTML = respuesta;
}

var SuccessMostrar : Function = (respuesta : string) =>{

    (<HTMLDivElement>document.getElementById("divEmpleados")).innerHTML = respuesta;
}

var CargarDatos : Function = () =>{

    let ajax : Ajax = new Ajax();
    let form : FormData = new FormData();
    let dni : string = (<HTMLInputElement>document.getElementById("txtDni")).value;
    let apellido : string = (<HTMLInputElement>document.getElementById("txtApellido")).value;
    let nombre : string = (<HTMLInputElement>document.getElementById("txtNombre")).value;
    let sexo : string = (<HTMLInputElement>document.getElementById("cboSexo")).value;
    let legajo : string = (<HTMLInputElement>document.getElementById("txtLegajo")).value;
    let sueldo : string = (<HTMLInputElement>document.getElementById("txtSueldo")).value;
    let turno : string = ObtenerTurnoSeleccionado();
    let foto = (<HTMLInputElement>document.getElementById("idFoto")).files;
    let hidden : string = (<HTMLInputElement>document.getElementById("hdnModificar")).value;

    form.append("txtDni",dni);
    form.append("txtApellido",apellido);
    form.append("txtNombre",nombre);
    form.append("cboSexo",sexo);
    form.append("txtLegajo",legajo);
    form.append("txtSueldo",sueldo);
    form.append("rdoTurno",turno);
    form.append("foto",foto[0]);
    form.append("hdnModificar",hidden);     

    ajax.Post("http://localhost/TP1ProgyLabGeneral(AJAX)/backend/administracion.php",Recargar,form);

}

var Recargar : Function = () =>
{
    CargarFrmAoM();
    CargarFrmMostrar();
}

var AModificar :  Function = (dni : string)=>{

    let ajax : Ajax = new Ajax();
    let param = "txtDni=" + dni;
    ajax.Post("http://localhost/TP1ProgyLabGeneral(AJAX)/index.php",SuccessAoM,param);
}

var AEliminar : Function = (legajo : string)=>{

    let ajax : Ajax = new Ajax();
    let param = "legajo=" + legajo;

    ajax.Get("http://localhost/TP1ProgyLabGeneral(AJAX)/backend/eliminar.php",CargarFrmMostrar,param);
}

/*
var Eliminar : Function = ()=>{

    let ajax : Ajax = new Ajax();

    ajax.Post("http://localhost/TP1ProgyLabGeneral(AJAX)/backend/eliminar.php",AEliminar);
    
}
*/