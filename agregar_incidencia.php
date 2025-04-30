<?php

include 'ConexionDB/conexion.php';

$codigo_inventario = $_POST['codigo_inventario'];
$cedula_tecnico = $_POST['cedula_tecnico'];
$fecha_incidencia = $_POST['fecha_incidencia'];
$tipo_mantenimiento = $_POST['tipo_mantenimiento'];
$fecha_reparacion = $_POST['fecha_reparacion'];

$sql = "INSERT INTO incidencias (codigo_inventario, cedula_tecnico, fecha_incidencia, tipo_mantenimiento, fecha_reparacion)
        VALUES ('$codigo_inventario', '$cedula_tecnico', '$fecha_incidencia', '$tipo_mantenimiento', '$fecha_reparacion')";

if (mysqli_query($conexion, $sql)) {
    echo "Incidencia registrada exitosamente.";
} else {
    echo "Error: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>