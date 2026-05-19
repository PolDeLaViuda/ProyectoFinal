<?php
session_start();
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    if (empty($email) || empty($password)) {
        $_SESSION['error_login'] = "Rellena todos los campos.";
        header("Location: ../index.php"); exit;
    }
    $stmt = mysqli_prepare($conexion, "SELECT id, nombre, email, password_hash, rol FROM usuarios WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($fila = mysqli_fetch_assoc($res)) {
        if (password_verify($password, $fila['password_hash'])) {
            $_SESSION['usuario_id']     = $fila['id'];
            $_SESSION['usuario_nombre'] = $fila['nombre'];
            $_SESSION['usuario_email']  = $fila['email'];
            $_SESSION['usuario_rol']    = $fila['rol'] ?? 'user';
            $_SESSION['nuevo_login']    = true;
            header("Location: ../home.php"); exit;
        } else {
            $_SESSION['error_login'] = "Contrasena incorrecta.";
        }
    } else {
        $_SESSION['error_login'] = "No existe ninguna cuenta con ese email.";
    }
    mysqli_stmt_close($stmt);
    header("Location: ../index.php"); exit;
}
header("Location: ../index.php"); exit;
