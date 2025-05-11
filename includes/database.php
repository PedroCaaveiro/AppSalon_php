<?php

require_once 'app.php';
$db = mysqli_connect('localhost', 'root', 'root', 'appsalon_mvc');
//$db = mysqli_connect('DB_HOST', 'DB_USER', 'DB_PASS', 'DB_NAME');


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
