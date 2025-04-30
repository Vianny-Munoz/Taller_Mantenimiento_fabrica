<?php
    $conexion=mysqli_connect("localhost", "root", "", "mantenimientofabricadb");
        if(!$conexion){
            echo "Error de conexion: " . mysqli_connect_error();
            exit();
        }

?>