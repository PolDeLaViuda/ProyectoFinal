<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    header("Location: ../index.php"); exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin.php"); exit;
}

$fecha      = date('Y-m-d_H-i-s');
$dir_backup = 'C:\\Users\\Pol de la Viuda\\Desktop\\copia web final\\';
if (!is_dir($dir_backup)) mkdir($dir_backup, 0755, true);

if (!class_exists('ZipArchive')) {
    $_SESSION['admin_error'] = 'La extension ZipArchive no esta activada en PHP.';
    header("Location: ../admin.php"); exit;
}

$archivo_zip = $dir_backup . "backup_{$fecha}.zip";
$carpeta_web = 'C:\\xampp\\htdocs\\ProyectoFinal\\ProyectoFinal\\';

$zip = new ZipArchive();
if ($zip->open($archivo_zip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
    $_SESSION['admin_error'] = 'No se pudo crear el archivo ZIP.';
    header("Location: ../admin.php"); exit;
}

// --- Archivos web: siempre con barras normales (/) para evitar problemas ---
$iter = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($carpeta_web, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::LEAVES_ONLY
);
$total_archivos = 0;
foreach ($iter as $file) {
    if ($file->isFile()) {
        $ruta_real     = $file->getRealPath();
        $relativa      = str_replace('\\', '/', substr($ruta_real, strlen($carpeta_web)));
        $zip->addFile($ruta_real, 'web/' . $relativa);
        $total_archivos++;
    }
}

// --- Volcado SQL ---
$sql_ok    = false;
$mysqldump = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';
if (file_exists($mysqldump) && function_exists('shell_exec')) {
    $output = shell_exec('"' . $mysqldump . '" --user=root --host=localhost sistema_login 2>&1');
    if ($output && strlen($output) > 200) {
        $zip->addFromString('bd/sistema_login.sql', $output);
        $sql_ok = true;
    }
}

$zip->close();

$tam = file_exists($archivo_zip) ? round(filesize($archivo_zip) / 1048576, 2) : 0;
$_SESSION['admin_ok'] = "Backup creado: backup_{$fecha}.zip ({$tam} MB, {$total_archivos} archivos"
                      . ($sql_ok ? ' + BD)' : ' — BD no incluida)');

header("Location: ../admin.php"); exit;
