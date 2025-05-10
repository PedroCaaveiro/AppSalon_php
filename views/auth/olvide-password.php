<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Password</title>
</head>
<body>
    <h1 class="nombre-pagina">Recuperar Password</h1>
    <p class="descripcion-pagina">Escriba su email a continuación.</p>

    <?php 
include_once __DIR__. "/../templates/alertas.php";

?>
<form action="<?php echo BASE_URL?>/olvide" method="POST" class="formulario">

<div class="campo">
<label for="email">E-mail</label>
<input type="email" id="email" name="email" placeholder="Tu E-mail">

</div>
<input type="submit" class="boton" value="Enviar E-mail">

</form>
<div class="acciones">
<a href="<?php echo BASE_URL; ?>/">Iniciar Sesión</a>
    <a href="<?php echo BASE_URL; ?>/crear-cuenta">Crear Cuenta</a>
</div>
</body>
</html>