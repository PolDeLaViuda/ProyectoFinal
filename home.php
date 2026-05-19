<?php
session_start();
if (!isset($_SESSION['usuario_nombre'])) { header("Location: index.php"); exit; }
$nombre = htmlspecialchars($_SESSION['usuario_nombre']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Inicio - StatsZone</title>
<link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
<header class="cabecera">
    <a href="home.php" class="logo">&#128202; StatsZone</a>
    <div class="usuario-info">
        &#128100; <a href="perfil.php" class="usuario-nombre-link"><?= $nombre ?></a>
        <a href="php/cerrar_sesion.php" class="boton-salir">Cerrar sesion</a>
    </div>
</header>
<main class="pagina-home">
    <h1>Que quieres ver hoy?</h1>
    <p>Elige una liga para ver sus estadisticas</p>
    <div class="opciones">
        <a href="nba.php" class="tarjeta-liga tarjeta-liga--nba">
            <span class="liga-icono">&#127936;</span>
            <span class="liga-nombre">NBA</span>
            <span class="liga-desc">Liga de baloncesto americana</span>
        </a>
        <a href="laliga.php" class="tarjeta-liga tarjeta-liga--laliga">
            <span class="liga-icono">&#9917;</span>
            <span class="liga-nombre">La Liga</span>
            <span class="liga-desc">Liga de futbol espanola</span>
        </a>
    </div>
</main>
<?php include 'php/tab_sesion.php'; ?>
</body>
</html>
