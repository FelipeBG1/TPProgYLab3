<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar empleado</title>
</head>
<body>
    <?php
        require_once "empleado.php";
        require_once "fabrica.php";

        $legajo = isset($_GET["legajo"]) ? $_GET["legajo"] : 0;
        $path = "../Archivos/empleados.txt";
        $archivo = fopen($path,"r");
        $finded = false;
        $fabrica = new Fabrica("",7); 
        $fabrica->TraerDeArchivo($path);
        
        foreach($fabrica->GetEmpleados() as $item)
        {
            if($legajo == $item->GetLegajo())
            {                
                if($fabrica->EliminarEmpleado($item))
                {                 
                    unlink($item->GetPathFoto());
                    $fabrica->GuardarEnArchivo($path);
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
</body>
</html>


