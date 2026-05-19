<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_rol'] ?? '') !== 'admin') {
    header("Location: ../index.php"); exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    require 'conexion.php';
    $id = (int)$_POST['id'];
    if ($id === (int)$_SESSION['usuario_id']) {
        $_SESSION['admin_error'] = 'No puedes eliminar tu propia cuenta.';
        header("Location: ../admin.php"); exit;
    }
    $stmt = mysqli_prepare($conexion, "DELETE FROM usuarios WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['admin_ok'] = 'Usuario eliminado correctamente.';
    } else {
        $_SESSION['admin_error'] = 'No se pudo eliminar el usuario.';
    }
}
header("Location: ../admin.php"); exit;
