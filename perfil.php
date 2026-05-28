<?php
session_start();
if (!isset($_SESSION['usuario_nombre'])) { header("Location: index.php"); exit; }
include 'php/conexion.php';

$id = (int)$_SESSION['usuario_id'];

// Cargar datos desde BD
$stmt = mysqli_prepare($conexion, "SELECT nombre, email FROM usuarios WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res  = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($res) ?: [];
mysqli_stmt_close($stmt);

$nombre = $user['nombre'] ?? $_SESSION['usuario_nombre'];
$email  = $user['email']  ?? $_SESSION['usuario_email'] ?? '';

$error = $_SESSION['perfil_error'] ?? '';
$ok    = $_SESSION['perfil_ok']    ?? '';
unset($_SESSION['perfil_error'], $_SESSION['perfil_ok']);

// Iniciales para el avatar
$iniciales = strtoupper(substr($nombre, 0, 1));
$partes = explode(' ', trim($nombre));
if (count($partes) >= 2) {
    $iniciales = strtoupper(substr($partes[0],0,1) . substr($partes[1],0,1));
}
$nombre_s = htmlspecialchars($nombre);
$email_s  = htmlspecialchars($email);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Mi Perfil - StatsZone</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/perfil.css">
</head>
<body>

<header class="cabecera">
    <a href="home.php" class="logo">&#128202; StatsZone</a>
    <div class="usuario-info">
        &#128100; <a href="perfil.php" class="usuario-nombre-link"><?= $nombre_s ?></a>
        <a href="php/cerrar_sesion.php" class="boton-salir">Cerrar sesion</a>
    </div>
</header>

<main class="pagina-perfil">
<div class="perfil-wrap">

    <!-- PANEL IZQUIERDO -->
    <aside class="perfil-panel">
        <div class="perfil-avatar"><?= $iniciales ?></div>
        <h2 class="perfil-nombre"><?= $nombre_s ?></h2>
        <p class="perfil-email">&#9993; <?= $email_s ?></p>

        <div class="perfil-ligas">
            <span class="perfil-liga perfil-liga--nba">&#127936; NBA</span>
            <span class="perfil-liga perfil-liga--laliga">&#9917; La Liga</span>
        </div>

        <div class="perfil-info-list">
            <div class="perfil-info-item">
                <span class="perfil-info-label">ID de usuario</span>
                <span class="perfil-info-val">#<?= $id ?></span>
            </div>
            <div class="perfil-info-item">
                <span class="perfil-info-label">Estado</span>
                <span class="perfil-info-val estado-activo">&#9679; Activo</span>
            </div>
            <div class="perfil-info-item">
                <span class="perfil-info-label">Acceso</span>
                <span class="perfil-info-val">NBA + La Liga</span>
            </div>
        </div>

        <a href="home.php" class="boton-perfil-sec">&#8592; Volver al inicio</a>
        <?php if (($_SESSION['usuario_rol'] ?? '') === 'admin'): ?>
        <a href="admin.php" class="boton-perfil-admin">&#128737; Panel de Admin</a>
        <?php endif; ?>
        <a href="php/cerrar_sesion.php" class="boton-perfil-danger">&#128682; Cerrar sesion</a>
    </aside>

    <!-- PANEL DERECHO: formulario -->
    <section class="perfil-form-wrap">
        <h1 class="perfil-form-titulo">Mi perfil</h1>
        <p class="perfil-form-sub">Actualiza tu informacion personal cuando quieras</p>

        <?php if ($error): ?>
            <div class="alerta alerta--error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($ok): ?>
            <div class="alerta alerta--exito"><?= htmlspecialchars($ok) ?></div>
        <?php endif; ?>

        <form action="php/actualizar_perfil.php" method="POST">

            <div class="perfil-seccion">
                <h3 class="perfil-seccion-titulo">Datos personales</h3>
                <div class="campo">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre"
                           value="<?= $nombre_s ?>" required>
                </div>
                <div class="campo">
                    <label for="email">Correo electronico</label>
                    <input type="email" id="email" name="email"
                           value="<?= $email_s ?>" required>
                </div>
            </div>

            <div class="perfil-seccion">
                <h3 class="perfil-seccion-titulo">Cambiar contrasena</h3>
                <p class="perfil-seccion-sub">Deja estos campos vacios si no quieres cambiarla</p>
                <div class="campo">
                    <label for="nueva_password">Nueva contrasena</label>
                    <input type="password" id="nueva_password" name="nueva_password"
                           placeholder="Minimo 6 caracteres" autocomplete="new-password">
                </div>
                <div class="campo">
                    <label for="confirmar_password">Confirmar nueva contrasena</label>
                    <input type="password" id="confirmar_password" name="confirmar_password"
                           placeholder="Repite la contrasena" autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="boton boton--primario">&#10003; Guardar cambios</button>
        </form>
    </section>

</div>
</main>

<?php include 'php/tab_sesion.php'; ?>
</body>
</html>
