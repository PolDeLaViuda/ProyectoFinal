<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    header("Location: index.php"); exit;
}
include 'php/conexion.php';

$nombre = $_SESSION['usuario_nombre'] ?? 'Admin';
$iniciales = strtoupper(substr($nombre, 0, 1));
$partes = explode(' ', trim($nombre));
if (count($partes) >= 2) {
    $iniciales = strtoupper(substr($partes[0],0,1) . substr($partes[1],0,1));
}

$res_users      = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM usuarios");
$total_usuarios = mysqli_fetch_assoc($res_users)['total'] ?? 0;

$total_mensajes = 0;
if (mysqli_query($conexion, "CREATE TABLE IF NOT EXISTS contacto_mensajes (id INT AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, mensaje TEXT NOT NULL, fecha DATETIME DEFAULT CURRENT_TIMESTAMP)")) {
    $res_msg = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM contacto_mensajes");
    $total_mensajes = mysqli_fetch_assoc($res_msg)['total'] ?? 0;
}

// --- Cargar backups completos ---
$dir_backup = 'C:\\Users\\Pol de la Viuda\\Desktop\\copia web final\\';
$backups = [];
if (is_dir($dir_backup)) {
    $files = glob($dir_backup . 'backup_*.zip');
    if ($files) {
        rsort($files);
        foreach ($files as $f) {
            $backups[] = ['nombre' => basename($f), 'tamano' => filesize($f), 'fecha' => filemtime($f)];
        }
    }
}
$ultimo_backup = count($backups) > 0 ? date('d/m/Y H:i', $backups[0]['fecha']) : 'Ninguno';

$ok    = $_SESSION['admin_ok']    ?? '';
$error = $_SESSION['admin_error'] ?? '';
unset($_SESSION['admin_ok'], $_SESSION['admin_error']);

