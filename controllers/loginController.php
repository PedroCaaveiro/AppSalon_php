<?php


namespace Controllers;

use Model\Usuario;
use MVC\Router;

class loginController{


public static function login(Router $router){

    $router->render('auth/login');


}

public static function logout(){

    echo "saliendo logout";
    
    }

    public static function olvide(Router $router){

        $router->render("auth/olvide-password");
        
        }

        public static function recuperar(){

            echo "saliendo recuperar";
            
            }

            public static function crear(Router $router){
                $usuario = new Usuario($_POST);

                $alertas = [];

                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                   
                  $usuario->sincronizar($_POST);
                  $alertas = $usuario->validarNuevaCuenta();
                  
                      
                }
                $router->render('auth/crear-cuenta',[
                    'usuario' => $usuario,
                    'alertas' => $alertas
                ]);
                    
                }

}
?>