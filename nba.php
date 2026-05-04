<?php
session_start();
if (!isset($_SESSION['usuario_nombre'])) { header("Location: index.php"); exit; }

$liga       = 'nba';
$titulo     = 'NBA';
$icono      = '&#127936;';
$temporada  = '2025-26';
$pagina     = 'nba';
$css_header = 'nba-header';
$nombre     = htmlspecialchars($_SESSION['usuario_nombre']);

include 'php/vista_liga.php';
