<?php

    require "persona.php";
     
    class Empleado extends Persona{

        protected $_legajo;
        protected $_sueldo;
        protected $_turno;

        public function __construct($nombre,$apellido,$dni,$sexo,$_legajo,$_sueldo,$_turno){

            parent::__construct($nombre,$apellido,$dni,$sexo);
            $this->_legajo=$_legajo;
            $this->_sueldo=$_sueldo;
            $this->_turno=$_turno;
        }

        public function GetLegajo()
        {
            return $this->_legajo;
        }

        public function GetSueldo()
        {
            return $this->_sueldo;
        }
        public function GetTurno()
        {
            return $this->_turno;
        }

        public function Hablar($idioma)
        {
            $cadena = "El empleado habla: ";
            $resultado = "";

            foreach($idioma as $item)
            {
                if($resultado == "")
                {
                    $resultado = $resultado . $item;
                }
                else
                {
                    $resultado = $resultado . ", " . $item;
                }
            }

            return $cadena . $resultado;
        }

        public function __toString()
        {
            return parent::__toString() . " - " . $this->GetLegajo() . " - " . $this->GetSueldo() . " - " . $this->GetTurno();
        }
      
    }


?>