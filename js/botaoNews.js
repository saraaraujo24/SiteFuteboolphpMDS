
// JavaScript para manipular o modal
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];
var modalImg = document.getElementById("modal-img");
var modalData = document.getElementById("modal-data");
var modalTitulo = document.getElementById("modal-titulo");
var modalNoticia = document.getElementById("modal-noticia");

var readButtons = document.getElementsByClassName("ler-mais");

for (var i = 0; i < readButtons.length; i++) {
    readButtons[i].onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.getAttribute("data-path");
        modalData.textContent = this.getAttribute("data-data");
        modalTitulo.textContent = this.getAttribute("data-titulo");
        modalNoticia.textContent = this.getAttribute("data-noticia");
    }
}

span.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
