<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Equipos - Mantenimiento de Fábrica</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <h1>Gestión de Equipos</h1>
    <nav>
        <a href="index.html">Cerrar Sesión</a>
    </nav>
</header>

<main>
    <section class="add-equipo">
        <h2>Agregar Nuevo Equipo</h2>
        <!-- <form id="form-agregar-equipo">-->
        <form action="guardar_equipo.php" method="POST"> <!-- agregar action y method -->

            <input type="text" name="codigo_inventario" placeholder="Código Inventario" required>
            <input type="text" name="nombre_equipo" placeholder="Nombre del Equipo" required>
            <input type="text" name="ubicacion" placeholder="Ubicación" required>
            <input type="date" name="fecha_adquisicion" required>
            <select name="estado" required>
                <option value="operativo">Operativo</option>
                <option value="mantenimiento">Mantenimiento</option>
                <option value="fuera de servicio">Fuera de Servicio</option>
            </select>
            <button type="submit" class="login-btn">Agregar Equipo</button>
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
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tabla-equipos">
                <!-- Aquí se cargan los equipos dinámicamente -->
            </tbody>
        </table>
    </section>
</main>

<script src="equipos.js"></script>

</body>
</html>
