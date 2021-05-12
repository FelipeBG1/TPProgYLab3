<?php
    
    require_once "empleado.php";
    require_once "fabrica.php";

    $dni = isset($_POST["txtDni"]) ? $_POST["txtDni"] : 0;
    $apellido = isset($_POST["txtApellido"]) ? $_POST["txtApellido"] : 0;

    $path = "../Archivos/empleados.txt";
    
    
    if(file_exists($path))
    {
        $fabrica = new Fabrica("",7);
        $fabrica->TraerDeArchivo($path);
        $finded = false;

        foreach($fabrica->GetEmpleados() as $item)
        {
            if($dni == $item->GetDni() && $apellido == $item->GetApellido())
            {
                $finded = true;
                break;
            }
        }
        
        if($finded)
        {
            session_start();
            $_SESSION["DNIEmpleado"]=$dni;
            header("Location: ../indexArchivos.php");
        }
        else
        {
            echo "No hay ningún empleado con esos datos <br/>";
            echo "<a href=../login.html>Login</a>";
        }

    }
     
?>      