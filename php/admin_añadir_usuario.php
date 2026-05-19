<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    header("Location: ../index.php"); exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'conexion.php';
    $nombre   = trim($_POST['nombre']   ?? '');
    $email    = trim($_POST['email']    ?? '');
    $password = $_POST['password']      ?? '';
    $rol      = ($_POST['rol'] ?? '') === 'admin' ? 'admin' : 'usuario';

    if ($nombre === '' || $email === '' || $password === '') {
        $_SESSION['admin_error'] = 'Todos los campos son obligatorios.';
        header("Location: ../admin.php"); exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['admin_error'] = 'El email no es valido.';
        header("Location: ../admin.php"); exit;
    }
    if (strlen($password) < 6) {
        $_SESSION['admin_error'] = 'La contrasena debe tener al menos 6 caracteres.';
        header("Location: ../admin.php"); exit;
    }
    $stmt = mysqli_prepare($conexion, "SELECT id FROM usuarios WHERE email = ?");
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);
        $_SESSION['admin_error'] = 'Ese email ya esta registrado.';
        header("Location: ../admin.php"); exit;
    }
    mysqli_stmt_close($stmt);

    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = mysqli_prepare($conexion, "INSERT INTO usuarios (nombre, email, password_hash, rol) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssss', $nombre, $email, $hash, $rol);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['admin_ok'] = "Usuario \"$nombre\" creado correctamente.";
    } else {
        $_SESSION['admin_error'] = 'Error al crear el usuario.';
    }
}
header("Location: ../admin.php"); exit;
