<?php
include 'ConexionDB/conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verificamos si es una solicitud POST
    // Recibir los datos del formulario
    $codigo_inventario = $_POST['codigo_inventario'];
    $nombre_equipo = $_POST['nombre_equipo'];
    $ubicacion = $_POST['ubicacion'];
    $fecha_adquisicion = $_POST['fecha_adquisicion'];
    $estado = $_POST['estado'];

    // Consulta SQL para insertar el nuevo equipo
    $sql = "INSERT INTO equipos (codigo_inventario, nombre_equipo, ubicacion, fecha_adquisicion, estado)
            VALUES ('$codigo_inventario', '$nombre_equipo', '$ubicacion', '$fecha_adquisicion', '$estado')";

    if (mysqli_query($conexion, $sql)) {
        echo "Equipo registrado correctamente."; // Mensaje de éxito
    } else {
        echo "Error al registrar el equipo: " . mysqli_error($conexion); // Mensaje de error
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>
