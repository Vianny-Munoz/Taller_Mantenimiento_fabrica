<?php
$conexion = new mysqli("localhost", "root", "", "mantenimientofabricadb");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sql = "SELECT * FROM equipos";
$resultado = $conexion->query($sql);

$equipos = [];

while ($fila = $resultado->fetch_assoc()) {
    $equipos[] = $fila;
}

echo json_encode($equipos);

$conexion->close();
?>
