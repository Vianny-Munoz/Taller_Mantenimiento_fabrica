<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidencias - Mantenimiento de Fábrica</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <h1>Incidencias</h1>
    <nav>
        <a href="index.html">Cerrar Sesión</a>
    </nav>
</header>

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

<script src="equipos.js"></script>

</body>
</html>
