<?php
    
    require_once "empleado_BD.php";
    require_once "fabrica_BD.php";

    $dni = isset($_POST["txtDni"]) ? $_POST["txtDni"] : 0;
    $apellido = isset($_POST["txtApellido"]) ? $_POST["txtApellido"] : 0;


        $fabrica = new Fabrica("",7);
        $fabrica->TraerDeBaseDatos();
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
            header("Location: ../indexBD.php");
        }
        else
        {
            echo "No hay ningún empleado con esos datos <br/>";
            echo "<a href=../loginBD.html>Login</a>";
        }
?>      