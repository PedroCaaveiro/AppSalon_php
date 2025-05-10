<?php 

$host = $_SERVER['HTTP_HOST'];
$isLocalhost = strpos($host, '127.0.0.1') !== false || strpos($host, 'localhost') !== false;
$isNgrok = strpos($host, 'ngrok-free.app') !== false || strpos($host, 'ngrok.io') !== false;

$isHttps = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';

if ($isLocalhost) {
    $base = 'http://127.0.0.1/AppSalon_php/public/index.php';  
    $basePath = '/AppSalon_php/public';
} elseif ($isNgrok) {
    // Cambiar base y basePath para ngrok para evitar el uso de /index.php
    $base = 'https://' . $host . '/AppSalon_php/public/index.php';  
    $basePath = '/AppSalon_php/public';
} else {
     if ($isHttps) {
        $base = 'https://proyectospedro.42web.io/AppSalon_php/public';  // Cambiado a https
    } else {
        $base = 'https://proyectospedro.42web.io/AppSalon_php/public';  // Si no es HTTPS, usa HTTP
    }

    $basePath = '/AppSalon_php/public';
}

// Define BASE_URL (sin cambios, sigue apuntando al index.php)
define('BASE_URL', $base);

// Ajusta BASE_URL_STATIC para archivos estáticos (para ngrok sin index.php)
if ($isNgrok) {
    define('BASE_URL_STATIC', 'https://' . $host . '/AppSalon_php/public');
} else {
    define('BASE_URL_STATIC', (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $host . '/AppSalon_php/public');
}


define('DB_HOST', 'sql313.infinityfree.com');
define('DB_USER', 'if0_38503538');
define('DB_PASS', 'Caaveiro2025');
define('DB_NAME', 'if0_38503538_appsalon_mvc');



require 'funciones.php';
require 'database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);