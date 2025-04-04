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

// funcion para revisar que el usuario se haya autenticado 

function revisarUsuarioAutenticado():void{

if (!isset($_SESSION['login'])) {
   header('Location: /');
}


}