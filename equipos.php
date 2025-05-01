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
          <button class="btn-accion ver" id=btnListar>Listar Equipos</button>
          <button class="btn-accion actualizar" id="btnActualizar">Actualizar Equipo</button>
          <button class="btn-accion borrar" id = "btnBorrar">Borrar Equipo</button>
        </div>
      </div>

      <form id="form-agregar-equipo">
        <label for="lbl_equipo">Ingresar código de inventario del equipo </label>
        <input type="text" name="codigo_inventario" placeholder="Código Inventario" required />
        <label for="lbl_equipo">Ingresar nombre del equipo </label>
        <input type="text" name="nombre_equipo" placeholder="Nombre del Equipo" required />
        <label for="lbl_equipo">Ingresar ubicación del equipo </label>
        <input type="text" name="ubicacion" placeholder="Ubicación" required />
        <label for="lbl_equipo">Fecha de adquisición</label>
        <input type="date" name="fecha_adquisicion" required />
        <label for="lbl_equipo">Estado del Equipo</label>
        <select name="estado" required>
          <option value="operativo">Operativo o en uso </option>
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
      let equipoSeleccionado = null;  // Para almacenar el equipo seleccionado para borrar

      formAgregar.addEventListener('submit', function(e) {
        e.preventDefault();

        const datos = new FormData(formAgregar);
        fetch ('guardar_equipo.php', {
          method: 'POST',
          body: datos
        })
        .then(res => res.text())
        .then(respuesta => {
          console.log(respuesta); // Opcional: para ver mensaje en consola
          const nuevoEquipo = {
            codigo: datos.get('codigo_inventario'),
            nombre: datos.get('nombre_equipo'),
            ubicacion: datos.get('ubicacion'),
            fecha: datos.get('fecha_adquisicion'),
            estado: datos.get('estado')
          };
          agregarFilaEquipo(nuevoEquipo);
          formAgregar.reset();
        })
        .catch(error => {
          console.error('Error al registrar:', error);
        });
        
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
  <script>
    document.getElementById('btnListar').addEventListener('click', function () {
      fetch('listar_equipos.php')
        .then(res => res.json())
        .then(data => {
          const cuerpoTabla = document.getElementById('tabla-equipos');
          cuerpoTabla.innerHTML = ''; //Limpiar la tabla antes de llenarla


          let contenido = '';
          data.forEach(equipo => {
            contenido += `
              <tr>
                <td>${equipo.codigo_inventario}</td>
                <td>${equipo.nombre_equipo}</td>
                <td>${equipo.ubicacion}</td>
                <td>${equipo.fecha_adquisicion}</td>
                <td>${equipo.estado}</td>
              </tr>
            `;
          });
          cuerpoTabla.innerHTML = contenido;
        })
        .catch(error => {
          console.error('Error al listar equipos:', error);
        });
    });

  </script>
  <script>
  document.getElementById('btnActualizar').addEventListener('click', () => {
    const filas = document.querySelectorAll('#tabla-equipos tr');
    filas.forEach(fila => {
      fila.addEventListener('click', () => {
        const celdas = fila.querySelectorAll('td');
        if (celdas.length > 0) {
          document.querySelector('[name="codigo_inventario"]').value = celdas[0].innerText;
          document.querySelector('[name="nombre_equipo"]').value = celdas[1].innerText;
          document.querySelector('[name="ubicacion"]').value = celdas[2].innerText;
          document.querySelector('[name="fecha_adquisicion"]').value = celdas[3].innerText;
          document.querySelector('[name="estado"]').value = celdas[4].innerText;

          document.getElementById('form-agregar-equipo').dataset.modo = 'actualizar';
        }
      });
    });
  });

  document.getElementById('form-agregar-equipo').addEventListener('submit', function(e) {
    if (this.dataset.modo === 'actualizar') {
      e.preventDefault();
      const datos = new FormData(this);
      fetch('actualizar_equipo.php', {
        method: 'POST',
        body: datos
      })
      .then(res => res.text())
      .then(msg => {
        alert('Equipo actualizado');
        this.reset();
        delete this.dataset.modo;
        document.getElementById('btnListar').click(); // refresca tabla
      })
      .catch(err => {
        console.error('Error al actualizar:', err);
      });
    }
  });
</script>

<script>
  document.getElementById('btnBorrar').addEventListener('click', () => {
    const codigo = document.querySelector('[name="codigo_inventario"]').value;

    if (!codigo) {
      alert('Ingrese el código del equipo a borrar');
      return;
    }

    const datos = new FormData();
    datos.append('codigo', codigo);

    fetch('borrar_equipo.php', {
      method: 'POST',
      body: datos
    })
    .then(res => res.text())
    .then(msg => {
      alert(msg);
      document.getElementById('btnListar').click(); // Refrescar tabla
      document.getElementById('form-agregar-equipo').reset();
    })
    .catch(err => {
      console.error('Error al borrar:', err);
    });
  });
</script>




</body>
</html>
