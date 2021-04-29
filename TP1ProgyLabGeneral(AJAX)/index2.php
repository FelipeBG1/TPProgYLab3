<?php
include_once "./backend/validarSesion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./javascript/funcionesBD.js"></script>
    <link rel="stylesheet" href="estilos.css" type="text/css"/>
</head>
<body>
<?php
ValidarSesion("loginBD.html");                
?>
<div class="container">
            <div class="divs links">Bustos Gil Felipe</div>
            <table>
                <tbody>               
                    <tr>
                        <td width="95%">
                            <div class="divs altaModificar" id="divFrm"></div>
                        </td>
                        <td rowspan="2">
                            <div class="divs mostrar "id="divEmpleados">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="divs links">
                <a href="./backendBD/cerrarSesion.php">Log Out</a>
            </div>
        
</div>
      
</body>
</html>