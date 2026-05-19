<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    header("Location: ../index.php"); exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin.php"); exit;
}

$tipo  = $_POST['tipo'] ?? 'completo';
$fecha = date('Y-m-d_H-i-s');
$errores = [];
$ok_msgs = [];

// --- BACKUP BASE DE DATOS ---
if ($tipo === 'bd' || $tipo === 'completo') {
    $dir_bd = 'C:\\Backups\\diario\\';
    if (!is_dir($dir_bd)) mkdir($dir_bd, 0755, true);

    $mysqldump = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';

    if (!file_exists($mysqldump)) {
        $errores[] = "No se encontro mysqldump en: {$mysqldump}";
    } elseif (!function_exists('shell_exec')) {
        $errores[] = "shell_exec esta desactivado en PHP.";
    } else {
        $archivo_bd = $dir_bd . "bd_{$fecha}.sql";
        $cmd        = '"' . $mysqldump . '" --user=root --host=localhost sistema_login 2>&1';
        $output     = shell_exec($cmd);

        if ($output && strlen($output) > 200) {
            file_put_contents($archivo_bd, $output);
            $ok_msgs[] = "BD guardada: diario\\bd_{$fecha}.sql (" . round(strlen($output) / 1024, 1) . " KB)";
        } else {
            $errores[] = "Error al volcar la BD: " . htmlspecialchars(substr($output ?? 'Sin salida', 0, 200));
        }
    }
}

// --- BACKUP WEB ---
if ($tipo === 'web' || $tipo === 'completo') {
    $dir_web   = 'C:\\Backups\\semanal\\';
    if (!is_dir($dir_web)) mkdir($dir_web, 0755, true);

    if (!class_exists('ZipArchive')) {
        $errores[] = "La extension ZipArchive no esta activada en PHP.";
    } else {
        $carpeta_web = realpath(__DIR__ . '/../../') . DIRECTORY_SEPARATOR;
        $archivo_zip = $dir_web . "web_{$fecha}.zip";

        $zip = new ZipArchive();
        if ($zip->open($archivo_zip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $iter = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($carpeta_web, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::LEAVES_ONLY
            );
            $total = 0;
            foreach ($iter as $file) {
                if ($file->isFile()) {
                    $ruta_real   = $file->getRealPath();
                    $ruta_relativa = substr($ruta_real, strlen($carpeta_web));
                    $zip->addFile($ruta_real, $ruta_relativa);
                    $total++;
                }
            }
            $zip->close();
            $tam = file_exists($archivo_zip) ? round(filesize($archivo_zip) / 1048576, 2) : 0;
            $ok_msgs[] = "Web guardada: semanal\\web_{$fecha}.zip ({$tam} MB, {$total} archivos)";
        } else {
            $errores[] = "No se pudo crear el archivo ZIP en {$dir_web}";
        }
    }
}

if ($errores) {
    $_SESSION['admin_error'] = implode(' | ', $errores);
}
if ($ok_msgs) {
    $_SESSION['admin_ok'] = implode(' &nbsp;|&nbsp; ', $ok_msgs);
}

header("Location: ../admin.php"); exit;
