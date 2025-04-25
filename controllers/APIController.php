<?php

namespace Controllers;

use Model\ActiveRecord;
use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;


class APIController
{

    public static function index()
    {
        $servicios = Servicio::all();

        echo json_encode($servicios);
    }

    public static function guardar()
    {
       
        // almacena la cita y devuelve el id 
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // almacena los sercivios con el id de la cita 

        $idServicios = $_POST['servicios'];

           

        foreach($idServicios as $idservicio){

            $args = [
                'citaID' => (int)$id,
                'servicioID' =>(int) $idservicio
            ];

           
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }
       
            
      
       
        echo json_encode(['resultado' => $resultado]);
    }

public static function eliminar(){

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
   
    global $db;

   $consulta = "DELETE FROM citas_servicios WHERE citaID = {$db->escape_string($id)}";
    $db->query($consulta);

    $cita = Cita::find($id);
    $cita->eliminar();
    header('Location: ' . BASE_URL . $_SERVER['HTTP_REFERER']);


  }
}


}

