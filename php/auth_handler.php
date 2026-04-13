<?php
header('Content-Type: application/json');
// Conexión a tu base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyecto_db");

if (!$conexion) {
    echo json_encode(["success" => false, "error" => "Error de conexión"]);
    exit;
}

// Recibimos los datos del JS
$data = json_decode(file_get_contents("php://input"), true);
$action = $data['action'] ?? '';

if ($action === 'login') {
    $email_recibido = $data['email']; 
    $password_recibida = $data['password'];

    // Buscamos en la columna 'Correo' (con Mayúscula como tu captura)
    $res = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Correo = '$email_recibido'");
    $user = mysqli_fetch_assoc($res);

    if ($user) {
        // IMPORTANTE: Si tus contraseñas en la BD no están encriptadas, 
        // cambia esta línea por: if ($password_recibida == $user['password']) {
        if (password_verify($password_recibida, $user['password']) || $password_recibida == $user['password']) {
            echo json_encode([
                "success" => true,
                "user" => [
                    "name" => $user['Nombre'], // 'Nombre' con N mayúscula
                    "email" => $user['Correo']  // 'Correo' con C mayúscula
                ]
            ]);
        } else {
            echo json_encode(["success" => false, "error" => "Contrasenya incorrecta"]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "L'usuari no existeix"]);
    }
    exit;
}

// Acción de registro (asegurando que guarde en las columnas correctas)
if ($action === 'register') {
    $nom = $data['nombre'];
    $cor = $data['email'];
    $pas = $data['password']; // Aquí podrías usar password_hash si quieres seguridad

    $sql = "INSERT INTO usuarios (Nombre, Correo, password) VALUES ('$nom', '$cor', '$pas')";
    if (mysqli_query($conexion, $sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($conexion)]);
    }
    exit;
}
?>