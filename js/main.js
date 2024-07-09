
// Selecionar todos os botões "Ler Mais"
const readMoreButtons = document.querySelectorAll('.ler-mais');

// Iterar pelos botões e adicionar evento de click
for (const button of readMoreButtons) {
  button.addEventListener('click', () => {
    // Selecionar o card pai do botão
    const card = button.parentElement;

    // Toggle a classe "active" no card
    card.classList.toggle('active');

    // Alterar texto do botão baseado na classe "active"
    if (card.classList.contains('active')) {
      button.textContent = 'Ler Menos';
    } else {
      button.textContent = 'Ler Mais';
    }
  });

  
}

let ul = document.querySelector('nav .ul');

function openMenu(){
    ul.classList.add('open');
}

function closeMenu(){
    ul.classList.remove('open');
}


