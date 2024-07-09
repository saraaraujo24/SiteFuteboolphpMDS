const formulario = document.getElementById('#UserRate');

formulario.addEventListener('submit', function(e) {
  e.preventDefault();

  const dados = new FormData(formulario); // Coleta os dados do formulário

  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'https://docs.google.com/forms/u/0/d/e/1FAIpQLSeA_dzFg5C3slIpbdXEvkllz0BJbQ59UEgdZr-MkfLT6lXH8g/formResponse', true); // Altere 'https://www.dicio.com.br/exemplo/' para a URL de destino
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function() {
    if (xhr.status === 200) {
      // Exibe mensagem de sucesso (opcional)
      window.location.href = 'contato.html'; // Redireciona para a página desejada
    } else {
      // Exibe mensagem de erro
    }
  };

  xhr.send(dados);
});
