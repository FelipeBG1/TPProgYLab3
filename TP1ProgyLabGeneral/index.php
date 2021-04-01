<?php 
    require "empleado.php";
    require_once "persona.php";
    require "fabrica.php";

    $empleado1 = new Empleado("Felipe","Bustos Gil",43171094,'M',100200,43000,"Mañana");
    $empleado2 = new Empleado("Carlos","GGS",43000000,'M',100250,45000,"Noche");
    $empleado3 = new Empleado("Carla","Medina",43100000,'F',100300,47000,"Tarde");
    $fabrica1 = new Fabrica("Ubisoft Entertainment S. A.");

    echo $empleado1-> Hablar(["Ingles","Español","Frances"]);
    echo "<br>";
    echo $empleado1->ToString();
    echo "<br>";
    
    echo $empleado2-> Hablar(["Ingles","Español","Frances"]);
    echo "<br>";
    
    echo $empleado2->ToString();
    echo "<br>";
    
    echo $empleado3-> Hablar(["Ingles","Español","Frances"]);
    echo "<br>";
    
    echo $empleado3->ToString();
    echo "<br>";
    echo "<br>";

    $fabrica1->AgregarEmpleado($empleado1);
    $fabrica1->AgregarEmpleado($empleado2);
    $fabrica1->AgregarEmpleado($empleado3);
    $fabrica1->AgregarEmpleado($empleado3);

    echo "Total de sueldos: " . $fabrica1->CalcularSueldos();
    echo "<br>";
    echo "<br>";
    echo "Empleados de la fábrica: <br> " . $fabrica1->ToString();

    if($fabrica1->EliminarEmpleado($empleado1))
    {
        echo "Empleado eliminado <br>";
    }
    echo "Total de sueldos: " .$fabrica1->CalcularSueldos();
    echo "<br>";
    echo "<br>";
    echo "Empleados de la fábrica: <br> " . $fabrica1->ToString();


     
?>