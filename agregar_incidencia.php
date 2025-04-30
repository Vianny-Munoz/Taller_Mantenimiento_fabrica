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
    // echo "Incidencia registrada exitosamente.";
        // Redirigir a la página incidencias.php con un mensaje de éxito
        header("Location: incidencias.php?mensaje=Incidencia registrada exitosamente");
        exit();
    
} else {
        // Redirigir a la página incidencias.php con un mensaje de error
        header("Location: incidencias.php?mensaje=Error al registrar incidencia");
        exit();
}

mysqli_close($conexion);
?>