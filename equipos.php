<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gestión de Equipos - Mantenimiento de Fábrica</title>
  <link rel="stylesheet" href="estilos.css" />
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
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
    <h1>Gestión de Equipos</h1>
  </header>

  <main>
    <section class="add-equipo">
      <div class="acciones-superiores">
        <h2>Agregar Nuevo Equipo</h2>
        <div class="botones-acciones">
          <button class="btn-accion ver">Ver Equipos</button>
          <button class="btn-accion actualizar">Actualizar Equipo</button>
          <button class="btn-accion borrar">Borrar Equipo</button>
        </div>
      </div>

      <form id="form-agregar-equipo">
        <input type="text" name="codigo_inventario" placeholder="Código Inventario" required />
        <input type="text" name="nombre_equipo" placeholder="Nombre del Equipo" required />
        <input type="text" name="ubicacion" placeholder="Ubicación" required />
        <input type="date" name="fecha_adquisicion" required />
        <select name="estado" required>
          <option value="operativo">Operativo</option>
          <option value="mantenimiento">Mantenimiento</option>
          <option value="fuera de servicio">Fuera de Servicio</option>
        </select>
        <button type="submit" class="btn-principal">Registrar Equipo</button>
      </form>
    </section>

    <section class="lista-equipos">
      <h2>Equipos Registrados</h2>
      <table>
        <thead>
          <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Ubicación</th>
            <th>Fecha Adquisición</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody id="tabla-equipos">
          <!-- Equipos aparecerán aquí -->
        </tbody>
      </table>
    </section>
  </main>

  <!-- Script -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const formAgregar = document.getElementById('form-agregar-equipo');
      const tablaEquipos = document.getElementById('tabla-equipos');

      formAgregar.addEventListener('submit', function(e) {
        e.preventDefault();

        const datos = new FormData(formAgregar);
        const nuevoEquipo = {
          codigo: datos.get('codigo_inventario'),
          nombre: datos.get('nombre_equipo'),
          ubicacion: datos.get('ubicacion'),
          fecha: datos.get('fecha_adquisicion'),
          estado: datos.get('estado')
        };

        agregarFilaEquipo(nuevoEquipo);
        formAgregar.reset();
      });

      function agregarFilaEquipo(equipo) {
        const fila = `
          <tr>
              <td>${equipo.codigo}</td>
              <td>${equipo.nombre}</td>
              <td>${equipo.ubicacion}</td>
              <td>${equipo.fecha}</td>
              <td>${equipo.estado}</td>
          </tr>
        `;
        tablaEquipos.innerHTML += fila;
      }
    });
  </script>
</body>
</html>
