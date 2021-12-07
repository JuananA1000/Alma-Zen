let btnLibre = document.getElementsByClassName("btnLibre");
let btnOcupado = document.getElementsByClassName("btnOcupado");
let btnEstropeado = document.getElementsByClassName("btnEstropeado");
let fila = document.getElementById('fila')

function estadoLibre() {
    alert('Libre')
    console.log("Ahora esta herramienta está libre");
}

function estadoOcupado() {
    alert('En uso')
    console.log("Ahora esta herramienta está en uso");
}

function estadoEstropeado() {
    alert('Estropeado')
    console.log("Ahora esta herramienta está estropeada");
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