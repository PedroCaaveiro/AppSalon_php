<?php

function obtener_servicios(){

try {
    
    // importar credenciales
    require 'database.php';

    // consulta sql 
    $sql = "SELECT * FROM servicios;";

    // realizar consulta
$consulta = mysqli_query($db,$sql);

    // acceder a los resultados
    echo "<pre>";
    var_dump(mysqli_fetch_assoc($consulta));
    echo "<pre>";
    // cerrar conexion

    $resultado = mysqli_close($db);


} catch (\Throwable $th) {
    var_dump($th);
}

}

obtener_servicios();

?>