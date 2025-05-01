 <?php
include("ConexionDB/conexion.php");

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$celular = $_POST['celular'];
$especialidad = $_POST['especialidad'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Verificar si ya existe una cédula o usuario igual
$verificar = "SELECT * FROM tecnicos WHERE cedula = '$cedula' OR usuario = '$usuario'";
$resultado = mysqli_query($conexion, $verificar);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Ya existe: redirigir con error
    header("Location: index.php?error=cedula_o_usuario_existente");
    exit;
}

// Insertar nuevo técnico
$query = "INSERT INTO tecnicos (cedula, nombre, apellido, celular, especialidad, email, usuario, contrasena)
          VALUES ('$cedula', '$nombre', '$apellido', '$celular', '$especialidad', '$email', '$usuario', '$contrasena')";

if (mysqli_query($conexion, $query)) {
    // Éxito
    header("Location: index.php?mensaje=registro_exitoso");
    exit;
} else {
    // Fallo en la inserción
    header("Location: index.php?error=error_al_guardar");
    exit;
}
?>
