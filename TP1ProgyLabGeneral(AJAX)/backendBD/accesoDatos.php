<?php

    class AccesoDatos{

        private static $objetoAccesoDatos;
        private $objetoPDO;

        public function __construct()
        {
            try
            {
                /*
                $host = "localhost";
                $user = 'id16588829_gikerucsu';
                $pass = '5[J}Ys^[g*#i|wfa';
                $base = "id16588829_usuarios_test";
                */
                $host = "localhost";
                $user = "root";
                $pass = "";
                $base = "empleadosbd";
                $this->objetoPDO = new PDO('mysql:host=localhost; dbname=empleadosbd', $user, $pass);
                        
            }
            catch(PDOException $e)
            {
                echo "Error " . $e->getMessage();
            }
        }

        public function RetornarConsulta($sql)
        {
            return $this->objetoPDO->prepare($sql);
        }
    
        public static function ObjAcceso()
        {
            if (!isset(self::$objetoAccesoDatos)) {       
                
                self::$objetoAccesoDatos = new AccesoDatos(); 
            }
     
            return self::$objetoAccesoDatos;        
        }

        public function __clone()
        {
            trigger_error('La clonacion de este objeto no esta; permitida!', E_USER_ERROR);
        }
    
    }
?>