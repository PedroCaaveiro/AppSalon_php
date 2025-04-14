document.addEventListener('DOMContentLoaded',function(){
iniciarAPP();

})

function iniciarAPP(){

    buscarPorfecha();
}


function buscarPorfecha(){
const fechaInput = document.querySelector('#fecha');
fechaInput.addEventListener('input',function(e){
    const fechaSeleccionada = e.target.value;
    //console.log(fechaSeleccionada);

    window.location = `?fecha=${fechaSeleccionada}`;
})

}