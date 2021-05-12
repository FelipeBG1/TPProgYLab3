<?php

    require_once "../vendor/autoload.php";
    require_once "../backendBD/fabrica_BD.php";
    
    session_start();
    $dniSession = $_SESSION["DNIEmpleado"];

    $fabrica = new Fabrica("x",7);
    $fabrica->TraerDeBaseDatos();
    $empleados = $fabrica->GetEmpleados();

    $mpdf = new \Mpdf\Mpdf(['orientation' => 'p',
                            'pagenumPrefix' => 'Pagina nro.',
                            'pagenumSuffix' => ' - ',
                            'nbgPrefix' => ' de ',
                            'nbgSuffix' => ' páginas']);
           
    $mpdf->SetProtection(array(),$dniSession,"MyPassword");
    $mpdf->SetHeader('Bustos Gil Felipe - {PAGENO}{nbpg}');
    $mpdf->setFooter('https://tp1bustosgilfelipe.000webhostapp.com/indexBD.html');
    $mpdf->WriteHTML("<h1>Bustos Gil Felipe</h1> <br>");
    $mpdf->WriteHTML("<h3>Listado de empleados</h3> <br>");
    $mpdf->WriteHTML("<table border=1 align=center>
                    <tr>
                    <th>Dni</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Sexo</th>
                    <th>Legajo</th>
                    <th>Sueldo</th>
                    <th>Turno</th>
                    <th>PathFoto</th>
                    <th>Foto</th>
                    ");

    foreach($empleados as $item)
    {
        $mpdf->WriteHTML("<tr>
                    <td>{$item->GetDni()}</td>
                    <td>{$item->GetNombre()}</td>
                    <td>{$item->GetApellido()}</td>
                    <td>{$item->GetSexo()}</td>
                    <td>{$item->GetLegajo()}</td>
                    <td>{$item->GetSueldo()}</td>
                    <td>{$item->GetTurno()}</td>
                    <td>{$item->GetPathFoto()}</td>
                    <td><img src={$item->GetPathFoto()} width=50px height=50px></td>
                    </tr>");
    }

    $mpdf->WriteHTML("</table>");
    $mpdf->Output("ListadoEmpleadosTPBustosGil","I");
?>