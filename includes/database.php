<?php

$db = mysqli_connect('localhost', 'root', 'root', 'appsalon_mvc');
//$db = mysqli_connect('sql313.infinityfree.com','if0_38503538', 'root', 'appsalon_mvc');


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
