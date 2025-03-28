let paso = 1;
let pasoInicial = 1;
let pasoFinal =3;

document.addEventListener('DOMContentLoaded', iniciarApp);

function iniciarApp() {
    mostrarSeccion(); // Muestra la sección inicial
    tabs(); // Agrega eventos a los tabs
    botonesPagina();
    consultarAPI();
    
    // Agrega los eventos a los botones
    document.getElementById('anterior').addEventListener('click', () => cambiarPaso('anterior'));
    document.getElementById('siguiente').addEventListener('click', () => cambiarPaso('siguiente'));
    
}

function mostrarSeccion() {
    // Ocultar sección y remover clase actual del tab anterior
    document.querySelector('.mostrar')?.classList.remove('mostrar');
    document.querySelector('.actual')?.classList.remove('actual');

    // Mostrar nueva sección y resaltar tab correspondiente
    document.querySelector(`#paso-${paso}`)?.classList.add('mostrar');
    document.querySelector(`[data-paso="${paso}"]`)?.classList.add('actual');
}

function tabs() {
    document.querySelector('.tabs')?.addEventListener('click', function (e) {
        if (e.target.tagName === 'BUTTON') {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();

            botonesPagina();
        }
    });
}

function botonesPagina() {
    const paginaAnterior = document.getElementById('anterior');
    const paginaSiguiente = document.getElementById('siguiente');

    paginaAnterior.classList.toggle('ocultar', paso === 1);// agrega la clase ocyltar
    paginaSiguiente.classList.toggle('ocultar', paso === 3);// elimina la clase ocultar

    mostrarSeccion();
}


function cambiarPaso(direccion) {
    if ((direccion === 'anterior' && paso <= pasoInicial) || 
        (direccion === 'siguiente' && paso >= pasoFinal)) {
        return; 
    }

    paso += (direccion === 'anterior' ? -1 : 1);
    botonesPagina();
}


 async function consultarAPI(){

        try {
            const url = 'http://127.0.0.1:3000/api/servicios';
            const resultado =  await fetch(url);
           const servicios = await resultado.json();
           // console.log(servicios);

           mostrarServicios(servicios);
        } catch (error) {
            console.log(error);
        }


}

function mostrarServicios(servicios){
servicios.forEach(servicio => {
    const {id,nombre,precio} = servicio;
    //console.log(precio);
   


    const nombreServicio = document.createElement('P');
    nombreServicio.classList.add('nombre-servicio');
    nombreServicio.textContent = nombre;

    const precioServicio= document.createElement('P')
    precioServicio.classList.add('precio-servicio');
    precioServicio.textContent =  `€${precio}`;   

   // console.log(nombreServicio,precioServicio);

    const servicioDiv = document.createElement('DIV');
    servicioDiv.classList.add('servicio');
    servicioDiv.dataset.idServicio = id;
    servicioDiv.appendChild(nombreServicio);
    servicioDiv.appendChild(precioServicio);

    document.getElementById('servicios').appendChild(servicioDiv);

    //console.log(servicioDiv);

});


}