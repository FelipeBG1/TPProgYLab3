<!DOCTYPE html>
<html lang="en">
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
        $path = "Archivos/empleados.txt";
        $archivo = fopen($path,"r");
        $finded = false;
        
            while (!feof($archivo)){
                
                $linea = fgets($archivo);              
                $linea = is_string($linea) ? trim($linea) : false;

                if($linea != false)
                {
                    $array = explode(" - ",$linea);
                    if($legajo == $array[4])
                    {
                        $empleado = new Empleado($array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6]);
                        $fabrica = new Fabrica(" ",7); 
                        $fabrica = $fabrica->TraerDeArchivo($path);
                        $nuevaFabrica = $fabrica->EliminarEmpleado($empleado);
                        
                        if($nuevaFabrica != null)
                        {   
                            $nuevaFabrica->GuardarEnArchivo($path);
                            echo "Empleado eliminado con exito <br>";
                            echo "<a href='mostrar.php'>Mostrar empleados</a>";
                            break;                            
                        }
                        else
                        {
                            echo "No se pudo eliminar al empleado" . "<br>";
                            echo "<a href = 'index.html'>Inicio</a>" . "<br>";
                        } 
                        
                        break; 
                    }
                    else
                    {
                        echo "El empleado con el legajo" . $legajo . "no se encuentra en la lista";
                    }      
                }            
            }            
            fclose($archivo);          
    ?>        
</body>
</html>


