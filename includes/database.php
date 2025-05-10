<?php

require_once 'app.php';
//$db = mysqli_connect('localhost', 'root', 'root', 'appsalon_mvc');
$db_produccion = mysqli_connect('DB_HOST', 'DB_USER', 'DB_PASS', 'DB_NAME');


if (!$db_produccion) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
