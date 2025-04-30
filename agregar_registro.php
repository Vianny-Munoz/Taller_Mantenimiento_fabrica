<?php

include 'ConexionDB/conexion.php';

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$celular = $_POST['celular'];
$especialidad = $_POST['especialidad'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$sql = "INSERT INTO tecnicos (cedula, nombre, apellido, celular, especialidad, email, usuario, contrasena)
        VALUES ('$cedula', '$nombre', '$apellido', '$celular', '$especialidad', '$email', '$usuario', '$contrasena')";

if (mysqli_query($conexion, $sql)){
    echo "Registro exitoso.";
}else{
    echo "Error: ". mysqli_error($conexion);
}

mysqli_close($conexion);
?>