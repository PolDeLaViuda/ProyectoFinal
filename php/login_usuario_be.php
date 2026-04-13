<?php
session_start();
include 'conexion_be.php'; 

$correo = $_POST['correo'];
$password = $_POST['contrasena'];

// 1. Buscamos al usuario solo por correo para ver qué tiene en la base de datos
$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email='$correo'");

if(mysqli_num_rows($validar_login) > 0){
    $usuario = mysqli_fetch_assoc($validar_login);
    
    /**
     * IMPORTANTE:
     * El error suele estar en cómo se llama la columna en tu base de datos.
     * He puesto esta lógica para que busque en 'contrasena', 'password' o 'password_hash'.
     */
    $password_db = "";
    if (isset($usuario['contrasena'])) {
        $password_db = $usuario['contrasena'];
    } elseif (isset($usuario['password_hash'])) {
        $password_db = $usuario['password_hash'];
    } elseif (isset($usuario['password'])) {
        $password_db = $usuario['password'];
    }

    // 2. Comparación de la contraseña
    // Probamos tanto si está encriptada como si es texto plano
    if($password === $password_db || password_verify($password, $password_db)){
        
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['email'] = $usuario['email'];
        
        header("location: ../home.php");
        exit;
    } else {
        echo '
            <script>
                alert("La contraseña no coincide con la guardada en la base de datos.");
                window.location = "../index.php";
            </script>
        ';
        exit;
    }
} else {
    echo '
        <script>
            alert("Este correo no está registrado.");
            window.location = "../index.php";
        </script>
    ';
    exit;
}
?>