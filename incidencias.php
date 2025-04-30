<?php
include 'conexion.php';

// Obtener técnicos registrados
$query = "SELECT cedula, nombre FROM usuarios WHERE rol = 'tecnico' OR rol = 'admin'";
$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Incidencias - Mantenimiento de Fábrica</title>
  <link rel="stylesheet" href="estilos.css" />
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
      margin-left: 200px;
    }
    section h2 {
      color: #003d80;
    }
  </style>
</head>
<body>

<!-- Menú lateral -->
<div class="sidebar">
  <a href="equipos.php">Equipos</a>
  <a href="incidencias.php">Incidencias</a>
  <a href="index.php">Cerrar Sesión</a>
</div>

<header>
  <h1>Gestión de Incidencias</h1>
</header>

<main>
  <section class="reg-incidencias">
    <div class="acciones-superiores">
      <h2>Agregar Nueva Incidencia</h2>
      <div class="botones-acciones">
        <button class="btn-accion ver">Ver Incidencia</button>
        <button class="btn-accion actualizar">Actualizar Incidencia</button>
        <button class="btn-accion borrar">Borrar Incidencia</button>
      </div>
    </div>

    <form id="form-agregar-incidencias" method="POST" action="guardar_incidencia.php">
      <input type="text" name="codigo_inventario" placeholder="Código Inventario de la Máquina" required />

      <!-- Lista desplegable técnicos -->
      <label for="cedula_tecnico">Seleccionar Técnico:</label>
      <select name="cedula_tecnico" required>
        <option value="">Seleccione un técnico</option>
        <?php while($row = mysqli_fetch_assoc($resultado)): ?>
          <option value="<?= $row['cedula'] ?>"><?= $row['cedula'] ?> - <?= $row['nombre'] ?></option>
        <?php endwhile; ?>
      </select>

      <input type="text" name="ubicacion" placeholder="Ubicación o área de la empresa" required />

      <label for="fecha_incidencia">Fecha de ingreso del equipo:</label>
      <input type="date" name="fecha_incidencia" required />

      <label for="tipo_mantenimiento">Tipo de Mantenimiento:</label>
      <select name="tipo_mantenimiento" required>
        <option value="preventivo">Preventivo</option>
        <option value="correctivo">Correctivo</option>
        <option value="predictivo">Predictivo</option>
      </select>

      <label for="fecha_reparacion">Fecha de entrega del equipo post mantenimiento:</label>
      <input type="date" name="fecha_reparacion" required />

      <button type="submit" class="btn-principal">Agregar Incidencia</button>
    </form>
  </section>

  <section class="lista-incidencias">
    <h2>Lista de Incidencias</h2>
    <table>
      <thead>
        <tr>
          <th>Código del Equipo</th>
          <th>Cédula Técnico</th>
          <th>Ubicación</th>
          <th>Fecha Ingreso</th>
          <th>Tipo Mantenimiento</th>
          <th>Fecha Entrega</th>
        </tr>
      </thead>
      <tbody id="tabla-incidencias">
        <!-- Aquí incidencias -->
      </tbody>
    </table>
  </section>
</main>

<!--  -->

</body>
</html>
