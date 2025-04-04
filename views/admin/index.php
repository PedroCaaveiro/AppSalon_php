<h1 class="nombre-pagina">Vista de ADMINISTRACIÓN</h1>

<?php
include_once __DIR__ . '/../templates/barra.php';
?>

<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class='formulario' action="">

        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id='fecha' name='fecha'>
        </div>
    </form>
</div>

<div id="citas-admin">
    <ul class="citas">
        <?php

        foreach ($citas as $cita) {

            
        ?>
<li>
    <p>ID: <span><?php echo $cita->id;?></span></p>
    <p>Hora: <span><?php echo $cita->hora;?></span></p>
    <p>Cliente: <span><?php echo $cita->cliente;?></span></p>
    <p>Telefono: <span><?php echo $cita->telefono;?></span></p>
    <p>Email: <span><?php echo $cita->email;?></span></p>
    <p>Servicio: <span><?php echo $cita->servicio;?></span></p>
    <p>Precio: <span><?php echo $cita->precio;?></span></p>
    
</li>

        <?php }
        ?>
    </ul>

</div>