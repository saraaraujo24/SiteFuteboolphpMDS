document.addEventListener('DOMContentLoaded', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'getCalendario.php', true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            var response = JSON.parse(xhr.responseText);
            var jogos = response.jogos; // Extrai a parte dos jogos do JSON

            var container = document.getElementById('jogos-container');
            jogos.forEach(function(calendario) {
                var divGame = document.createElement('div');
                divGame.classList.add('game');

                var divItemContainer = document.createElement('div');
                divItemContainer.classList.add('item-container');

                // Exibição das imagens dos times
                var timeImagesContainer = document.createElement('div');
                timeImagesContainer.classList.add('time-images');

                var time1Image = document.createElement('img');
                time1Image.src = calendario['time1_img'];
                time1Image.width = 100;
                time1Image.height = 100;
                timeImagesContainer.appendChild(time1Image);

                // Adiciona o VS entre as imagens
                var vsElement = document.createElement('span');
                vsElement.textContent = 'VS';
                vsElement.style.fontSize = '1.2em'; // Tamanho da fonte
                vsElement.style.color = '#333'; // Cor do texto
                vsElement.style.margin = '10px'; // Margem para separação dos elementos (top e bottom 0, left e right 10px)
                vsElement.style.marginTop = '60px'; // Ajuste de margem top negativa para posicionar acima
                timeImagesContainer.appendChild(vsElement);

                calendario['time2_imgs'].forEach(function(time2_img) {
                    var time2Image = document.createElement('img');
                    time2Image.src = time2_img;
                    time2Image.width = 100;
                    time2Image.height = 100;
                    timeImagesContainer.appendChild(time2Image);
                });

                divItemContainer.appendChild(timeImagesContainer);

                // Exibição das informações (data, hora e local)
                var infoContainer = document.createElement('div');
                infoContainer.classList.add('info-container');

                var dataElement = document.createElement('p');
                dataElement.classList.add('noticia-data');
                dataElement.textContent = calendario['data'];
                infoContainer.appendChild(dataElement);

                var horaElement = document.createElement('p');
                horaElement.classList.add('noticia-titulo');
                horaElement.textContent = calendario['hora'];
                infoContainer.appendChild(horaElement);

                var localElement = document.createElement('p');
                localElement.classList.add('noticia-titulo');
                localElement.textContent = calendario['local'];
                infoContainer.appendChild(localElement);

                divItemContainer.appendChild(infoContainer);

                divGame.appendChild(divItemContainer);
                container.appendChild(divGame);
            });
        } else {
            console.error('Erro ao buscar dados do servidor.');
        }
    };
    xhr.onerror = function() {
        console.error('Erro de conexão.');
    };
    xhr.send();
});
