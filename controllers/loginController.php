<?php


namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Classes\Email;


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
                  
                  // revisar alertas este vacio

                  if (empty($alertas)) {
                   $resultado = $usuario->existeUsuario();

                   if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                   }else{
                    // hashear password
                    $usuario->hashPassword();
                    
                    // crear token unico

                    $usuario->crearToken();

                    // enviar un email

                    $email = new Email($usuario->nombre,$usuario->email,$usuario->token);
                    
                   }
                  }
                      
                }
                $router->render('auth/crear-cuenta',[
                    'usuario' => $usuario,
                    'alertas' => $alertas
                ]);
                    
                }

}
?>