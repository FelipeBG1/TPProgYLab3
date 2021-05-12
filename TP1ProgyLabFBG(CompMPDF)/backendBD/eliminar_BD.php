<?php
    require_once "empleado_BD.php";
    require_once "fabrica_BD.php";

    $legajo = isset($_GET["legajo"]) ? $_GET["legajo"] : 0;
    $finded = false;
    $fabrica = new Fabrica("",7); 
    $fabrica->TraerDeBaseDatos();
    
    foreach($fabrica->GetEmpleados() as $item)
    {
        if($legajo == $item->GetLegajo())
        {                
            if($fabrica->BajaEmpleado_BD($item))
            {                 
                unlink($item->GetPathFoto());
                break; 
            }            
            else
            {
                echo "No se pudo eliminar al empleado" . "<br>";
                break; 
            }             
        }
    } 
?>        



