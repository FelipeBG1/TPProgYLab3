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

var ObtenerTurnoSeleccionado : Function = () : string => {

    let elemento : NodeListOf<HTMLInputElement> = (document.querySelectorAll('input[name="rdoTurno"]'));
    let valor : number = 0;
    let turno : string = "";
    
    for(let i: number = 0; i < elemento.length; i++)
    {
        if(elemento[i].checked)
        {
            valor = parseInt(elemento[i].value)
            break;
        }
    }
    
   switch(valor)
   {
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
}

var ObtenerSueldoMaximo : Function = (turno : string) : number =>{

    let sueldo : number = 0;
    switch(turno)
    {
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
}


