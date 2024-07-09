document.addEventListener("DOMContentLoaded", function() {
    fetch('get_calendar_data.php')
        .then(response => response.json())
        .then(data => {
            const calendar = document.getElementById('calendar');
            data.forEach(event => {
                const gameDiv = document.createElement('div');
                gameDiv.classList.add('game');
                gameDiv.innerHTML = `
                    <div>
                        <div class='theams'>
                          
                            <span class='team'></span>
                        </div><br>
                        <div class='item-container'>
                           <div class="teams-container">
                                <p class='noticia-titulo'>${event.NameTime1}</p>
                                <h4>VS</h4>
                                <p class='noticia-titulo'>${event.NameTime2}</p>
                            </div>
                            <p class='noticia-data'>${event.data}</p>
                            <p class='noticia-titulo'>${event.hora}</p>
                            <p class='noticia-titulo'>${event.local}</p>
                        </div>
                    </div>
                `;

             

                calendar.appendChild(gameDiv);
            });
        })
        .catch(error => console.error('Error fetching calendar data:', error));
});



