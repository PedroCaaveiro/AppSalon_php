<?php


namespace Controllers;

use MVC\Router;

class loginController{


public static function login(Router $router){

    $router->render('auth/login');


}

public static function logout(){

    echo "saliendo logout";
    
    }

    public static function olvide(){

        echo "saliendo olvide";
        
        }

        public static function recuperar(){

            echo "saliendo recuperar";
            
            }

            public static function crear(){

                echo "crear cuenta";
                
                }

}
?>