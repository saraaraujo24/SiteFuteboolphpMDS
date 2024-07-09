function carregarJogos() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'lista_jogos.php', true);

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            var data = JSON.parse(xhr.responseText);
            document.getElementById('totalJogos').textContent = data.total;
            var tbody = document.getElementById('corpoTabela');
            tbody.innerHTML = '';

            data.jogos.forEach(function(jogo) {
                var tr = document.createElement('tr');
                var time2Imgs = '';

                // Adiciona imagens do Time 2
                jogo.time2_imgs.forEach(function(img) {
                    time2Imgs += `<img src="${img}" alt="Imagem Time 2" width="100"> `;
                });

                tr.innerHTML = `
              
                    <td data-label="Data"><p class='InfoCalen'>${jogo.data}</p></td>
                    <td  data-label="Hora"><p class='InfoCalen'>${jogo.hora}</p></td>
                    <td  data-label="Local"><p class='InfoCalen'>${jogo.local}</p></td>
                    <td data-label="Imagem Time 1"><center><img src="${jogo.time1_img}" alt="Imagem Time 1" width="100" ><center></td>
                    <td data-label="Imagem Time 2"><center>${time2Imgs}</center></td>
                    <td data-label="Imagem Time 1"><a class='BotaoEditar' href="formEdite.php?codigo=${jogo.codigo}">Editar</a></td>
                    <td data-label="Remover"><a class='BotaoRemo' href="excluir.php?codigo=${jogo.codigo}" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a></td>
               
                    `;
                tbody.appendChild(tr);
            });
        } else {
            console.error('Erro ao carregar os jogos. Status:', xhr.status);
        }
    };

    xhr.onerror = function() {
        console.error('Erro de conexão.');
    };

    xhr.send();
}

// Carregar jogos ao carregar a página
window.onload = function() {
    carregarJogos();
};

// Exemplo de função para fechar o menu (não fornecido no código original)
function closeMenu() {
    // Implemente a lógica desejada para fechar o menu
}

// Exemplo de função para abrir o menu (não fornecido no código original)
function openMenu() {
    // Implemente a lógica desejada para abrir o menu
}