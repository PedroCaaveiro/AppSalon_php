<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php 
include_once __DIR__. "/../templates/alertas.php";

?>

<?php if ($error): ?>
    <p class="alerta error">El token no es válido o ha expirado.</p>
<?php return; endif; ?>


<form action="" class="formulario" method="POST">

<div class="campo">

<label for="password">Password</label>
<input type="password" name="password" id="" placeholder="Tu nuevo Password">
</div>
<input type="submit" value="Guardar Nuevo Password" class="boton">


</form>

<div class="acciones">
    <a href="/">Ya tienes cuenta? Iniciar Sesión</a>
    <a href="/crear-cuena">Aun no tienes cuenta? Crear Cuenta</a>
</div>