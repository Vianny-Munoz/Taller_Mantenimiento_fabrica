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

<main>
    <section class="reg-incidencias"> 
        <h2>Incidencias de Mantenimiento</h2>
        <!-- <form id="form-agregar-incidencias"> -->
        <form action="agregar_incidencia.php" method="POST">
            <input type="text" name="codigo_inventario" placeholder="Código Inventario de la Maquina" required>
            <input type="text" name="cedula_tecnico" placeholder="Cedula Tecnico que hará mantenimiento" required>
            <!-- <input type="text" name="ubicacion" placeholder="Ubicación o area de la empresa" required> -->
            <label for="fecha_incidencia_lbl">Fecha de incidencia o ingreso del equipo:</label>
            <input type="date" name="fecha_incidencia" required>   
            <select name="tipo_mantenimiento" required>
                <option value="preventivo">Preventivo</option>
                <option value="correctivo">Correctivo</option>
                <option value="predictivo">Predictivo</option>
            </select>
            <label for="fecha_reparacion_lbl">Fecha de entrega del equipo post mantenimiento:</label>
            <input type="date" name="fecha_reparacion" required>
            <button type="submit" class="login-btn">Agregar Incidencia</button>
        </form>
    </section>

    <section class="lista-incidencias">
        <h2>Lista de Incidencias</h2>
        <table>
            <thead>
                <tr>
                    <th>Código del Equipo</th>
                    <th>Cédula Tecnico</th>
                    <!-- <th>Ubicación o area de la empresa</th> -->
                    <th>Fecha de ingreso</th>
                    <th>Tipo de Mantenimiento</th>
                    <th>Fecha de entrega del equipo</th>
                </tr>
            </thead>
            <tbody id="tabla-incidencias">
                <!-- Aquí se cargan incidencias -->
            </tbody>
        </table>


    </section>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const form = document.getElementById('form-agregar-incidencias');
      const tabla = document.getElementById('tabla-incidencias');

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        const data = new FormData(form);
        const nuevaIncidencia = {
          codigo: data.get('codigo_inventario'),
          cedula: data.get('Cedula_tecnico'),
          ubicacion: data.get('ubicacion'),
          fechaIngreso: data.get('fecha_incidencia'),
          tipo: data.get('tipo_mantenimiento'),
          fechaEntrega: data.get('fecha_reparacion')
        };
        agregarFila(nuevaIncidencia);
        form.reset();
      });

      function agregarFila(i) {
        const fila = `
          <tr>
            <td>${i.codigo}</td>
            <td>${i.cedula}</td>
            <td>${i.ubicacion}</td>
            <td>${i.fechaIngreso}</td>
            <td>${i.tipo}</td>
            <td>${i.fechaEntrega}</td>
          </tr>
        `;
        tabla.innerHTML += fila;
      }
    });
  </script>

</body>
</html>
