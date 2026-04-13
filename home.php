<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("location: index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido - Panel de Control</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
    <style>
        body { background: #4e54c8; font-family: sans-serif; color: white; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .perfil { position: absolute; top: 20px; right: 20px; background: white; color: #333; padding: 10px 20px; border-radius: 50px; font-weight: bold; }
        .menu { background: rgba(255,255,255,0.1); padding: 40px; border-radius: 20px; backdrop-filter: blur(10px); }
        .btn { display: block; width: 250px; padding: 15px; margin: 15px auto; border: none; border-radius: 10px; color: white; font-size: 18px; cursor: pointer; text-decoration: none; font-weight: bold; }
        .nba { background: #1d428a; }
        .laliga { background: #ee1c25; }
    </style>
</head>
<body>

    <div class="perfil">
        👤 <?php echo $_SESSION['usuario']; ?> 
        <a href="php/cerrar_sesion.php" style="color:red; margin-left:10px; text-decoration:none; font-size:12px;">Salir</a>
    </div>

    <div class="menu">
        <h1>¿Qué quieres ver hoy?</h1>
        <a href="calendario_nba.php" class="btn nba">CALENDARIO NBA</a>
        <a href="calendario_laliga.php" class="btn laliga">CALENDARIO LA LIGA</a>
        <br>
        <a href="editar_perfil.php" style="color:white; font-size:14px;">Configuración de cuenta</a>
    </div>

</body>
</html>