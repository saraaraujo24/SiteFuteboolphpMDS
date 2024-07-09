document.addEventListener("DOMContentLoaded", function() {
    fetch('get_news_data.php')
    .then(response => response.json())
    .then(data => {
        const newsContainer = document.getElementById('news-container');
        data.forEach(news => {
            const newsCard = document.createElement('div');
            newsCard.classList.add('card1');
            newsCard.innerHTML = `
                <div class='icone'>
                    <img src='${news.path}' alt=''>
                </div>
                <p class='noticia-data'>${news.DataFormatada} </p><p>${news.HoraFormatada}</p>
                <p class='noticia-titulo'>${news.titulo}</p>
                <button class='ler-mais' data-path='${news.path}' data-data='${news.DataFormatada}' 
                   data-hora='${news.HoraFormatada}' data-titulo='${news.titulo}' 
                   data-noticia='${news.noticia}'
                >Ler Mais</button>
            `;
            newsContainer.appendChild(newsCard);
        });

            // Adiciona event listeners para botões "Ler Mais"
            const readButtons = document.querySelectorAll('.ler-mais');
            readButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('modal-img').src = this.dataset.path;
                    document.getElementById('modal-data').textContent = this.dataset.data;
                    document.getElementById('modal-titulo').textContent = this.dataset.titulo;
                    document.getElementById('modal-noticia').textContent = this.dataset.noticia;
                    document.getElementById('myModal').style.display = 'flex';
                });
            });
        })
        .catch(error => console.error('Error fetching news:', error));

    // JavaScript para manipular o modal
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});