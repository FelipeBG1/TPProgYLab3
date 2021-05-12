<?php
    require_once "empleado_BD.php";
    require_once "accesoDatos.php";

    class Fabrica{

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

        public function TraerDeBaseDatos()
        {    
            $objetoAccesoDato = AccesoDatos::ObjAcceso();
            
            $query = $objetoAccesoDato->RetornarConsulta("SELECT * FROM empleados");        
            
            $query->execute();
            
            $query->setFetchMode(PDO::FETCH_OBJ); 
            
            foreach($query as $item)
            {
                $empleado = new Empleado($item->nombre,$item->apellido,$item->dni,$item->sexo,$item->legajo,$item->sueldo,$item->turno);
                $empleado->SetPathFoto($item->pathfoto);
                $this->AgregarEmpleado($empleado);
            }
        }

        public function AltaEmpleado_BD($emp)
        {
            $objetoAccesoDato = AccesoDatos::ObjAcceso();      
            $query = $objetoAccesoDato->RetornarConsulta("INSERT INTO empleados (dni, nombre, apellido, sexo, legajo, sueldo, turno, pathfoto) 
                                                            VALUES (:dni, :nombre, :apellido, :sexo, :legajo, :sueldo, :turno, :pathfoto)");
            $query->bindValue(':dni', $emp->GetDni(), PDO::PARAM_INT);
            $query->bindValue(':nombre', $emp->GetNombre(), PDO::PARAM_STR);
            $query->bindValue(':apellido', $emp->GetApellido(), PDO::PARAM_STR);
            $query->bindValue(':sexo', $emp->GetSexo(), PDO::PARAM_STR);
            $query->bindValue(':legajo', $emp->GetLegajo(), PDO::PARAM_INT);
            $query->bindValue(':sueldo', $emp->GetSueldo(), PDO::PARAM_INT);
            $query->bindValue(':turno', $emp->GetTurno(), PDO::PARAM_STR);
            $query->bindValue(':pathfoto', $emp->GetPathFoto(), PDO::PARAM_STR);
    
            try{
                $query->execute();
                $this->AgregarEmpleado($emp);
                return true;
            }
            catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
                   
        }

        public function BajaEmpleado_BD($empleado)
        {
            $objetoAccesoDato = AccesoDatos::ObjAcceso();
            
            $query =$objetoAccesoDato->RetornarConsulta("DELETE FROM empleados WHERE legajo = :legajo");
            
            $query->bindValue(':legajo', $empleado->GetLegajo(), PDO::PARAM_INT);

            try{
                $query->execute();
                $this->EliminarEmpleado($empleado);
                return true;
            }
            catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
        }


    }   

?>