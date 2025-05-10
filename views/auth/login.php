<h1 class="nombre-pagina">BarberApp</h1>
<p class="descripcion-pagina">Login</p>

<?php
include_once __DIR__. "/../templates/alertas.php";
?>

<form action="<?php echo BASE_URL; ?>" class="formulario" method="POST">


<div class="campo">
    <label for="email">Email</label>
    <input type="email" id="email" placeholder="Tu Email" name="email">
</div>

<div class="campo">
    <label for="password">Password</label>
    <input type="password" id="password" placeholder="Tu Password" name="password">
</div>

<input type="submit" class="boton" value="Login">

</form>

<div class="acciones">
<a href="<?php echo BASE_URL; ?>/crear-cuenta">Crear Cuenta</a>
<a href="<?php echo BASE_URL; ?>/olvide">¿Olvidaste tu Password?</a>

</div>