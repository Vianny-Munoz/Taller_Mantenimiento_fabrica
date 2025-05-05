<?php
date_default_timezone_set('America/Mexico_City');

include 'ConexionDB/conexion.php';

//Validar Fechas
$fechaIncidencia = $_POST['fecha_incidencia'];
$fechaReparacion = $_POST['fecha_reparacion'];
$hoy = date('Y-m-d');

if($fechaIncidencia > $hoy){
        header("location: incidencias.php?mensaje=La fecha ingreso no puede ser mayor a hoy");
        exit();
}

if($fechaReparacion < $fechaIncidencia){
        header("location: incidencias.php?mensaje=La fecha de reparacion no puede ser mayor a la de ingreso");
        exit();
}

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