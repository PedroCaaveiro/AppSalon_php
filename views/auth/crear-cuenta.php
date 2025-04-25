<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
</head>
<body>
    <h1 class="nombre-pagina">Crear Cuenta</h1>
    <p class="descripcion-pagina">Rellene el siguiente formulario para crear una cuenta</p>

<?php 
include_once __DIR__. "/../templates/alertas.php";

?>
    <form class="formulario" method="POST" action="<?php echo BASE_URL?>/crear-cuenta">

    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="<?php echo s($usuario->nombre);?>"></div>

    <div class="campo">
        <label for="nombre">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" value="<?php echo s($usuario->apellido);?>">
    </div>

    <div class="campo">
        <label for="nombre">telefono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Tu telefono" value="<?php echo s($usuario->telefono);?>">
    </div>

    <div class="campo">
        <label for="nombre">Email</label>
        <input type="email" id="Email" name="email" placeholder="Tu E-mail" value="<?php echo s($usuario->email);?>">
    </div>

    <div class="campo">
        <label for="nombre">Password</label>
        <input type="password" id="Password" name="password" placeholder="Tu Password">
    </div>

        <input type="submit" value="Crear Cuenta" class="boton">

    </form>
    <div class="acciones">
    <a href="<?php echo BASE_URL; ?>/">Iniciar Sesión</a>
    <a href="<?php echo BASE_URL; ?>/olvide">¿Olvidaste tu Password?</a>

</div>
</body>
</html>