<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 class="nombre-pagina">Olvide Password</h1>
    <p class="descripcion-pagina">Reestablezca su Password escribiendo su email a continuación.</p>

<form action="/olvide" method="POST" class="formulario">

<div class="campo">
<label for="email">E-mail</label>
<input type="email" id="email" name="email" placeholder="Tu E-mail">

</div>
<input type="submit" class="boton" value="Enviar E-mail">

</form>
<div class="acciones">
    <a href="/">Inicio Sesión</a>
    <a href="/crear-cuenta">Crear Cuenta</a>
</div>
</body>
</html>