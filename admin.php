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

// --- Cargar backups BD (diario) ---
$dir_bd   = 'C:\\Backups\\diario\\';
$backups_bd = [];
if (is_dir($dir_bd)) {
    $files = glob($dir_bd . 'bd_*.sql');
    if ($files) {
        rsort($files);
        foreach ($files as $f) {
            $backups_bd[] = ['nombre' => basename($f), 'tamano' => filesize($f), 'fecha' => filemtime($f)];
        }
    }
}

// --- Cargar backups Web (semanal) ---
$dir_web    = 'C:\\Backups\\semanal\\';
$backups_web = [];
if (is_dir($dir_web)) {
    $files = glob($dir_web . 'web_*.zip');
    if ($files) {
        rsort($files);
        foreach ($files as $f) {
            $backups_web[] = ['nombre' => basename($f), 'tamano' => filesize($f), 'fecha' => filemtime($f)];
        }
    }
}

$ultimo_bd  = count($backups_bd)  > 0 ? date('d/m/Y H:i', $backups_bd[0]['fecha'])  : 'Ninguno';
$ultimo_web = count($backups_web) > 0 ? date('d/m/Y H:i', $backups_web[0]['fecha']) : 'Ninguno';

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
    <link rel="stylesheet" href="assets/css/estilo.css">
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
        <div class="admin-stats admin-stats--4" style="grid-template-columns:repeat(5,1fr)">
            <div class="stat-card">
                <div class="stat-icono">&#128100;</div>
                <div class="stat-val"><?= $total_usuarios ?></div>
                <div class="stat-label">Usuarios registrados</div>
            </div>
            <div class="stat-card">
                <div class="stat-icono">&#128190;</div>
                <div class="stat-val"><?= count($backups_bd) ?></div>
                <div class="stat-label">Backups de BD</div>
            </div>
            <div class="stat-card">
                <div class="stat-icono">&#128230;</div>
                <div class="stat-val"><?= count($backups_web) ?></div>
                <div class="stat-label">Backups de web</div>
            </div>
            <div class="stat-card">
                <div class="stat-icono">&#128336;</div>
                <div class="stat-val stat-val--sm"><?= $ultimo_bd ?></div>
                <div class="stat-label">Ultima BD</div>
            </div>
            <div class="stat-card">
                <div class="stat-icono">&#9993;</div>
                <div class="stat-val"><?= $total_mensajes ?></div>
                <div class="stat-label">Mensajes recibidos</div>
            </div>
        </div>

        <!-- BOTON BACKUP COMPLETO -->
        <div class="admin-seccion" style="padding:20px 28px;">
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
                <div>
                    <h2 class="admin-seccion-titulo" style="margin-bottom:2px;">&#9889; Backup completo</h2>
                    <p class="admin-seccion-sub">Crea a la vez la copia de la web y de la base de datos</p>
                </div>
                <form action="php/hacer_backup.php" method="POST">
                    <input type="hidden" name="tipo" value="completo">
                    <button type="submit" class="boton-backup">&#43; Crear backup completo</button>
                </form>
            </div>
        </div>

        <!-- BACKUP BASE DE DATOS (diario) -->
        <div class="admin-seccion">
            <div class="admin-seccion-header">
                <div>
                    <h2 class="admin-seccion-titulo">&#128190; Base de datos &nbsp;<span class="ruta-badge">C:\Backups\diario\</span></h2>
                    <p class="admin-seccion-sub">Ultimo backup: <?= $ultimo_bd ?></p>
                </div>
                <form action="php/hacer_backup.php" method="POST">
                    <input type="hidden" name="tipo" value="bd">
                    <button type="submit" class="boton-backup boton-backup--azul">&#43; Solo BD</button>
                </form>
            </div>

            <?php if (empty($backups_bd)): ?>
                <div class="sin-datos">
                    <p>&#128190; No hay backups de base de datos</p>
                    <p class="sin-datos-sub">Se guardaran en C:\Backups\diario\</p>
                </div>
            <?php else: ?>
                <div class="tabla-backups-wrap">
                    <table class="tabla-backups">
                        <thead>
                            <tr>
                                <th style="text-align:left">Archivo</th>
                                <th>Fecha y hora</th>
                                <th>Tamano</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($backups_bd as $i => $b): ?>
                            <tr <?= $i === 0 ? 'class="fila-ultimo-backup"' : '' ?>>
                                <td class="backup-nombre">
                                    <?php if ($i === 0): ?><span class="badge-ultimo">Ultimo</span><?php endif; ?>
                                    &#128196; <?= htmlspecialchars($b['nombre']) ?>
                                </td>
                                <td><?= date('d/m/Y H:i:s', $b['fecha']) ?></td>
                                <td><?= format_bytes($b['tamano']) ?></td>
                                <td class="backup-acciones">
                                    <a href="php/descargar_backup.php?tipo=bd&archivo=<?= urlencode($b['nombre']) ?>"
                                       class="btn-accion btn-descargar">&#8595; Descargar</a>
                                    <form action="php/eliminar_backup.php" method="POST"
                                          onsubmit="return confirm('Eliminar este backup de BD?');" style="display:inline;">
                                        <input type="hidden" name="tipo" value="bd">
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

        <!-- BACKUP WEB (semanal) -->
        <div class="admin-seccion">
            <div class="admin-seccion-header">
                <div>
                    <h2 class="admin-seccion-titulo">&#128230; Archivos web &nbsp;<span class="ruta-badge">C:\Backups\semanal\</span></h2>
                    <p class="admin-seccion-sub">Ultimo backup: <?= $ultimo_web ?></p>
                </div>
                <form action="php/hacer_backup.php" method="POST">
                    <input type="hidden" name="tipo" value="web">
                    <button type="submit" class="boton-backup boton-backup--morado">&#43; Solo web</button>
                </form>
            </div>

            <?php if (empty($backups_web)): ?>
                <div class="sin-datos">
                    <p>&#128230; No hay backups de archivos web</p>
                    <p class="sin-datos-sub">Se guardaran en C:\Backups\semanal\</p>
                </div>
            <?php else: ?>
                <div class="tabla-backups-wrap">
                    <table class="tabla-backups">
                        <thead>
                            <tr>
                                <th style="text-align:left">Archivo</th>
                                <th>Fecha y hora</th>
                                <th>Tamano</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($backups_web as $i => $b): ?>
                            <tr <?= $i === 0 ? 'class="fila-ultimo-backup"' : '' ?>>
                                <td class="backup-nombre">
                                    <?php if ($i === 0): ?><span class="badge-ultimo">Ultimo</span><?php endif; ?>
                                    &#128230; <?= htmlspecialchars($b['nombre']) ?>
                                </td>
                                <td><?= date('d/m/Y H:i:s', $b['fecha']) ?></td>
                                <td><?= format_bytes($b['tamano']) ?></td>
                                <td class="backup-acciones">
                                    <a href="php/descargar_backup.php?tipo=web&archivo=<?= urlencode($b['nombre']) ?>"
                                       class="btn-accion btn-descargar">&#8595; Descargar</a>
                                    <form action="php/eliminar_backup.php" method="POST"
                                          onsubmit="return confirm('Eliminar este backup de web?');" style="display:inline;">
                                        <input type="hidden" name="tipo" value="web">
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
            <div id="form-nuevo-usuario" class="oculto" style="background:#f7f8fc;border-radius:10px;padding:20px 24px;margin-bottom:20px;border:1px solid #e2e8f0;">
                <h3 style="font-size:15px;color:#2d3748;margin-bottom:16px;">&#128100; Crear nuevo usuario</h3>
                <form action="php/admin_añadir_usuario.php" method="POST">
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr auto;gap:12px;align-items:end;">
                        <div class="campo" style="margin:0">
                            <label>Nombre</label>
                            <input type="text" name="nombre" required placeholder="Nombre completo">
                        </div>
                        <div class="campo" style="margin:0">
                            <label>Email</label>
                            <input type="email" name="email" required placeholder="correo@ejemplo.com">
                        </div>
                        <div class="campo" style="margin:0">
                            <label>Contrasena</label>
                            <input type="password" name="password" required placeholder="Min. 6 caracteres">
                        </div>
                        <div class="campo" style="margin:0">
                            <label>Rol</label>
                            <select name="rol" class="campo-select-admin">
                                <option value="usuario">Usuario</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-top:14px;">
                        <button type="submit" class="boton-backup boton-backup--azul">Crear usuario</button>
                        <button type="button" class="btn-accion btn-eliminar" style="margin-left:8px;"
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
                            <th style="text-align:left">Nombre</th>
                            <th style="text-align:left">Email</th>
                            <th>Rol</th>
                            <th>Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td style="color:#a0aec0;font-size:13px;">#<?= $u['id'] ?></td>
                            <td style="text-align:left;font-weight:600;"><?= htmlspecialchars($u['nombre']) ?></td>
                            <td style="text-align:left;color:#718096;"><?= htmlspecialchars($u['email']) ?></td>
                            <td>
                                <?php if (($u['rol'] ?? '') === 'admin'): ?>
                                    <span class="rol-badge rol-admin">Admin</span>
                                <?php else: ?>
                                    <span class="rol-badge rol-user">Usuario</span>
                                <?php endif; ?>
                            </td>
                            <td style="color:#718096;font-size:13px;">
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
                                    <span style="font-size:12px;color:#a0aec0;">Tu cuenta</span>
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
                                <th style="text-align:left">Nombre</th>
                                <th style="text-align:left">Email</th>
                                <th style="text-align:left">Mensaje</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($mensajes as $m): ?>
                            <tr>
                                <td style="color:#a0aec0;font-size:13px;">#<?= $m['id'] ?></td>
                                <td style="text-align:left;font-weight:600;"><?= htmlspecialchars($m['nombre']) ?></td>
                                <td style="text-align:left;color:#718096;"><?= htmlspecialchars($m['email']) ?></td>
                                <td style="text-align:left;max-width:300px;">
                                    <span title="<?= htmlspecialchars($m['mensaje']) ?>">
                                        <?= htmlspecialchars(mb_strimwidth($m['mensaje'], 0, 80, '...')) ?>
                                    </span>
                                </td>
                                <td style="color:#718096;font-size:13px;white-space:nowrap;">
                                    <?= date('d/m/Y H:i', strtotime($m['fecha'])) ?>
                                </td>
                                <td class="backup-acciones">
                                    <form action="php/eliminar_mensaje.php" method="POST"
                                          onsubmit="return confirm('Eliminar este mensaje?');" style="display:inline;">
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

        <div style="text-align:center;margin-top:16px;">
            <a href="home.php" class="boton-perfil-sec" style="display:inline-block;width:auto;padding:10px 28px;">
                &#8592; Volver al inicio
            </a>
        </div>

    </div>
</main>

<?php include 'php/tab_sesion.php'; ?>
</body>
</html>
