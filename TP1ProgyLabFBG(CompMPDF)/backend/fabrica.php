<?php
    require_once "empleado.php";
    require_once "interfaces.php";

    class Fabrica implements IArchivo{

        private $_cantidadMaxima;
        private $_empleados;
        private $_razonSocial;

        public function __construct($razonSocial,$cantidad = 5)
        {
            $this->_razonSocial = $razonSocial;
            $this->_empleados = array();
            $this->_cantidadMaxima = $cantidad;
        }

        public function GetEmpleados()
        {
            return $this->_empleados;
        }
        
        public function AgregarEmpleado($emp)
        {
            if($this->_cantidadMaxima > count($this->_empleados))
            {
                array_push($this->_empleados, $emp);
                $this->EliminarEmpleadoRepetido();
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function CalcularSueldos()
        {
            $totalSueldos = 0;

            foreach($this->_empleados as $item)
            {
                $totalSueldos += $item->GetSueldo();
            }

            return $totalSueldos;
        }

        public function EliminarEmpleado($emp)
        {
            foreach($this->_empleados as $key => $value)
            {
                if($value->GetLegajo() === $emp->GetLegajo())
                {
                    unset($this->_empleados[$key]);
                    return $this;
                }
            }

            return false;
        }

        private function EliminarEmpleadoRepetido()
        {
            $this->_empleados = array_unique($this->_empleados, SORT_REGULAR);
        }

    
        public function ToString()
        {
            $cadena = "";

            foreach($this->_empleados as $item)
            {
                $cadena .= $item->__ToString() . "<br>";
            }

            $cadena .= "<br>" . "Cantidad máxima de empleados: " . $this->_cantidadMaxima . " - " . "Razón social: " . $this->_razonSocial
            . " - " . "Total sueldos: " . $this->CalcularSueldos() . "<br>";

            return $cadena;
        }

        public function TraerDeArchivo($nombreArchivo)
        {
            if(file_exists($nombreArchivo))
            {
                $archivo = fopen($nombreArchivo,"r");
                
                if(filesize($nombreArchivo))
                {
                    while (!feof($archivo)){
                    
                        $linea = fgets($archivo);
                        $linea = is_string($linea) ? trim($linea) : false;
                        $array = explode(" - ",$linea);
                        
                        if($array[0] != "" && $array[0] != "\r\n")
                        {
                            $empleado = new Empleado($array[1],$array[2],$array[0],$array[3],$array[4],$array[5],$array[6]);
                            $empleado->SetPathFoto($array[7]);
                            $this->AgregarEmpleado($empleado);

                        }
                    }
                   
                }
                 fclose($archivo); 
            }    
        }

        public function GuardarEnArchivo($nombreArchivo)
        {
            $archivo = fopen($nombreArchivo,"w");
            
            if($archivo != null)
            {
                foreach($this->_empleados as $item)
                {
                    fwrite($archivo, $item->__toString() . "\r\n");
                     
                }
                fclose($archivo);         
            }
           
        }

    }   

?>