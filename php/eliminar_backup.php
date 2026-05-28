<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    header("Location: ../index.php"); exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin.php"); exit;
}

$archivo = $_POST['archivo'] ?? '';

if (!preg_match('/^backup_[\d_-]+\.zip$/', $archivo)) {
    $_SESSION['admin_error'] = 'Nombre de archivo no valido.';
    header("Location: ../admin.php"); exit;
}

$ruta = 'C:\\Users\\Pol de la Viuda\\Desktop\\copia web final\\' . $archivo;
if (file_exists($ruta)) {
    unlink($ruta);
    $_SESSION['admin_ok'] = 'Copia de seguridad eliminada: ' . $archivo;
} else {
    $_SESSION['admin_error'] = 'El archivo no existe.';
}

header("Location: ../admin.php"); exit;
