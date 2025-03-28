let paso = 1;
let pasoInicial = 1;
let pasoFinal =3;

const cita = {
nombre:'',
fecha:'',
hora:'',
servicios:[]

}

document.addEventListener('DOMContentLoaded', iniciarApp);

function iniciarApp() {
    mostrarSeccion(); // Muestra la sección inicial
    tabs(); // Agrega eventos a los tabs
    botonesPagina();
    consultarAPI();//consulta api
    nombreCliente();//añade nombre cliente a cita
    seleccionarFecha()//añade la fecha cita 
    limitarFecha();

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
    servicioDiv.onclick = function(){
        seleccionarServicio(servicio);
    }

    servicioDiv.appendChild(nombreServicio);
    servicioDiv.appendChild(precioServicio);

    document.getElementById('servicios').appendChild(servicioDiv);

    //console.log(servicioDiv);

});


}
function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;

    // Verifico si el servicio ya está en la cita
    const existe = servicios.some(s => s.id === id);

    if (existe) {
        // Si ya está seleccionado, lo elimino
        cita.servicios = servicios.filter(s => s.id !== id);
    } else {
        // Si no está seleccionado, lo agrego
        cita.servicios = [...servicios, servicio];
    }

  
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
    
    if (divServicio) {
        divServicio.classList.toggle('seleccionado');  // Alterna la clase
    }

   // console.log(cita);
}


function nombreCliente(){
cita.nombre = document.getElementById('nombre').value;

}

function seleccionarFecha() {
    const inputFecha = document.getElementById('fecha');
    inputFecha.addEventListener('input', function (e) {


        if (!inputFecha) return;


        const dia = new Date(e.target.value).getUTCDay();

        if ([6, 0].includes(dia)) {
            e.target.value = '';
           mostrarAlerta('Fines de semana cerrado por Descanso del personal','error');


        } else {
            cita.fecha = e.target.value;
        }

        //console.log(dia);

        //console.log('selecionaste una fecha');

    });

}

function mostrarAlerta(mensaje,tipo){
// evitar se generen mas de una alerta
const alertaprevia = document.querySelector('.alertas');

if (alertaprevia) return;


const alerta = document.createElement('DIV');
alerta.textContent = mensaje;
alerta.classList.add('alertas');
alerta.classList.add(tipo);
const formulario = document.querySelector('#paso-2 p');
formulario.appendChild(alerta);



setTimeout(() =>{
alerta.remove();

},5000);

}

function limitarFecha(){

const fecha = document.getElementById('fecha');
const hoy = new Date().toISOString().split('T')[0];
fecha.min = hoy;

}