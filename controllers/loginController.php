<?php


namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Classes\Email;


class loginController
{


    public static function login(Router $router)
    {
        $alertas = [];
       

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            // verificacion existe usuario
            if (empty($alertas)) {
                $usuario = Usuario::where('email',$auth->email);

                if ($usuario) {
                    // verifico password
                $usuario->comprobarPasswordANDVerificardo($auth->password);
                // verifico el usuario
                session_start();
                $_SESSION['id'] = $usuario->id;
                $_SESSION['nombre'] = $usuario->nombre. " ". $usuario->apellido;
                $_SESSION['email'] = $usuario->email;
                $_SESSION['login'] = true;

                if ($usuario->admin === '1') {
                    header('Location: /admin');
                    // echo ' es admin';
                }else{
                    header('Location: /cita');
                   // echo 'es cliente';
                }

                }else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();        
        $router->render('auth/login',[
            'alertas' => $alertas,
            
        ]);
       
    }

    public static function logout()
    {

        echo "saliendo logout";
    }

    public static function olvide(Router $router)
    {

        $alertas =[];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas =$auth->validarEmail();

           if (empty($alertas)) {
            $usuario = Usuario::where('email',$auth->email);
            //debuguear($usuario);
            if ($usuario && $usuario->confirmado ==='1') {
               // debuguear('Si existe y esta confirmado');
               $usuario->crearToken();
               $usuario->guardar();
            }else{
               Usuario::setAlerta('error','El usuario no existe o no esta confirmado');
                $alertas = Usuario::getAlertas();
              // debuguear('no existe o no esta confirmado');
            }
           }
        }

        $router->render('auth/olvide-password', ['alertas' => $alertas]);

    }

    public static function recuperar()
    {

        echo "saliendo recuperar";
    }

    public static function crear(Router $router)
    {
        $usuario = new Usuario($_POST);

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarNuevaCuenta();

            // revisar alertas este vacio

            if (empty($alertas)) {
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // hashear password
                    $usuario->hashPassword();

                    // crear token unico

                    $usuario->crearToken();

                    // enviar un email

                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();

                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router)
    {

        $router->render('auth/mensaje');
    }
    public static function confirmar(Router $router)
    {

        $alertas = [];

        $token = s($_GET['token']);
        //var_dump($token);

        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token no Valido');
        } else {
            $usuario->confirmado = '1';
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta comprobada Correctamente');
        }
        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}
