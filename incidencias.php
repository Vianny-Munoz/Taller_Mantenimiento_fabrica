<?php
// Incluir el archivo de conexión
include 'ConexionDB/conexion.php';

// Realizar la consulta para obtener las incidencias
$query = "SELECT * FROM incidencias";
$result = mysqli_query($conexion, $query);
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
    .mensaje {
      color: green;
      font-weight: bold;
    }
    .error {
      color: red;
      font-weight: bold;
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
        <?php
            include 'ConexionDB/conexion.php';
            $query = "SELECT cedula FROM tecnicos";
            $resultado = mysqli_query($conexion, $query);
        ?>
        <!-- <form id="form-agregar-incidencias"> -->
        <form action="agregar_incidencia.php" method="POST">
            <label for="codigo_inventario_lbl">Elija el equipo que va a registrar en la incidencia:</label>
            <input type="text" name="codigo_inventario" placeholder="Código Inventario de la Maquina" required>
            <label for="cedula_tecnico">Cédula del Técnico:</label>
            <select name="cedula_tecnico" required>
                <option value="">Seleccione una cédula</option>
                <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                    <option value="<?php echo $row['cedula']; ?>">
                        <?php echo $row['cedula']; ?>
                    </option>
                <?php } ?>
            </select>
            <label for="fecha_incidencia_lbl">Fecha de incidencia o ingreso del equipo:</label>
            <input type="date" name="fecha_incidencia" id="fecha_incidencia" required max = "<?php echo date('Y-m-d');?>">
            <!-- Lista desplegable tipo_mantenimiento -->
            <label for="tipo_mantenimiento_lbl">Elija el tipo de mantenimiento a realizar:</label>
            <select name="tipo_mantenimiento" required>
                <option value="preventivo">Preventivo</option>
                <option value="correctivo">Correctivo</option>
                <option value="predictivo">Predictivo</option>
            </select>

            <label for="fecha_reparacion_lbl">Fecha de entrega del equipo post mantenimiento:</label>
            <input type="date" name="fecha_reparacion" id="fecha_repaacion" required>

            <button type="submit" class="login-btn">Agregar Incidencia</button>
        </form>
    </section>


    <section class="lista-incidencias">
        <h2>Lista de Incidencias</h2>
        <?php
        // Mostrar mensaje de confirmación o error
        if (isset($_GET['mensaje'])) {
            $mensaje = $_GET['mensaje'];
            if (strpos($mensaje, 'exitosamente') !== false) {
                echo "<p class='mensaje'>$mensaje</p>";
            } else {
                echo "<p class='error'>$mensaje</p>";
            }
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Código del Equipo</th>
                    <th>Cédula Tecnico</th>
                    <th>Fecha de ingreso</th>
                    <th>Tipo de Mantenimiento</th>
                    <th>Fecha de entrega del equipo</th>
                </tr>
            </thead>
            <tbody id="tabla-incidencias">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['codigo_inventario']}</td>
                            <td>{$row['cedula_tecnico']}</td>
                            <td>{$row['fecha_incidencia']}</td>
                            <td>{$row['tipo_mantenimiento']}</td>
                            <td>{$row['fecha_reparacion']}</td>
                          </tr>";
                }

                ?>

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
  <script>
    document.getElementById('fecha_incidencia').addEventListener('change', function() {
      var fehaIngreso = this.value;
      var fechaReparacion = document.getElementById('fecha_reparacion');
      fechaReparacion.min = fechaIngreso;
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const fechaIncidenciaInput = document.getElementById('fecha_incidencia');
      const fechaReparacionInput = document.getElementById('fecha_reparacion');
      const form = document.querySelector('form[action=agregar_incidencia.php"]');

      // Al cambiar la fecha de incidencia
      fechaIncidenciaInput.addEventListener('change', function () {
        const fechaIngreso = this.value;
        const hoy = new Date().toISOString().split('T')[0];

        if (fechaIngreso > hoy) {
            alert("La fecha de incidencia no puede ser mayor a hoy.");
            this.value = "";
            fechaReparacionInput.min = "";
            return;
        }

        // Establece el mínimo permitido para reparación
        fechaReparacionInput.min = fechaIngreso;

        // Si ya hay fecha de reparación escrita y es menor, la borra
        if (fechaReparacionInput.value && fechaReparacionInput.value < fechaIngreso) {
          fechaReparacionInput.value = "";
        }
      });

      // Al cambiar la fecha de reparación
      fechaReparacionInput.addEventListener('change', function () {
          const fechaIngreso = fechaIncidenciaInput.value;
          if (fechaIngreso && this.value < fechaIngreso) {
              alert("La fecha de reparación no puede ser anterior a la de incidencia.");
              this.value = "";
              return; 
          }
      });

      // Validación antes de enviar el formulario
      form.addEventListener('submit', function(e) {
          const fechaIngreso = fechaIncidenciaInput.value;
          const fechaReparacion = fechaReparacionInput.value;
          const hoy = new Date().toISOString().split('T')[0];

          if (!fechaIngreso) {
              alert("Por favor ingrese la fecha de incidencia.");
              e.preventDefault();
              return;
          }

          if (fechaIngreso > hoy) {
              alert("La fecha de incidencia no puede ser mayor a hoy.");
              e.preventDefault();
              return;
          }

          if (!fechaReparacion) {
              alert("Por favor ingrese la fecha de reparación.");
              e.preventDefault();
              return;
          }

          if (fechaReparacion < fechaIngreso) {
              alert("La fecha de reparación no puede ser anterior a la de incidencia.");
              e.preventDefault();
              return;
          }
        });

    });
  </script>
</body>
</html>
