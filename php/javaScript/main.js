let btnLibre = document.getElementsByClassName("btnLibre");
let btnOcupado = document.getElementsByClassName("btnOcupado");
let btnEstropeado = document.getElementsByClassName("btnEstropeado");

function estadoLibre() {
    alert('Herramienta libre.')
    console.log("Estado Libre");
}

function estadoOcupado() {
    alert('Herramienta en uso. Escoja otra')
    console.log("Estado Ocupado");
}

function estadoEstropeado() {  
    alert('Herramienta fuera de servicio o en reparación. Escoja otra')
    console.log("Estado estropeado");
}

for (let i = 0; i < btnLibre.length; i++) {
    btnLibre[i].addEventListener("click", estadoLibre, false);
}

for (let i = 0; i < btnOcupado.length; i++) {
    btnOcupado[i].addEventListener("click", estadoOcupado, false);
}

for (let i = 0; i < btnEstropeado.length; i++) {
    btnEstropeado[i].addEventListener("click", estadoEstropeado, false);
}
