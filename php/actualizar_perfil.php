<?php
session_start();
if (!isset($_SESSION['usuario_nombre'])) { header("Location: ../index.php"); exit; }
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header("Location: ../perfil.php"); exit; }

$id       = (int)$_SESSION['usuario_id'];
$nombre   = trim($_POST['nombre']   ?? '');
$email    = trim($_POST['email']    ?? '');
$nueva_pw = $_POST['nueva_password'] ?? '';
$confirm  = $_POST['confirmar_password'] ?? '';

if (empty($nombre) || empty($email)) {
    $_SESSION['perfil_error'] = "El nombre y el email son obligatorios.";
    header("Location: ../perfil.php"); exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['perfil_error'] = "El formato del email no es valido.";
    header("Location: ../perfil.php"); exit;
}

// Verificar que el email no lo use otro usuario
$stmt = mysqli_prepare($conexion, "SELECT id FROM usuarios WHERE email = ? AND id != ?");
mysqli_stmt_bind_param($stmt, "si", $email, $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) > 0) {
    $_SESSION['perfil_error'] = "Ese email ya esta en uso por otra cuenta.";
    mysqli_stmt_close($stmt);
    header("Location: ../perfil.php"); exit;
}
mysqli_stmt_close($stmt);

// Actualizar nombre y email
$stmt = mysqli_prepare($conexion, "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Cambiar contrasena si se rellenaron los campos
if (!empty($nueva_pw)) {
    if (strlen($nueva_pw) < 6) {
        $_SESSION['perfil_error'] = "La nueva contrasena debe tener al menos 6 caracteres.";
        header("Location: ../perfil.php"); exit;
    }
    if ($nueva_pw !== $confirm) {
        $_SESSION['perfil_error'] = "Las contrasenas no coinciden.";
        header("Location: ../perfil.php"); exit;
    }
    $hash = password_hash($nueva_pw, PASSWORD_BCRYPT);
    $stmt = mysqli_prepare($conexion, "UPDATE usuarios SET password_hash = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "si", $hash, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Actualizar sesion
$_SESSION['usuario_nombre'] = $nombre;
$_SESSION['usuario_email']  = $email;
$_SESSION['perfil_ok'] = "Perfil actualizado correctamente.";
mysqli_close($conexion);
header("Location: ../perfil.php"); exit;
