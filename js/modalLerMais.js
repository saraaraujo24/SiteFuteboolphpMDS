// Obter o modal
var modal = document.getElementById("myModal");
var modal1 = document.getElementById("myModal1");
var modal2 = document.getElementById("myModal2");
var modal3 = document.getElementById("myModal3");
// Obter o botão de fechar
var span = document.getElementsByClassName("close")[0];
var span = document.getElementsByClassName("close1")[0];
var span = document.getElementsByClassName("close2")[0];
var span = document.getElementsByClassName("close3")[0];
// Obter os elementos de conteúdo do modal
var modalImg = document.getElementById("modal-img");
var modalData = document.getElementById("modal-data");
var modalTitulo = document.getElementById("modal-titulo");
var modalNoticia = document.getElementById("modal-noticia");

// Obter todos os botões "Ler Mais"
var readButtons = document.getElementsByClassName("ler-mais");
var readButtons1 = document.getElementsByClassName("ler-mais1");
var readButtons2 = document.getElementsByClassName("ler-mais2");
var readButtons3 = document.getElementsByClassName("ler-mais3");
// Adicionar evento de clique para cada botão "Ler Mais"
for (var i = 0; i < readButtons.length; i++) {
    readButtons[i].onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.getAttribute("data-path");
        modalData.textContent = this.getAttribute("data-data");
        modalTitulo.textContent = this.getAttribute("data-titulo");
        modalNoticia.textContent = this.getAttribute("data-noticia");
    }
}

for (var i = 0; i < readButtons1.length; i++) {
    readButtons1[i].onclick = function() {
        modal1.style.display = "block";
    }
}

for (var i = 0; i < readButtons2.length; i++) {
    readButtons2[i].onclick = function() {
        modal2.style.display = "block";
    }
}

for (var i = 0; i < readButtons3.length; i++) {
    readButtons3[i].onclick = function() {
        modal3.style.display = "block";
    }
}
// Fechar o modal quando o usuário clicar no botão de fechar
span.onclick = function() {
    modal.style.display = "none";
    modal1.style.display = "none";
    modal2.style.display = "none";
    modal3.style.display = "none";
}

// Fechar o modal quando o usuário clicar fora do modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
    if (event.target == modal3) {
        modal3.style.display = "none";
    }
}


