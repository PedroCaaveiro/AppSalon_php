<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(String $actual,String $proximo): bool{

    if ($actual !== $proximo) {
        return true;
    }
return false;
}
// funcion para revisar que el usuario se haya autenticado 

function revisarUsuarioAutenticado():void{

if (!isset($_SESSION['login'])) {
   header('Location: /');
}

}


    function isAdmin():void{

        // Si no está logueado o no es admin, redirigir
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
        header('Location: /');
        exit;
    }
    }



