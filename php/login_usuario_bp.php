<?php
    session_start(); // Iniciamos sesión para recordar al usuario
    include 'conexion_be.php';

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Buscamos al usuario por correo
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");

    if(mysqli_num_rows($validar_login) > 0){
        $usuario_datos = mysqli_fetch_assoc($validar_login);
        
        // Verificamos si la contraseña coincide con la encriptada
        if(password_verify($contrasena, $usuario_datos['contrasena'])){
            $_SESSION['usuario'] = $correo;
            header("location: ../bienvenida.php"); // Página a la que va tras loguearse
            exit();
        }
    }

    echo '<script>alert("Usuario o contraseña incorrectos"); window.location = "../index.php";</script>';
    exit();
?>