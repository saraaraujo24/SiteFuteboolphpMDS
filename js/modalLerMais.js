// Obter o modal
var modal = document.getElementById("myModal");

// Obter o botão de fechar
var span = document.getElementsByClassName("close")[0];

// Obter os elementos de conteúdo do modal
var modalImg = document.getElementById("modal-img");
var modalData = document.getElementById("modal-data");
var modalTitulo = document.getElementById("modal-titulo");
var modalNoticia = document.getElementById("modal-noticia");

// Obter todos os botões "Ler Mais"
var readButtons = document.getElementsByClassName("ler-mais");

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

// Fechar o modal quando o usuário clicar no botão de fechar
span.onclick = function() {
    modal.style.display = "none";
}

// Fechar o modal quando o usuário clicar fora do modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
