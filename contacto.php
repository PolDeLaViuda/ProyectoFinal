<?php
session_start();
if (!isset($_SESSION['usuario_nombre'])) { header("Location: index.php"); exit; }
$nombre = htmlspecialchars($_SESSION['usuario_nombre']);

require 'php/conexion.php';

// Crear tabla si no existe
mysqli_query($conexion,
    "CREATE TABLE IF NOT EXISTS resenas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        autor VARCHAR(100) NOT NULL,
        tipo VARCHAR(80) NOT NULL,
        valoracion TINYINT NOT NULL,
        mensaje TEXT NOT NULL,
        fecha DATETIME DEFAULT CURRENT_TIMESTAMP
    )"
);

$enviado = false;
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campo_tipo      = trim(htmlspecialchars($_POST['tipo']      ?? ''));
    $campo_valoracion = (int)($_POST['valoracion'] ?? 0);
    $campo_mensaje   = trim(htmlspecialchars($_POST['mensaje']   ?? ''));

    if ($campo_tipo === '')                              $errores[] = 'Selecciona el tipo de opinion.';
    if ($campo_valoracion < 1 || $campo_valoracion > 5) $errores[] = 'Selecciona una valoracion de 1 a 5 estrellas.';
    if (strlen($campo_mensaje) < 10)                    $errores[] = 'El mensaje debe tener al menos 10 caracteres.';

    if (empty($errores)) {
        $stmt = mysqli_prepare($conexion,
            "INSERT INTO resenas (autor, tipo, valoracion, mensaje) VALUES (?,?,?,?)"
        );
        mysqli_stmt_bind_param($stmt, 'ssis', $nombre, $campo_tipo, $campo_valoracion, $campo_mensaje);
        mysqli_stmt_execute($stmt);
        $enviado = true;
    }
}

// Cargar resenas existentes
$resenas = [];
$res = mysqli_query($conexion, "SELECT * FROM resenas ORDER BY fecha DESC LIMIT 20");
if ($res) {
    while ($fila = mysqli_fetch_assoc($res)) $resenas[] = $fila;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Opiniones - StatsZone</title>
<link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
<header class="cabecera">
    <a href="home.php" class="logo">&#128202; StatsZone</a>
    <div class="usuario-info">
        &#128100; <a href="perfil.php" class="usuario-nombre-link"><?= $nombre ?></a>
        <a href="php/cerrar_sesion.php" class="boton-salir">Cerrar sesion</a>
    </div>
</header>

<main class="pagina-resenas">

    <div class="resenas-titulo">
        <h1>&#11088; Opiniones y sugerencias</h1>
        <p>Cuéntanos qué te parece StatsZone o cómo podemos mejorar.</p>
    </div>

    <div class="resenas-tarjeta">
        <?php if ($enviado): ?>
            <div class="resenas-exito">
                <div class="exito-icono">&#9989;</div>
                <h2>Gracias por tu opinion</h2>
                <p>Tu valoracion ha sido publicada. Nos ayuda a seguir mejorando.</p>
                <a href="contacto.php" class="boton boton--primario" style="display:inline-block;width:auto;padding:12px 28px;">
                    Ver todas las opiniones
                </a>
            </div>
        <?php else: ?>
            <h2>Deja tu valoracion</h2>
            <p>Todos los comentarios son visibles para la comunidad.</p>

            <?php if (!empty($errores)): ?>
                <div class="alerta alerta--error">
                    <?php foreach ($errores as $e): ?>
                        <div>&#9888; <?= $e ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="contacto.php" novalidate>

                <div class="campo">
                    <label for="tipo">Tipo de opinion</label>
                    <select id="tipo" name="tipo" required>
                        <option value="">Selecciona...</option>
                        <option value="Resena general"       <?= (($_POST['tipo'] ?? '') === 'Resena general')       ? 'selected' : '' ?>>&#128172; Resena general</option>
                        <option value="Sugerencia de mejora" <?= (($_POST['tipo'] ?? '') === 'Sugerencia de mejora') ? 'selected' : '' ?>>&#128161; Sugerencia de mejora</option>
                        <option value="Error en datos"       <?= (($_POST['tipo'] ?? '') === 'Error en datos')       ? 'selected' : '' ?>>&#128683; Error en los datos</option>
                        <option value="Nueva liga o equipo"  <?= (($_POST['tipo'] ?? '') === 'Nueva liga o equipo')  ? 'selected' : '' ?>>&#127942; Pedir nueva liga o equipo</option>
                    </select>
                </div>

                <div class="campo">
                    <label>Valoracion</label>
                    <div class="estrellas">
                        <input type="radio" id="s5" name="valoracion" value="5" <?= (($_POST['valoracion'] ?? '') === '5') ? 'checked' : '' ?>>
                        <label for="s5" title="5 estrellas">&#9733;</label>
                        <input type="radio" id="s4" name="valoracion" value="4" <?= (($_POST['valoracion'] ?? '') === '4') ? 'checked' : '' ?>>
                        <label for="s4" title="4 estrellas">&#9733;</label>
                        <input type="radio" id="s3" name="valoracion" value="3" <?= (($_POST['valoracion'] ?? '') === '3') ? 'checked' : '' ?>>
                        <label for="s3" title="3 estrellas">&#9733;</label>
                        <input type="radio" id="s2" name="valoracion" value="2" <?= (($_POST['valoracion'] ?? '') === '2') ? 'checked' : '' ?>>
                        <label for="s2" title="2 estrellas">&#9733;</label>
                        <input type="radio" id="s1" name="valoracion" value="1" <?= (($_POST['valoracion'] ?? '') === '1') ? 'checked' : '' ?>>
                        <label for="s1" title="1 estrella">&#9733;</label>
                    </div>
                </div>

                <div class="campo">
                    <label for="mensaje">Tu opinion</label>
                    <textarea id="mensaje" name="mensaje" required
                              placeholder="Escribe aqui tu opinion, sugerencia o lo que quieras contarnos..."><?= isset($_POST['mensaje']) ? htmlspecialchars($_POST['mensaje']) : '' ?></textarea>
                </div>

                <button type="submit" class="boton boton--primario">
                    &#128228; Publicar opinion
                </button>
            </form>
        <?php endif; ?>
    </div>

    <?php if (!empty($resenas)): ?>
    <div class="resenas-lista">
        <h3>&#128172; Opiniones de la comunidad (<?= count($resenas) ?>)</h3>
        <?php foreach ($resenas as $r):
            $estrellas = str_repeat('★', (int)$r['valoracion']) . str_repeat('☆', 5 - (int)$r['valoracion']);
        ?>
        <div class="resena-item">
            <div class="resena-cabecera">
                <span class="resena-autor">&#128100; <?= htmlspecialchars($r['autor']) ?></span>
                <span class="resena-estrellas"><?= $estrellas ?></span>
            </div>
            <span class="resena-tipo"><?= htmlspecialchars($r['tipo']) ?></span>
            <p class="resena-texto"><?= nl2br(htmlspecialchars($r['mensaje'])) ?></p>
            <p class="resena-fecha">&#128336; <?= date('d/m/Y H:i', strtotime($r['fecha'])) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</main>

<?php include 'php/tab_sesion.php'; ?>
</body>
</html>
