<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php"); exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../home.php"); exit;
}

include 'conexion.php';

$uid       = (int)$_SESSION['usuario_id'];
$liga      = $_POST['liga']      ?? '';
$equipo_id = (int)($_POST['equipo_id'] ?? 0);
$redirect  = $_POST['redirect']  ?? 'home.php';

if (!in_array($liga, ['nba', 'laliga']) || $equipo_id <= 0) {
    header("Location: ../home.php"); exit;
}

// Solo permitir redireccion a paginas conocidas
$pagina_base = strtok($redirect, '?');
if (!in_array($pagina_base, ['equipo.php', 'nba.php', 'laliga.php', 'home.php'])) {
    $redirect = 'home.php';
}

$stmt = mysqli_prepare($conexion, "SELECT 1 FROM favoritos WHERE usuario_id=? AND liga=? AND equipo_id=?");
mysqli_stmt_bind_param($stmt, "isi", $uid, $liga, $equipo_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$existe = mysqli_stmt_num_rows($stmt) > 0;
mysqli_stmt_close($stmt);

if ($existe) {
    $stmt = mysqli_prepare($conexion, "DELETE FROM favoritos WHERE usuario_id=? AND liga=? AND equipo_id=?");
} else {
    $stmt = mysqli_prepare($conexion, "INSERT IGNORE INTO favoritos (usuario_id, liga, equipo_id) VALUES (?,?,?)");
}
mysqli_stmt_bind_param($stmt, "isi", $uid, $liga, $equipo_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: ../" . $redirect); exit;
