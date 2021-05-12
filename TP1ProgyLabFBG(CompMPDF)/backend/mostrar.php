<?php
    require_once "fabrica.php";
    include_once "validarSesion.php";

    $tabla ="<h2>Listado de Empleados</h2>
    <table style=margin-left:50px>             
        <tr>
            <th style=text-align:left;padding-left:15px colspan=2>
                <h4>Info</h4>
            </td>
        </tr>
        <tr>
            <td style=text-align:left;padding-left:15px colspan=3>
                <hr>
            </td>
        </tr>";
        
    $path = "../Archivos/empleados.txt";
    $archivo = fopen($path,"r");
    $fabrica = new Fabrica("",7);
    $fabrica->TraerDeArchivo($path);
    $arrayEmp= $fabrica->GetEmpleados();

    foreach($arrayEmp as $item)
    {
        $path = $item->GetPathFoto();
        $legajo = $item->GetLegajo();
        $cadena = $item->__toString();
        $dni = $item->GetDni();
        $tabla .= "<tr>
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
    echo "<input type=hidden name=dni id=hiddenInput>";
    $tabla.= "<tr>
            <td style=text-align:left;padding-left:15px colspan=3>
                <hr>
            </td>
        </tr>";
    $tabla .=  "</table>";

    echo $tabla;
?>
            
            

