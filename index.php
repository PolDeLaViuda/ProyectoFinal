<?php
session_start();
if (isset($_SESSION['usuario_nombre'])) { header("Location: home.php"); exit; }
$mostrar = (isset($_GET['form']) && $_GET['form']==='registro') ? 'registro' : 'login';
$error_login    = $_SESSION['error_login']    ?? '';
$error_registro = $_SESSION['error_registro'] ?? '';
$exito_registro = $_SESSION['exito_registro'] ?? '';
unset($_SESSION['error_login'],$_SESSION['error_registro'],$_SESSION['exito_registro']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>StatsZone - Login</title>
<link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
<main class="pagina-auth">
<div class="tabs">
<a href="index.php"              class="tab <?= $mostrar==='login'   ?'tab--activo':'' ?>">Iniciar sesion</a>
<a href="index.php?form=registro"class="tab <?= $mostrar==='registro'?'tab--activo':'' ?>">Registrarse</a>
</div>
<div class="tarjeta">
<?php if ($mostrar==='login'): ?>
<h1>Bienvenido</h1>
<p>Inicia sesion para ver estadisticas</p>
<?php if ($error_login):  ?><div class="alerta alerta--error"><?= htmlspecialchars($error_login)  ?></div><?php endif; ?>
<?php if ($exito_registro):?><div class="alerta alerta--exito"><?= htmlspecialchars($exito_registro)?></div><?php endif; ?>
<form action="php/login.php" method="POST">
<div class="campo"><label>Correo electronico</label><input type="email" name="email" placeholder="ejemplo@correo.com" required></div>
<div class="campo"><label>Contrasena</label><input type="password" name="password" placeholder="........" required></div>
<button type="submit" class="boton boton--primario">Entrar</button>
</form>
<p class="pie-form">No tienes cuenta? <a href="index.php?form=registro">Registrate</a></p>
<?php else: ?>
<h1>Crear cuenta</h1>
<p>Rellena los datos para registrarte</p>
<?php if ($error_registro):?><div class="alerta alerta--error"><?= htmlspecialchars($error_registro)?></div><?php endif; ?>
<form action="php/registro.php" method="POST">
<div class="campo"><label>Nombre completo</label><input type="text" name="nombre" placeholder="Tu nombre" required></div>
<div class="campo"><label>Correo electronico</label><input type="email" name="email" placeholder="ejemplo@correo.com" required></div>
<div class="campo"><label>Contrasena</label><input type="password" name="password" placeholder="Minimo 6 caracteres" required></div>
<button type="submit" class="boton boton--primario">Crear cuenta</button>
</form>
<p class="pie-form">Ya tienes cuenta? <a href="index.php">Inicia sesion</a></p>
<?php endif; ?>
</div>
</main>
</body>
</html>
