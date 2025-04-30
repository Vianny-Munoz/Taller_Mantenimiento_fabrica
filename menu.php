<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Menú Principal - Mantenimiento</title>
  <link rel="stylesheet" href="estilos.css">
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Orbitron', 'Segoe UI', sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    h1 {
      color: #00aaff;
      margin-bottom: 40px;
    }

    .menu-opciones {
      display: flex;
      gap: 30px;
    }

    .menu-card {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      text-align: center;
      width: 220px;
    }

    .menu-card h2 {
      color: #003d80;
      margin-bottom: 20px;
    }

    .menu-card a {
      text-decoration: none;
      color: white;
      background-color: #00aaff;
      padding: 12px 20px;
      border-radius: 8px;
      display: inline-block;
      transition: background 0.3s;
    }

    .menu-card a:hover {
      background-color: #008ecc;
    }
  </style>
</head>
<body>

  <h1>Menú Principal</h1>

  <div class="menu-opciones">
    <div class="menu-card">
      <h2>Gestión de Equipos</h2>
      <a href="equipos.php">Ir a Equipos</a>
    </div>
    <div class="menu-card">
      <h2>Gestión de Incidencias</h2>
      <a href="incidencias.php">Ir a Incidencias</a>
    </div>
  </div>

</body>
</html>
