   // Verifica se o usuário está logado pelo localStorage
   document.addEventListener('DOMContentLoaded', function() {
    var isLoggedIn = window.localStorage.getItem('isLoggedIn');
    if (!isLoggedIn || isLoggedIn !== 'true') {
        alert('Não possui liberação para acessar essa página');
        window.location.href = 'index.html';
    } else {
        // Exibe as informações do usuário no console
        var userEmail = window.localStorage.getItem('userEmail');
        var userName = window.localStorage.getItem('userName');
        console.log("Usuário logado:", userName, userEmail);

        // Verificar se os valores foram realmente recuperados
        if (!userName || !userEmail) {
            console.error("Falha ao recuperar as informações do usuário do localStorage.");
        } else {
            console.log("Recuperado com sucesso do localStorage:", userName, userEmail);
        }
    }
});
