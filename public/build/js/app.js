let paso = 1;
let pasoInicial = 1;
let pasoFinal =3;

document.addEventListener('DOMContentLoaded', iniciarApp);

function iniciarApp() {
    mostrarSeccion(); // Muestra la sección inicial
    tabs(); // Agrega eventos a los tabs
    botonesPagina();
    
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

