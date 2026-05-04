<?php
session_start();
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = trim($_POST['nombre']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    if (empty($nombre) || empty($email) || empty($password)) {
        $_SESSION['error_registro'] = "Todos los campos son obligatorios.";
        header("Location: ../index.php?form=registro"); exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_registro'] = "Email no valido.";
        header("Location: ../index.php?form=registro"); exit;
    }
    if (strlen($password) < 6) {
        $_SESSION['error_registro'] = "La contrasena debe tener al menos 6 caracteres.";
        header("Location: ../index.php?form=registro"); exit;
    }
    $stmt = mysqli_prepare($conexion, "SELECT id FROM usuarios WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        $_SESSION['error_registro'] = "Este email ya esta registrado.";
        mysqli_stmt_close($stmt);
        header("Location: ../index.php?form=registro"); exit;
    }
    mysqli_stmt_close($stmt);
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = mysqli_prepare($conexion, "INSERT INTO usuarios (nombre, email, password_hash) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $nombre, $email, $hash);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['exito_registro'] = "Cuenta creada. Ya puedes iniciar sesion.";
        header("Location: ../index.php");
    } else {
        $_SESSION['error_registro'] = "Error al registrar. Intentalo de nuevo.";
        header("Location: ../index.php?form=registro");
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    exit;
}
header("Location: ../index.php"); exit;
