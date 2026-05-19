<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    header("Location: ../index.php"); exit;
}

$tipo    = $_GET['tipo']    ?? '';
$archivo = $_GET['archivo'] ?? '';

if ($tipo === 'bd') {
    $dir     = 'C:\\Backups\\diario\\';
    $pattern = '/^bd_[\d_-]+\.sql$/';
} elseif ($tipo === 'web') {
    $dir     = 'C:\\Backups\\semanal\\';
    $pattern = '/^web_[\d_-]+\.zip$/';
} else {
    http_response_code(400); exit("Tipo no valido.");
}

if (!preg_match($pattern, $archivo)) {
    http_response_code(400); exit("Archivo no valido.");
}

$ruta = $dir . $archivo;
if (!file_exists($ruta)) {
    http_response_code(404); exit("Archivo no encontrado.");
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $archivo . '"');
header('Content-Length: ' . filesize($ruta));
header('Cache-Control: no-cache');
readfile($ruta);
exit;
