var ValidarCamposVacios : Function = (id : string) : boolean =>{

    let valor : string = (<HTMLInputElement> document.getElementById(id)).value;
    
    valor = valor.replace(/ /g, "");
    
    if(valor === "" || valor == undefined)
    {
        return false;
    }
    else
    {
        return true;
    }
}

var ValidarRangoNumerico : Function = (numeroAValidar: number,rangoMinimo : number,rangoMaximo : number) : boolean =>{

    if(numeroAValidar >= rangoMinimo && numeroAValidar <= rangoMaximo)
    {
        return true;
    }
    else
    {
        return false;
    }

}

var ValidarCombo : Function = (id : string, valorIncorrecto : string) : boolean =>{

    let valor : string = (<HTMLInputElement> document.getElementById(id)).value;

    if(valor != valorIncorrecto)
    {
        return true;
    }
    else
    {
        return false;
    }

}

var ObtenerTurnoSeleccionado : Function = () : number => {

    let elemento : NodeListOf<HTMLInputElement> = (document.querySelectorAll('input[name="rdoTurno"]'));
    let valor : number = 0;
    
    for(let i: number = 0; i < elemento.length; i++)
    {
        if(elemento[i].checked)
        {
            valor = parseInt(elemento[i].value)
            break;
        }
    }
    
    return valor;
}

var ObtenerSueldoMaximo : Function = (turno : number) : number =>{

    let sueldo : number = 0;
    switch(turno)
    {
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
}

var AdministrarSpanError : Function = (id : string, bool : boolean) : void=>{

    let span : HTMLElement = (<HTMLElement> document.getElementById(id));

    if(bool)
    {
        span.style.display = "block";
    }
    else
    {
        span.style.display = "none";
    }
}

var VerificarValidacionesLogin : Function = (): boolean =>{
    
    let spanDni : string = (<HTMLElement>document.getElementById("spanTxtDni")).style.display;
    let spanApellido : string = (<HTMLElement>document.getElementById("spanTxtApellido")).style.display;

    if(spanDni === "none" && spanApellido === "none")
    {
        return true;
    }
    
    return false;
}

var AdministrarModificar : Function = ($dni : string)=>{

    let input : HTMLInputElement = (<HTMLInputElement>document.getElementById("hiddenInput"));
    let form = <HTMLFormElement>document.getElementById("formMostrar");
    input.value=$dni;

    form.submit();
}

