<?php
    require_once "fabrica_BD.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML 5 – Listado de Empleados</title>
    <script src="../javascript/funcionesBD.js"></script>
</head>
<body>
    <h2>Listado de Empleados</h2>
    <table style="margin-left:50px">
        <form action="../indexBD.php" id="formMostrar" method="POST">
            <tr>
                <th style="text-align:left;padding-left:15px" colspan="2">
                    <h4>Info</h4>
                </td>
            </tr>
            <tr>
                <td style="text-align:left;padding-left:15px" colspan="3">
                    <hr>
                </td>
            </tr>
            <?php
                $fabrica = new Fabrica("",7);
                $fabrica->TraerDeBaseDatos();
                $arrayEmp= $fabrica->GetEmpleados();

                foreach($arrayEmp as $item)
                {
                    $path = $item->GetPathFoto();
                    $legajo = $item->GetLegajo();
                    $cadena = $item->__toString();
                    $dni = $item->GetDni();
                    echo "<tr>
                        <td style=text-align:left;padding-left:15px colspan=2>
                            $cadena
                        </td>
                        <td style= text-align:right,padding-left:15px colspan=2>
                        <img src=./Archivos/$path alt=fotoUsuario height=90px widht=90px>
                        </td>
                        <td style=text-align:left;padding-left:15px colspan=2>
                        <input type=button value=Eliminar onClick=AEliminar($legajo)>
                        </td>
                        <td align = right colspan=3>
                        <input type=button value=Modificar onClick=AModificar($dni)>
                        </td>                                              
                    </tr>";  
                }
                echo "<input type=hidden name=dni id=hiddenInput>"
            ?>          
            <tr>
                <td style="text-align:left;padding-left:15px" colspan="3">
                    <hr>
                </td>
            </tr>
        </form>       
    </table>  
</body>
</html>
