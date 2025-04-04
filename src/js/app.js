let paso = 1;
let pasoInicial = 1;
let pasoFinal = 3;

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []

}

document.addEventListener('DOMContentLoaded', iniciarApp);

function iniciarApp() {
    mostrarSeccion(); // Muestra la sección inicial
    tabs(); // Agrega eventos a los tabs
    botonesPagina();
    consultarAPI();//consulta api
    idCLiente();
    nombreCliente();//añade nombre cliente a cita
    seleccionarFecha()//añade la fecha cita 
    limitarFecha();//limita la fecha a dia actual
    seleccionarHora()//añade la hora

    mostrarResumen();

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

            if (paso === 3) {
                mostrarResumen();
            }


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
    mostrarResumen();
}


async function consultarAPI() {

    try {
        const url = 'http://127.0.0.1:3000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        //console.log(servicios);

        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }


}

function mostrarServicios(servicios) {
    servicios.forEach(servicio => {
        const { id, nombre, precio } = servicio;
        //console.log(precio);



        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P')
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `€${precio}`;

        // console.log(nombreServicio,precioServicio);

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function () {
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

function idCLiente() {

    cita.id = document.querySelector('#id').value;

}


function nombreCliente() {
    cita.nombre = document.getElementById('nombre').value;

}

function seleccionarFecha() {
    const inputFecha = document.getElementById('fecha');
    inputFecha.addEventListener('input', function (e) {


        if (!inputFecha) return;


        const dia = new Date(e.target.value).getUTCDay();

        if ([6, 0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fines de semana cerrado por Descanso del personal', 'error', '.formulario');


        } else {
            cita.fecha = e.target.value;
        }

        //console.log(dia);

        //console.log('selecionaste una fecha');

    });

}

function seleccionarHora() {
    const hora = document.getElementById('hora');
    hora.addEventListener('input', function (e) {

        //console.log(e.target.value);

        const horaCita = e.target.value;
        const horaSeparada = horaCita.split(":")[0];
        //console.log(horaSeparada);
        if (horaSeparada < 10 || horaSeparada > 18) {
            //console.log('hora no valida')
            e.target.value = "";
            mostrarAlerta('Hora no valida', 'error', '.formulario');
        } else {
            cita.hora = e.target.value;
            // console.log(cita);
        }

    })


}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
    // evitar se genere mas de una alerta
    const alertaprevia = document.querySelector('.alertas');

    if (alertaprevia) {
        alertaprevia.remove();
    }


    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alertas');
    alerta.classList.add(tipo);
    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if (desaparece) {
        setTimeout(() => {
            alerta.remove();

        }, 5000);

    }


}

function limitarFecha() {

    const fecha = document.getElementById('fecha');
    const hoy = new Date().toISOString().split('T')[0];
    fecha.min = hoy;

}

function mostrarResumen() {


    const resumen = document.querySelector('.contenido-resumen');

    // console.log(Object.values.cita);


    while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    if (Object.values(cita).includes('') || cita.servicios.length === 0) {

        mostrarAlerta('Faltan datos de Servicios,Fecha,Hora', 'error', '.contenido-resumen', false);
        return;
        //console.log('Hacen falta datos o servicios');   
    }
    // console.log('todo bien');

    const { nombre, fecha, hora, servicios } = cita;


    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicios';
    resumen.appendChild(headingServicios);

    servicios.forEach(servicio => {
        const { id, precio, nombre } = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');
        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> €${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    })


    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}.`;

    // modificar fecha formato español
    const fechaObjeto = new Date(fecha);
    const mes = fechaObjeto.getMonth();
    const dia = fechaObjeto.getDate();
    const year = fechaObjeto.getFullYear();


    const fechaUTC = new Date(Date.UTC(year, mes, dia));
    const diaLargo = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const fechaFormateada = fechaUTC.toLocaleDateString('es-ES', diaLargo);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}.`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} horas.`;

    // boton para crear citas 

    const botonReserva = document.createElement('BUTTON');
    botonReserva.classList.add('boton');
    botonReserva.textContent = 'Reservar Cita';
    botonReserva.onclick = reservaCita;


    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
    resumen.appendChild(botonReserva);
}

async function reservaCita() {

    const { nombre, fecha, hora, servicios, id } = cita;

    const idServicios = servicios.map(servicio => servicio.id);


    const datos = new FormData();
    datos.append('usuarioID', id);
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    idServicios.forEach(idServicio => {
        datos.append('servicios[]', idServicio);  // Envia cada servicio como un parámetro por separado
    });


    try {

        const url = 'http://127.0.0.1:3000/api/citas';

        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });
        //console.log('estado de la respuesta:', respuesta.status);

        if (!respuesta.ok) {
            throw new Error(`Error en la solicitud: ${respuesta.statusText}`);
        }

        const resultado = await respuesta.json();



        if (resultado.resultado) {


            Swal.fire({
                icon: "success",
                title: "Cita Creada",
                text: "Tu cita fue creada correctamente",
                button: 'OK'

            }).then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            });
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Hubo un error al guardar la cita!",

        });

        //  console.error('error en reservaCita:', error);

    }



    //console.log('Reservando cita...')
}