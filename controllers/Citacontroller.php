<?php


namespace Controllers;

use MVC\Router;



include_once __DIR__. '../../includes/funciones.php';


class Citacontroller{

public static function index(Router $router){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();

        
    }
    revisarUsuarioAutenticado();

    $router->render('cita/index',[
        'nombre' => $_SESSION['nombre'],
        'id' =>$_SESSION['id']

    ]);
}

}



?>