<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    header("Location: ../index.php"); exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin.php"); exit;
}

$tipo    = $_POST['tipo']    ?? '';
$archivo = $_POST['archivo'] ?? '';

if ($tipo === 'bd') {
    $dir     = 'C:\\Backups\\diario\\';
    $pattern = '/^bd_[\d_-]+\.sql$/';
} elseif ($tipo === 'web') {
    $dir     = 'C:\\Backups\\semanal\\';
    $pattern = '/^web_[\d_-]+\.zip$/';
} else {
    $_SESSION['admin_error'] = "Tipo de backup no valido.";
    header("Location: ../admin.php"); exit;
}

if (!preg_match($pattern, $archivo)) {
    $_SESSION['admin_error'] = "Nombre de archivo no valido.";
    header("Location: ../admin.php"); exit;
}

$ruta = $dir . $archivo;
if (file_exists($ruta)) {
    unlink($ruta);
    $_SESSION['admin_ok'] = "Backup eliminado: {$archivo}";
} else {
    $_SESSION['admin_error'] = "El archivo no existe.";
}

header("Location: ../admin.php"); exit;
