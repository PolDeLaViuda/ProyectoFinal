<?php
include 'conexion_be.php';

// Recogemos los datos del formulario
$nombre = $_POST['nombre_completo']; // El nombre que viene del HTML
$email = $_POST['correo'];           // El correo que viene del HTML
$password = $_POST['contrasena'];    // La contraseña que viene del HTML

// Encriptamos la contraseña (SHA512 es muy seguro para clase)
$password_encriptada = hash('sha512', $password);

// IMPORTANTE: Aquí usamos los nombres EXACTOS de tu captura de phpMyAdmin
$query = "INSERT INTO usuarios(nombre, email, password_hash) 
          VALUES('$nombre', '$email', '$password_encriptada')";

// Ejecutamos la consulta
$ejecutar = mysqli_query($conexion, $query);

if($ejecutar){
    echo '<script>alert("Usuario registrado correctamente"); window.location = "../index.php";</script>';
} else {
    // Si hay un error, nos dirá exactamente qué pasa
    echo "Error: " . $query . "<br>" . mysqli_error($conexion);
}

mysqli_close($conexion);
?>