<?php
$conexion = mysqli_connect("localhost", "root", "", "sistema_login");
if (!$conexion) die("Error de conexion: " . mysqli_connect_error());
