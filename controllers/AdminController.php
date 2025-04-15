<?php



namespace Controllers;

use Model\AdminCita;
use MVC\Router;



class AdminController{


public static function index(Router $router){

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    

    isAdmin();

    $fecha = $_GET['fecha'] ?? date('Y-m-d');
    $fechas = explode('-',$fecha);

    if (!checkdate($fechas[1],$fechas[2],$fechas[0])) {
        header('Location: /404');
    }

// consulta bbdd

$sql = "SELECT citas.id, citas.hora, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS 'cliente', 
               usuarios.telefono, usuarios.email, servicios.nombre AS servicio, servicios.precio
        FROM citas
        LEFT OUTER JOIN usuarios ON citas.usuarioID = usuarios.id
        LEFT OUTER JOIN citas_servicios ON citas_servicios.citaID = citas.id
        LEFT OUTER JOIN servicios ON servicios.id = citas_servicios.servicioID
        WHERE fecha = '$fecha'";


        $citas = AdminCita::SQL($sql);
//debuguear($citas);

$router->render('admin/index',[
'nombre' => $_SESSION['nombre'],
'citas' => $citas,
'fecha' => $fecha
]);

}

}

?>