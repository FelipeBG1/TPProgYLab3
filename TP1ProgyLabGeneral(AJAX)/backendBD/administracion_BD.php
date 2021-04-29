<?php

use function PHPSTORM_META\type;

    require_once "empleado_BD.php";
    require_once "fabrica_BD.php";

    $dni = isset($_POST["txtDni"]) ? $_POST["txtDni"] : 0;           
    $nombre = isset($_POST["txtNombre"]) ? $_POST["txtNombre"] : 0;
    $apellido = isset($_POST["txtApellido"]) ? $_POST["txtApellido"] : 0;
    $sexo = isset($_POST["cboSexo"]) ? $_POST["cboSexo"] : 0;
    $legajo = isset($_POST["txtLegajo"]) ? $_POST["txtLegajo"] : 0;
    $sueldo = isset($_POST["txtSueldo"]) ? $_POST["txtSueldo"] : 0;
    $turno = isset($_POST["rdoTurno"]) ? $_POST["rdoTurno"] : 0;
    $foto = isset($_FILES["foto"]) ? $_FILES["foto"] : 0;
    $modificar = isset($_POST["hdnModificar"]) ? $_POST["hdnModificar"] : 0;

    switch($turno)
    {
        case "0":
            $turno = "M";
            break;
        case "1":
            $turno = "T";
            break;
        case "2":
            $turno = "N";
            break;
    }
                
    $destino = "../fotos/" . $foto["name"];
    $empleado = new Empleado($nombre,$apellido,$dni,$sexo,$legajo,$sueldo,$turno);
    $fabrica = new Fabrica("XD",7);
    $fabrica->TraerDeBaseDatos();
    $empleadoAModificar = null;

    if($modificar == "Ok")
    {
        foreach($fabrica->GetEmpleados() as $item)
        {
            if($item->GetDni() == $dni)
            {
                $empleadoAModificar = $item;
                break;
            }
        }
    }          
    
    $esUnaFoto= getimagesize($foto["tmp_name"]);
    
    if($esUnaFoto != false)
    {
        $todoOk = false;
        $flag = false;
        $tipo = pathinfo($destino,PATHINFO_EXTENSION);
        $apellidoNuevo = str_replace(" ","",$apellido);
        $destino= "../fotos/" . $dni . "-" . $apellidoNuevo . "." . $tipo;
        
        
        if($tipo == "jpg" || $tipo == "bmp" || $tipo == "gif" || $tipo == "png" || $tipo == "jpeg")
        {
            if($foto["size"] <= 1000000)
            {
                $flag = true;
            }
        }
    }

    if(!file_exists($destino) && $flag)
    {
        $todoOk = true;
    }

    if($empleadoAModificar != null && $flag)
    {
        $fabrica->BajaEmpleado_BD($empleadoAModificar);                         
        unlink($empleadoAModificar->GetPathFoto());
        $todoOk = true;
    }

    if($todoOk)
    {
        $empleado = new Empleado($nombre,$apellido,$dni,$sexo,$legajo,$sueldo,$turno);         
        move_uploaded_file($foto["tmp_name"],$destino);
        $empleado->SetPathFoto($destino); 
        $fabrica->AltaEmpleado_BD($empleado);   
    }
 
?>       
    