function format_bytes(int $bytes): string {
    if ($bytes < 1024)    return $bytes . ' B';
    if ($bytes < 1048576) return round($bytes / 1024, 1) . ' KB';
    return round($bytes / 1048576, 2) . ' MB';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Panel Admin - StatsZone</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<header class="cabecera">
    <a href="home.php" class="logo">&#128202; StatsZone</a>
    <div class="usuario-info">
        <span class="admin-badge-header">&#128737; Admin</span>
        &#128100; <a href="perfil.php" class="usuario-nombre-link"><?= htmlspecialchars($nombre) ?></a>
        <a href="php/cerrar_sesion.php" class="boton-salir">Cerrar sesion</a>
    </div>
</header>

<main class="pagina-admin">

    <div class="admin-hero">
        <div class="admin-hero-content">
            <div class="admin-avatar"><?= $iniciales ?></div>
            <div>
                <h1 class="admin-titulo">Panel de Administracion</h1>
                <p class="admin-sub">Gestiona los backups y los usuarios de StatsZone</p>
            </div>
        </div>
    </div>

    <div class="admin-wrap">

        <?php if ($ok): ?>
            <div class="alerta alerta--exito admin-alerta">&#10003; <?= $ok ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alerta alerta--error admin-alerta">&#9888; <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <!-- ESTADISTICAS -->
        <div class="admin-stats admin-stats--3">
            <div class="stat-card">
                <div class="stat-icono">&#128100;</div>
                <div class="stat-val"><?= $total_usuarios ?></div>
                <div class="stat-label">Usuarios registrados</div>
            </div>
            <div class="stat-card">
                <div class="stat-icono">&#128230;</div>
                <div class="stat-val"><?= count($backups) ?></div>
                <div class="stat-label">Copias de seguridad</div>
            </div>
            <div class="stat-card">
                <div class="stat-icono">&#128336;</div>
                <div class="stat-val stat-val--sm"><?= $ultimo_backup ?></div>
                <div class="stat-label">Ultimo backup</div>
            </div>
        </div>

        <!-- COPIAS DE SEGURIDAD -->
        <div class="admin-seccion">
            <div class="admin-seccion-header">
                <div>
                    <h2 class="admin-seccion-titulo">&#128230; Copias de seguridad &nbsp;<span class="ruta-badge">Escritorio\copia web final\</span></h2>
                    <p class="admin-seccion-sub">Cada backup incluye todos los archivos web y la base de datos</p>
                </div>
                <form action="php/hacer_backup.php" method="POST">
                    <button type="submit" class="boton-backup">&#43; Crear backup</button>
                </form>
            </div>

            <?php if (empty($backups)): ?>
                <div class="sin-datos">
                    <p>&#128230; No hay copias de seguridad todavia</p>
                    <p class="sin-datos-sub">Se guardaran en el Escritorio, en la carpeta "copia web final"</p>
                </div>
            <?php else: ?>
                <div class="tabla-backups-wrap">
                    <table class="tabla-backups">
                        <thead>
                            <tr>
                                <th class="th-izq">Archivo</th>
                                <th>Fecha y hora</th>
                                <th>Tamano</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($backups as $i => $b): ?>
                            <tr <?= $i === 0 ? 'class="fila-ultimo-backup"' : '' ?>>
                                <td class="backup-nombre">
                                    <?php if ($i === 0): ?><span class="badge-ultimo">Ultimo</span><?php endif; ?>
                                    &#128230; <?= htmlspecialchars($b['nombre']) ?>
                                </td>
                                <td><?= date('d/m/Y H:i:s', $b['fecha']) ?></td>
                                <td><?= format_bytes($b['tamano']) ?></td>
                                <td class="backup-acciones">
                                    <form action="php/restaurar_backup.php" method="POST" class="form-inline"
                                          onsubmit="return confirm('Restaurar web y BD desde este backup? Se sobreescribira todo.');">
                                        <input type="hidden" name="archivo" value="<?= htmlspecialchars($b['nombre']) ?>">
                                        <button type="submit" class="btn-accion btn-restaurar">&#8635; Restaurar</button>
                                    </form>
                                    <form action="php/eliminar_backup.php" method="POST" class="form-inline"
                                          onsubmit="return confirm('Eliminar esta copia de seguridad?');">
                                        <input type="hidden" name="tipo" value="backup">
                                        <input type="hidden" name="archivo" value="<?= htmlspecialchars($b['nombre']) ?>">
                                        <button type="submit" class="btn-accion btn-eliminar">&#128465; Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- USUARIOS -->
        <div class="admin-seccion">
            <div class="admin-seccion-header">
                <div>
                    <h2 class="admin-seccion-titulo">&#128100; Usuarios registrados</h2>
                    <p class="admin-seccion-sub">Listado de todas las cuentas en el sistema</p>
                </div>
                <button type="button" class="boton-backup boton-backup--azul"
                        onclick="document.getElementById('form-nuevo-usuario').classList.toggle('oculto')">
                    &#43; Nuevo usuario
                </button>
            </div>

            <!-- FORMULARIO NUEVO USUARIO -->
            <div id="form-nuevo-usuario" class="oculto nuevo-usuario-form">
                <h3>&#128100; Crear nuevo usuario</h3>
                <form action="php/admin_añadir_usuario.php" method="POST">
                    <div class="nuevo-usuario-grid">
                        <div class="campo">
                            <label>Nombre</label>
                            <input type="text" name="nombre" required placeholder="Nombre completo">
                        </div>
                        <div class="campo">
                            <label>Email</label>
                            <input type="email" name="email" required placeholder="correo@ejemplo.com">
                        </div>
                        <div class="campo">
                            <label>Contrasena</label>
                            <input type="password" name="password" required placeholder="Min. 6 caracteres">
                        </div>
                        <div class="campo">
                            <label>Rol</label>
                            <select name="rol" class="campo-select-admin">
                                <option value="usuario">Usuario</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="nuevo-usuario-acciones">
                        <button type="submit" class="boton-backup boton-backup--azul">Crear usuario</button>
                        <button type="button" class="btn-accion btn-eliminar"
                                onclick="document.getElementById('form-nuevo-usuario').classList.add('oculto')">Cancelar</button>
                    </div>
                </form>
            </div>

            <?php
            $res      = mysqli_query($conexion, "SELECT id, nombre, email, rol, created_at FROM usuarios ORDER BY id ASC");
            $usuarios = [];
            while ($u = mysqli_fetch_assoc($res)) $usuarios[] = $u;
            ?>
            <div class="tabla-backups-wrap">
                <table class="tabla-backups">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="th-izq">Nombre</th>
                            <th class="th-izq">Email</th>
                            <th>Rol</th>
                            <th>Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td class="td-id">#<?= $u['id'] ?></td>
                            <td class="td-nombre"><?= htmlspecialchars($u['nombre']) ?></td>
                            <td class="td-email"><?= htmlspecialchars($u['email']) ?></td>
                            <td>
                                <?php if (($u['rol'] ?? '') === 'admin'): ?>
                                    <span class="rol-badge rol-admin">Admin</span>
                                <?php else: ?>
                                    <span class="rol-badge rol-user">Usuario</span>
                                <?php endif; ?>
                            </td>
                            <td class="td-fecha">
                                <?= !empty($u['created_at']) ? date('d/m/Y', strtotime($u['created_at'])) : '-' ?>
                            </td>
                            <td class="backup-acciones">
                                <?php if ((int)$u['id'] !== (int)$_SESSION['usuario_id']): ?>
                                    <form action="php/admin_eliminar_usuario.php" method="POST"
                                          onsubmit="return confirm('Eliminar al usuario <?= htmlspecialchars(addslashes($u['nombre'])) ?>?');">
                                        <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
                                        <button type="submit" class="btn-accion btn-eliminar">&#128465; Eliminar</button>
                                    </form>
                                <?php else: ?>
                                    <span class="td-tu-cuenta">Tu cuenta</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MENSAJES DE CONTACTO -->
        <div class="admin-seccion">
            <div class="admin-seccion-header">
                <div>
                    <h2 class="admin-seccion-titulo">&#9993; Mensajes de contacto</h2>
                    <p class="admin-seccion-sub">Mensajes enviados desde el formulario de NBA y La Liga</p>
                </div>
            </div>
            <?php
            $mensajes = [];
            $res_m = mysqli_query($conexion, "SELECT * FROM contacto_mensajes ORDER BY fecha DESC");
            if ($res_m) while ($m = mysqli_fetch_assoc($res_m)) $mensajes[] = $m;
            ?>
            <?php if (empty($mensajes)): ?>
                <div class="sin-datos">
                    <p>&#9993; No hay mensajes todavia</p>
                    <p class="sin-datos-sub">Aqui apareceran los mensajes del formulario de contacto</p>
                </div>
            <?php else: ?>
                <div class="tabla-backups-wrap">
                    <table class="tabla-backups">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="th-izq">Nombre</th>
                                <th class="th-izq">Email</th>
                                <th class="th-izq">Mensaje</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($mensajes as $m): ?>
                            <tr>
                                <td class="td-id">#<?= $m['id'] ?></td>
                                <td class="td-nombre"><?= htmlspecialchars($m['nombre']) ?></td>
                                <td class="td-email"><?= htmlspecialchars($m['email']) ?></td>
                                <td class="td-mensaje">
                                    <span title="<?= htmlspecialchars($m['mensaje']) ?>">
                                        <?= htmlspecialchars(mb_strimwidth($m['mensaje'], 0, 80, '...')) ?>
                                    </span>
                                </td>
                                <td class="td-fecha"><?= date('d/m/Y H:i', strtotime($m['fecha'])) ?></td>
                                <td class="backup-acciones">
                                    <form action="php/eliminar_mensaje.php" method="POST" class="form-inline"
                                          onsubmit="return confirm('Eliminar este mensaje?');">
                                        <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">
                                        <button type="submit" class="btn-accion btn-eliminar">&#128465; Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <div class="admin-volver">
            <a href="home.php" class="boton-perfil-sec">&#8592; Volver al inicio</a>
        </div>

    </div>
</main>

<?php include 'php/tab_sesion.php'; ?>
</body>
</html>
