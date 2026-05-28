<?php
ob_start();
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    header("Location: ../index.php"); exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin.php"); exit;
}

$archivo = $_POST['archivo'] ?? '';
if (basename($archivo) !== $archivo || $archivo === '') {
    $_SESSION['admin_error'] = 'Archivo no valido.';
    header("Location: ../admin.php"); exit;
}

$ruta = 'C:\\Users\\Pol de la Viuda\\Desktop\\copia web final\\' . $archivo;
if (!file_exists($ruta)) {
    $_SESSION['admin_error'] = 'No se encontro el archivo de backup.';
    header("Location: ../admin.php"); exit;
}
if (!class_exists('ZipArchive')) {
    $_SESSION['admin_error'] = 'La extension ZipArchive no esta activada en PHP.';
    header("Location: ../admin.php"); exit;
}

$zip = new ZipArchive();
if ($zip->open($ruta) !== true) {
    $_SESSION['admin_error'] = 'No se pudo abrir el archivo ZIP.';
    header("Location: ../admin.php"); exit;
}

$destino_web = 'C:\\xampp\\htdocs\\ProyectoFinal\\ProyectoFinal\\';
$errores     = [];
$oks         = [];

// --- Restaurar archivos web entrada por entrada ---
$copiados = 0;
for ($i = 0; $i < $zip->numFiles; $i++) {
    $nombre = $zip->getNameIndex($i);

    // Solo entradas dentro de web/
    if (strncmp($nombre, 'web/', 4) !== 0) continue;

    $relativa = substr($nombre, 4); // quitar 'web/'
    if ($relativa === '' || substr($relativa, -1) === '/') continue; // saltar carpetas

    $destino = $destino_web . str_replace('/', DIRECTORY_SEPARATOR, $relativa);
    $dir     = dirname($destino);
    if (!is_dir($dir)) mkdir($dir, 0755, true);

    $contenido = $zip->getFromIndex($i);
    if ($contenido !== false) {
        file_put_contents($destino, $contenido);
        $copiados++;
    }
}
if ($copiados > 0) {
    $oks[] = "{$copiados} archivos web restaurados.";
} else {
    $errores[] = 'No se encontraron archivos web en el backup.';
}

// --- Restaurar base de datos ---
$sql = $zip->getFromName('bd/sistema_login.sql');
if ($sql !== false) {
    $tmp_sql = sys_get_temp_dir() . '\\restore_' . time() . '.sql';
    file_put_contents($tmp_sql, $sql);
    $mysql  = 'C:\\xampp\\mysql\\bin\\mysql.exe';
    if (file_exists($mysql) && function_exists('shell_exec')) {
        $output = shell_exec('"' . $mysql . '" --user=root --host=localhost sistema_login < "' . $tmp_sql . '" 2>&1');
        unlink($tmp_sql);
        if (trim($output ?? '') === '') {
            $oks[] = 'Base de datos restaurada.';
        } else {
            $errores[] = 'Error al importar BD: ' . htmlspecialchars(substr($output, 0, 200));
        }
    } else {
        unlink($tmp_sql);
        $errores[] = 'mysql.exe no encontrado. Los archivos web si se restauraron.';
    }
} else {
    $errores[] = 'El backup no contiene copia de BD.';
}

$zip->close();

if ($oks)     $_SESSION['admin_ok']    = implode(' | ', $oks);
if ($errores) $_SESSION['admin_error'] = implode(' | ', $errores);

ob_end_clean();
session_write_close();
echo '<!DOCTYPE html><html><head><meta charset="UTF-8">
<meta http-equiv="refresh" content="0;url=../home.php">
<script>window.location.replace("../home.php");</script>
</head><body></body></html>';
exit;
