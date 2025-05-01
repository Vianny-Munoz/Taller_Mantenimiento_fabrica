<?php
// borrar_equipo.php
include 'ConexionDB/conexion.php'; 

// Validar que se recibió el código
if (!isset($_POST['codigo'])) {
    echo "No se recibió el código del equipo.";
    exit;
}

$codigo = $_POST['codigo'];

// Validar que el equipo existe antes de intentar borrarlo
$verificar = $conexion->prepare("SELECT * FROM equipos WHERE codigo_inventario = ?");
$verificar->bind_param("s", $codigo);
$verificar->execute();
$resultado = $verificar->get_result();

if ($resultado->num_rows === 0) {
    echo "Equipo no encontrado.";
} else {
    $stmt = $conexion->prepare("DELETE FROM equipos WHERE codigo_inventario = ?");
    $stmt->bind_param("s", $codigo);
    if ($stmt->execute()) {
        echo "Equipo eliminado correctamente.";
    } else {
        echo "Error al borrar equipo.";
    }
    $stmt->close();
}

$verificar->close();
$conexion->close();
?>
