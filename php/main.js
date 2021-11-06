let btnLibre = document.getElementById("btnLibre");
let btnEnUso = document.getElementById("btnEnUso");
let btnReparar = document.getElementById("btnReparar");

btnLibre.addEventListener("click", estadoLibre);
btnEnUso.addEventListener("click", estadoEnUso);
btnReparar.addEventListener("click", estadoReparar);

function estadoLibre() {
    console.log("libre");
}

function estadoEnUso() {
    console.log("en uso");
}

function estadoReparar() {
    console.log("estropeado. en reparación");
}
