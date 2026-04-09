<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login y Registro - Proyecto</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera-register">
                <h3>¿Aún no tienes cuenta?</h3>
                <p>Regístrate para poder iniciar sesión</p>
            </div>

            <form action="php/registro_usuario_be.php" method="POST" class="formulario__register">
                <h2>Registrarse</h2>
                <input type="text" placeholder="Nombre completo" name="nombre_completo" required>
                <input type="text" placeholder="Correo Electronico" name="correo" required>
                <input type="text" placeholder="Usuario" name="usuario" required>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <button>Registrarse</button>
            </form>
            
            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

            <form action="php/login_usuario_be.php" method="POST" class="formulario__login">
                <h2>Iniciar Sesión</h2>
                <input type="text" placeholder="Correo Electronico" name="correo" required>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <button>Entrar</button>
            </form>
        </div>
    </main>
</body>
</html>