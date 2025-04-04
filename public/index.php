<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\loginController;
use Controllers\Citacontroller;
use MVC\Router;

$router = new Router();

// Iniciar la sesion 
$router->get('/',[loginController::class,'login']);
$router->post('/',[loginController::class,'login']);
$router->get('/logout',[loginController::class,'logout']);


// recuperar el password

$router->get('/olvide',[loginController::class,'olvide']);
$router->post('/olvide',[loginController::class,'olvide']);
$router->get('/recuperar',[loginController::class,'recuperar']);
$router->post('/recuperar',[loginController::class,'recuperar']);

// crear cuenta
$router->get('/crear-cuenta',[loginController::class,'crear']);
$router->post('/crear-cuenta',[loginController::class,'crear']);

// confirmar cuenta

$router->get('/confirmar-cuenta',[loginController::class,'confirmar']);
$router->get('/mensaje',[loginController::class,'mensaje']);


//area privada

$router->get('/cita',[Citacontroller::class,'index']);
$router->get('/admin',[AdminController::class,'index']);

// Api de citas

$router->get('/api/servicios',[APIController::class,'index']);
$router->post('/api/citas',[APIController::class,'guardar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();