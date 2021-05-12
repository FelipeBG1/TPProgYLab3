<?php

    require_once "./backend/fabrica.php";
    require_once "./backend/empleado.php";
    include_once "./backend/validarSesion.php";


    $dni = "";
    $apellido = "";
    $nombre = "";
    $sexo = "";
    $legajo = "";
    $sueldo = "";
    $turno = "";
    $foto = "";
    $cboSexoM = "";
    $cboSexoF = "";
    $readonly = "readonly";
    $rdoTurnoM = "checked";
    $rdoTurnoT = "";
    $rdoTurnoN = "";
    $hiddenModificar = "";
    $boton = "Enviar";


    $dni = isset($_POST["txtDni"]) ? $_POST["txtDni"] : NULL;
    
    if($dni != NULL)
    {
        $fabrica = new Fabrica("");
        $path = "./Archivos/empleados.txt";
        $fabrica->TraerDeArchivo($path);
        $empleadoAModificar = null;
        foreach($fabrica->GetEmpleados() as $item)
        {
            if($dni == $item->GetDni())
            {
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

        $hiddenModificar = "Ok";
        $boton = "Modificar";

        switch($turno)
        {
            case "M":
                $rdoTurnoM = "checked";
                break;
            case "T":
                $rdoTurnoT = "checked";
                $rdoTurnoM = "";
                break;
            case "N":
                $rdoTurnoN = "checked";
                $rdoTurnoM = "";
                break;
        }
        if($sexo == "M")
        {
            $cboSexoM = "selected";
        }
        else
        {
            $cboSexoF = "selected";
        }
    }

    if($dni != NULL)
    {
        echo "<h2>Modificar Empleado</h2>";
    }
    else
    {
        echo "<h2>Alta de Empleados</h2>";
    }     

    echo "<table align=center>     
            <caption>
            <tr>
                <th style=text-align:left;padding-left:5px colspan=2>
                    <h4>Datos personales</h4>
                </th>
                <tr>
                    <td style=text-align:left;padding-left:5px colspan=2><hr></td>
                </tr>
            </tr>
            </caption>
            
            <tr>
                <td style=text-align: left; padding-left:15px>DNI: </td>
                <td> 
                    <input type=number name=txtDni id=txtDni
                    value=$dni $readonly>
                    <span id=spanTxtDni style= display:none>*</span>
                </td>
            </tr>
        
            <tr>
                <td style=text-align: left; padding-left:15px>Apellido: </td>
                <td> 
                    <input type=text name=txtApellido id=txtApellido
                    value=$apellido>
                    <span id=spanTxtApellido style= display:none>*</span> 
                </td>
            </tr>
            
            <tr>
                <td style=text-align: left; padding-left:15px>Nombre: </td>
                <td> 
                    <input type=text name=txtNombre id=txtNombre
                    value=$nombre> 
                    <span id=spanTxtNombre style= display:none>*</span>
                </td>
            </tr>
            
            <tr>
                <td style=text-align: left; padding-left:15px>Sexo: </td>
                <td> 
                    <select name=cboSexo id=cboSexo>
                        <option value=--->Seleccione</option>
                        <option value=F $cboSexoF>Femenino</option>
                        <option value=M $cboSexoM>Masculino</option>
                    </select>
                    <span id=spanCboSexo style= display:none>*</span>
                </td>
            </tr>

            <caption>
                <tr>
                    <td style=text-align:left;padding-left:5px colspan=2>
                        <h4 align=justify>Datos Laborales</h4>
                        
                        <hr/>
                        
                    </td>
                
                </tr>
                
            </caption>
            
            <tr>
                <td style=text-align: left; padding-left:15px>Legajo: </td>
                <td> 
                    <input type=number name=txtLegajo id=txtLegajo
                    value= $legajo $readonly>
                    <span id=spanTxtLegajo style= display:none>*</span> 
                </td>
            </tr>
        
            <tr>
                <td style=text-align: left; padding-left:15px>Sueldo: </td>
                <td> 
                    <input type=number name=txtSueldo id=txtSueldo step = 500
                    value= $sueldo>
                    <span id=spanTxtSueldo style= display:none>*</span>
                </td>
            </tr>
            
            <tr>
                <td style=text-align: left; padding-left:15px>Turno: </td>          
            </tr>

            <tr>
                <td style=text-align: left; padding-left:60px>
                    <input type=radio name=rdoTurno value=0 $rdoTurnoM>
                </td>
                <td>Mañana</td>             
            </tr>
            
            <tr>
                <td style=text-align: left; padding-left:60px>
                    <input type=radio name=rdoTurno value=1 $rdoTurnoT>
                </td>
                <td>Tarde</td>             
            </tr>
            
            <tr>
                <td style=text-align: left; padding-left:60px>
                    <input type=radio name=rdoTurno value=2 $rdoTurnoN>
                </td>
                <td>Noche</td>             
            </tr>
            <tr>
                <td style=text-align: left; padding-left:15px>Foto:</td>
                <td>  
                    <input type=file name=foto id=idFoto>
                    <span id=spanFoto style= display:none>*</span>
                    <input type=hidden name=hdnModificar id=hdnModificar value=$hiddenModificar>
                </td>                                               
            </tr>

            <caption>
                <tr>
                    <td style=text-align:left;padding-left:5px colspan=2>
                        <hr>
                    </td>
                </tr>    
            </caption>

            <tr>
                <td align = right colspan=2 >
                    <input type=reset onClick=CargarFrmAoM() value=Limpiar>
                </td>
            </tr>

            <tr>
                <td align = right colspan=2>
                    <input type=submit  onClick=AdministrarValidaciones(event) name=btnEnviar id=btnEnviar value=$boton>
                </td>
            </tr>          
    </table>";
    
?>  