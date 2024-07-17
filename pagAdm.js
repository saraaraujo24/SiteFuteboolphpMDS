fetch('./CadastrarUser/api.php')
.then(response => response.json())
.then(data => {
    const usersList = document.getElementById('usersList');

    data.forEach(user => {
        const userDiv = document.createElement('div');
        userDiv.innerHTML = `
            <p class='noticia-titulo'>Nome: ${user.nome}</p>
            <p class='noticia-data'>Email: ${user.email}</p>
            <p class='noticia-data'>Senha: ${user.senha}</p>
            <a class='BotaoEditar' href='./CadastrarUser/forEdite.php?id=${user.id}'>Editar</a>
            <a class='btnRemo' href="./CadastrarUser/excluir.php?id=${user.id}" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
        `;
        usersList.appendChild(userDiv);
    });
})
.catch(error => console.error('Erro ao carregar usuários:', error));