<?php

    require_once "./backendBD/fabrica_BD.php";
    require_once "./backendBD/empleado_BD.php";
    include_once "./backendBD/validarSesion_BD.php";


    $dni= null;
    $apellido= null;
    $nombre= null;
    $sexo= null;
    $legajo= null;
    $sueldo= null;
    $turno= null;
    $foto= null;


    $dni = isset($_POST["txtDni"]) ? $_POST["txtDni"] : 0;
    
    if($dni != 0)
    {
        $fabrica = new Fabrica("");
        $fabrica->TraerDeBaseDatos();
        $empleadoAModificar = null;
    }

    $fabrica = new Fabrica("",7);
    $fabrica->TraerDeBaseDatos();
    $empleadoaAModificar = null;


    foreach($fabrica->GetEmpleados() as $item)
    {
        if($dni == $item->GetDni())
        {
            $empleadoAModificar = $item;
            $nombre = $item->GetNombre();
            $apellido = $item->GetApellido();
            $legajo = $item->GetLegajo();
            $sexo = $item->GetSexo();
            $sueldo = $item->GetSueldo();
            $turno = $item->GetTurno();
            $foto = $item->GetPathFoto();
            break;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TP Programacion y Laboratorio 3</title>
        <script src="./javascript/funcionesBD.js"></script>
        <link rel="stylesheet" href="estilos.css" type="text/css"/>
    </head>
    <body>
        <br>     
            <?php
                if($dni != 0)
                {
                    echo "<h2>Modificar Empleado</h2>";
                }
                else
                {
                    echo "<h2>Alta de Empleados</h2>";
                }      
            ?>           
            <table>
                <form action="./backendBD/administracion_BD.php" method="POST" enctype="multipart/form-data">
                    <caption>
                    <tr>
                        <th style="text-align:left;padding-left:5px" colspan="2">
                            <h4>Datos personales</h4>
                        </th>
                        <tr>
                            <td style="text-align:left;padding-left:5px" colspan="2"><hr></td>
                        </tr>
                    </tr>
                    </caption>
                    
                    <tr>
                        <td style="text-align: left; padding-left:15px">DNI: </td>
                        <td> 
                            <input type="number" name="txtDni" id="txtDni"
                            value=<?php echo $dni; if($dni != 0) echo " readonly"?>/>
                            <span id="spanTxtDni" style="display: none;">*</span>

                        </td>
                    </tr>
                
                    <tr>
                        <td style="text-align: left; padding-left:15px">Apellido: </td>
                        <td> 
                            <input type="text" name="txtApellido" id="txtApellido"
                            value=<?php echo $apellido?>>
                            <span id="spanTxtApellido" style="display: none;">*</span> 
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: left; padding-left:15px">Nombre: </td>
                        <td> 
                            <input type="text" name="txtNombre" id="txtNombre"
                            value=<?php echo $nombre?>> 
                            <span id="spanTxtNombre" style="display: none;">*</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: left; padding-left:15px">Sexo: </td>
                        <td> 
                            <select name="cboSexo" id="cboSexo">
                                <option value="---">Seleccione</option>
                                <option value="F"
                                <?php echo ($sexo == "F") ? "selected" : "";?>
                                >Femenino</option>
                                <option value="M"
                                <?php echo ($sexo == "M") ? "selected" : "";?>
                                >Masculino</option>
                            </select>
                            <span id="spanCboSexo" style="display: none;">*</span>
                        </td>
                    </tr>

                    <caption>
                        <tr>
                            <td style="text-align:left;padding-left:5px" colspan="2">
                                <h4 align="justify">Datos Laborales</h4>
                                
                                <hr/>
                                
                            </td>
                        
                        </tr>
                        
                    </caption>
                    
                    <tr>
                        <td style="text-align: left; padding-left:15px">Legajo: </td>
                        <td> 
                            <input type="number" name="txtLegajo" id="txtLegajo"
                            value=<?php echo $legajo; if($dni != 0) echo " readonly"?>>
                            <span id="spanTxtLegajo" style="display: none;">*</span> 
                        </td>
                    </tr>
                
                    <tr>
                        <td style="text-align: left; padding-left:15px">Sueldo: </td>
                        <td> 
                            <input type="number" name="txtSueldo" id="txtSueldo" step = "500"
                            value=<?php echo $sueldo?>>
                            <span id="spanTxtSueldo" style="display: none;">*</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: left; padding-left:15px">Turno: </td>          
                    </tr>

                    <tr>
                        <td style="text-align: left; padding-left:60px">
                            <input type="radio" name="rdoTurno" value="0" checked
                            <?php echo ($turno == "M") ? "checked" : ""?>>
                        </td>
                        <td>Mañana</td>             
                    </tr>
                    
                    <tr>
                        <td style="text-align: left; padding-left:60px">
                            <input type="radio" name="rdoTurno" value="1"
                            <?php echo ($turno == "T") ? "checked" : ""?>>
                        </td>
                        <td>Tarde</td>             
                    </tr>
                    
                    <tr>
                        <td style="text-align: left; padding-left:60px">
                            <input type="radio" name="rdoTurno" value="2"
                            <?php echo ($turno == "N") ? "checked" : ""?>>
                        </td>
                        <td>Noche</td>             
                    </tr>
                    <tr>
                        <td style="text-align: left; padding-left:15px">Foto:</td>
                        <td>  
                            <input type="file" name="foto" id="idFoto"/>
                            <span id="spanFoto" style="display: none;">*</span>
                            <input type="hidden" name="hdnModificar" id="hdnModificar" value=<?php echo ($dni != 0) ? "Ok" : null?>>
                        </td>                                               
                    </tr>

                    <caption>
                        <tr>
                            <td style="text-align:left;padding-left:5px" colspan="2">
                                <hr>
                            </td>
                        </tr>    
                    </caption>

                    <tr>
                        <td align = "right "colspan="2" >
                            <input type="reset" onClick=CargarFrmAoM() value="Limpiar">
                        </td>
                    </tr>

                    <tr>
                        <td align = "right "colspan="2">
                            <input type="submit" onClick=AdministrarValidaciones(event) name="btnEnviar" id="btnEnviar" value=<?php echo isset($_POST["dni"])? "Modificar" : "Enviar";?>>
                        </td>
                    </tr>
                </form>            
            </table> 
        <br>
        
    </body>
</html>