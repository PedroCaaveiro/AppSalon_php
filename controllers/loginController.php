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
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    // verifico password
                    $usuario->comprobarPasswordANDVerificardo($auth->password);
                    // verifico el usuario
                    session_start();
                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['login'] = true;

                    $_SESSION['admin'] = $usuario->admin === '1'; // Guardar como true si es admin



                    // Redirigir según si es admin o cliente
                    if ($_SESSION['admin']) {
                        header('Location: ' . BASE_URL . '/admin');
                        exit;
                    } else {
                        header('Location: ' . BASE_URL . '/cita');
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas,

        ]);
    }

    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        $_SESSION = [];

        header('Location: ' . BASE_URL . '/');

        //echo "saliendo logout";
    }

    public static function olvide(Router $router)
    {

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                //debuguear($usuario);
                if ($usuario && $usuario->confirmado === '1') {
                    // debuguear('Si existe y esta confirmado');
                    $usuario->crearToken();
                    $usuario->guardar();

                    // enviar email usuario
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviaInstrucciones();

                    //alerta
                    Usuario::setAlerta('exito', 'Password enviado revisa tu E-mail.');
                } else {
                    //alerta
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado.');

                    // debuguear('no existe o no esta confirmado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-password', ['alertas' => $alertas]);
    }

    public static function recuperar(Router $router)
    {
        $alertas = [];
        $error = false;

        $token = s($_GET['token'] ?? ''); // Evitar errores si no hay token en la URL

        $usuario = Usuario::where('token', $token);

        // Si el usuario no existe, mostrar error y detener la ejecución
        if (!$usuario) {
            Usuario::setAlerta('error', 'Token no válido o ha expirado');
            $error = true;
            $router->render('auth/recuperar-password', [
                'alertas' => Usuario::getAlertas(),
                'error' => $error
            ]);
            return; // Detener ejecución
        }

        // Si la petición es POST, validar y cambiar la contraseña
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if (empty($alertas)) {
                // Asignar nueva contraseña y guardar cambios
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar();

                if ($resultado) {
                    header('Location: ' . BASE_URL . '/');
                    exit;
                }
            }
        }

        // Renderizar la vista con alertas
        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error
        ]);
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
                        header('Location: ' . BASE_URL . '/mensaje');

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
