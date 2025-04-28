<div class="barra">
    <p>Bienvenido: <?php echo $nombre ?? ''; ?> </p>
    <a class="boton" href="<?php echo BASE_URL . 'logout'; ?>">Finalizar Sesión</a>
</div>

<?php if($_SESSION['admin'] === true) { ?>


<div class="barra-servicios">
<a href="<?php echo BASE_URL . '/admin'; ?>" class="boton">Ver Citas</a>
<a href="<?php echo BASE_URL . '/servicios'; ?>" class="boton">Ver Servicios</a>
<a href="<?php echo BASE_URL . '/servicios/crear'; ?>" class="boton">Nuevo Servicio</a>

</div>
    
<?php  } ?>