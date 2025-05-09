<?php 


$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$isLocalhost = ($host === 'localhost' || $host === '127.0.0.1' || strpos($host, 'localhost') === 0 || strpos($host, '127.0.0.1') === 0);

// depurar
//echo 'Localhost: ' . ($isLocalhost ? 'si' : 'no') . '<br>';

// Definir la URL base correctamente para el entorno local
$base = $isLocalhost ? 'http://127.0.0.1:3000' : 'http://proyectospedro.42web.io/AppSalon_php/public/index.php';
define('BASE_URL', $base);

$base_static = $isLocalhost ? 'http://127.0.0.1:3000' : 'http://proyectospedro.42web.io/AppSalon_php/public';
define('BASE_URL_STATIC', $base_static);


// --- SMTP Datos del correo ---
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'acaaveir@gmail.com');
define('SMTP_PASS', 'nnkgqvdgchpasbgf');


require 'funciones.php';
require 'database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);