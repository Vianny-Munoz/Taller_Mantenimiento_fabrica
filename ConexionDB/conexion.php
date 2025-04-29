<?php
    $conexion=mysqli_connect("localhost", "root", "", "mantenimientofabricadb");
        if(!$conexion){
            echo "Error de conexion: " . mysqli_connect_error();
            exit();
        }
        else{
            echo "Conectado a la base de datos";
        }

?>