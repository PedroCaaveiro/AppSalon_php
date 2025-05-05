<?php

$db = mysqli_connect('localhost', 'root', 'root', 'appsalon_mvc');
//$db = mysqli_connect('','', '', 'if0_38503538_appsalon_mvc');


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
