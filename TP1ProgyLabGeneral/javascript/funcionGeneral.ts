var AdministrarValidaciones : Function = (e : Event) => {

    let sueldo : string = (<HTMLInputElement> document.getElementById("txtSueldo")).value;
    let sueldoMax : number = ObtenerSueldoMaximo(ObtenerTurnoSeleccionado());
    let dniObtenido : string = (<HTMLInputElement> document.getElementById("txtDni")).value;
    let legajoObtenido : string = (<HTMLInputElement> document.getElementById("txtLegajo")).value;  
    
    if(!ValidarCamposVacios("txtDni")
        ||!ValidarCamposVacios("txtApellido")
        ||!ValidarCamposVacios("txtNombre")
        ||!ValidarCamposVacios("txtSueldo")
        ||!ValidarCamposVacios("txtLegajo"))
        {
            alert("Uno o varios campos se encuentran sin completar");
            e.preventDefault();
        }

    if(!ValidarRangoNumerico(parseInt(sueldo),8000,sueldoMax))
    {
        alert("El sueldo no se encuentra dentro de los limites");
        e.preventDefault();

    }
    if(!ValidarRangoNumerico(parseInt(dniObtenido), 1000000, 55000000 ))
    {
        alert("Dni incorrecto.");
        e.preventDefault();
    }

    if(!ValidarRangoNumerico(parseInt(legajoObtenido),100,550))
    {
        alert("Legajo incorrecto.");
        e.preventDefault();
    }

    if(!ValidarCombo("cboSexo","---"))
    {
        alert("Seleccione sexo");
        e.preventDefault();
    }

}