
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar</title>
</head>
<body>
    <form action="eliminar.php" method="GET">
        <?php
            require_once "fabrica.php";
           
            $path = "Archivos/empleados.txt";
            $fabrica = new Fabrica(" ",7);
            $fabrica = $fabrica->TraerDeArchivo($path);
            $archivo = fopen($path,"r");

            if($archivo != null)
            { 
                while (!feof($archivo)){
                    
                    //echo (fgets($archivo) . "<br>");
                    
                    $linea = fgets($archivo);
                    if($linea != false)
                    {
                        $array = explode(" - ",$linea);
                        $empleado = new Empleado($array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6]);
                        echo $empleado->__toString() . "<a href = eliminar.php?legajo=$array[4]> Eliminar</a>" . "<br>";
                        
                    }
                }
            }
            fclose($archivo); 

            echo "<a href = 'index.html'>Inicio</a>";
        ?>
    </form>
</body>
</html>
