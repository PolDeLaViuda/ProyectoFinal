<?php
session_start();
if (!isset($_SESSION['usuario_nombre'])) { header("Location: index.php"); exit; }

$liga       = 'laliga';
$titulo     = 'La Liga';
$icono      = '&#9917;';
$temporada  = '2024-25';
$pagina     = 'laliga';
$css_header = 'laliga-header';
$nombre     = htmlspecialchars($_SESSION['usuario_nombre']);

include 'php/vista_liga.php';
