<div class="barra">
    <p>Bienvenido: <?php echo $nombre ?? ''; ?> </p>
    <a  class ='boton' href="/logout">Finalizar Sesión</a>
</div>

<?php if($_SESSION['admin'] === true) { ?>


<div class="barra-servicios">
    <a href="/admin" class="boton">Ver Citas</a>
    <a href="/servicios" class="boton">Ver Servicios</a>
    <a href="/servicios/crear" class="boton">Nuevo Servicio</a>
</div>
    
<?php  } ?>