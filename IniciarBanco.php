<?php
$dbnome = "bd_soccer";
$conecao = mysqli_connect('localhost', 'root', '') or die("Erro de conexão");
$criadb = mysqli_query($conecao, "CREATE DATABASE if not exists $dbnome");
mysqli_select_db($conecao, $dbnome) or die("Erro ao selecionar o banco de dados");

$criacao1 = "CREATE TABLE IF NOT EXISTS `calendario` (
    `codigo` int(11) NOT NULL AUTO_INCREMENT,
    `data` varchar(50) DEFAULT NULL,
    `hora` varchar(50) NOT NULL,
    `local` varchar(50) NOT NULL,
    PRIMARY KEY (`codigo`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

$criacao2 = "CREATE TABLE IF NOT EXISTS `news` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `noticia` text NOT NULL,
    `titulo` text NOT NULL,
    `data_upload` datetime DEFAULT NULL,
    `data_criacao` datetime NOT NULL,
    `nome` varchar(100) NOT NULL,
    `path` varchar(45) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

$criacao3 = "CREATE TABLE IF NOT EXISTS `user` (
    `email` varchar(100) NOT NULL,
    `senha` varchar(100) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$resCria1 = mysqli_query($conecao, $criacao1);
if ($resCria1) {
    echo "Tabela $tdNome1 criada.<br>";
} else {
    echo "Erro ao criar tabela $tdNome1: " . mysqli_error($conecao) . "<br>";
}

$resCria2 = mysqli_query($conecao, $criacao2);
if ($resCria2) {
    echo "Tabela $tdNome2 criada.<br>";
} else {
    echo "Erro ao criar tabela $tdNome2: " . mysqli_error($conecao) . "<br>";
}

$resCria3 = mysqli_query($conecao, $criacao3);
if ($resCria3) {
    echo "Tabela $tdNome3 criada.<br>";
} else {
    echo "Erro ao criar tabela $tdNome3: " . mysqli_error($conecao) . "<br>";
}

$inserirCalendario = "INSERT INTO calendario (data, hora, local) VALUES
    ('2024-06-20', '14:00', 'Estádio A'),
    ('2024-06-22', '16:30', 'Estádio B'),
    ('2024-06-25', '15:45', 'Estádio C')";

$resInserirCalendario = mysqli_query($conecao, $inserirCalendario);
if ($resInserirCalendario) {
    echo "Dados inseridos na tabela calendario.<br>";
} else {
    echo "Erro ao inserir dados na tabela calendario: " . mysqli_error($conecao) . "<br>";
}

$inserirUser = "INSERT INTO user (email, senha) VALUES
    ('saramariasm17.sm@gmail.com', '123456'),
    ('adm@adm.com', '123456')";

$resInserirUser = mysqli_query($conecao, $inserirUser);
if ($resInserirUser) {
    echo "Dados inseridos na tabela user.<br>";
} else {
    echo "Erro ao inserir dados na tabela user: " . mysqli_error($conecao) . "<br>";
}

// Após criar a tabela news
$inserirNews = "INSERT INTO news (noticia, titulo, data_upload, data_criacao, nome, path) VALUES
    ('Em um jogo emocionante e acirrado, o Unidos do Jardim e o Adac F.C. se enfrentaram na tarde de hoje, no Estádio Municipal de Sapucaí-Mirim. A partida, válida pela competição, foi marcada por belos lances, muita disputa e um placar final de 1 X 0.
O Unidos do Jardim, que vinha de uma série de resultados positivos, entrou em campo confiante e buscando a vitória desde os primeiros minutos. Já o Adac F.C., que precisava pontuar para se manter na briga pela 5º, apostou em um jogo mais cauteloso, buscando explorar os contra-ataques.
O primeiro tempo foi bastante equilibrado, com as duas equipes criando boas chances de gol. O Unidos do Jardim teve a posse de bola durante a maior parte do tempo, mas não conseguiu furar a defesa adversária. Já o Adac F.C. apostou em jogadas rápidas e chegou ao gol em algumas oportunidades.
O segundo tempo começou ainda mais emocionante. O Unidos do Jardim pressionou forte em busca do gol da vitória, enquanto o Adac F.C. se defendia com garra e buscava aproveitar os espaços deixados pelo adversário.
Após diversas chances perdidas, o Unidos do Jardim finalmente conseguiu abrir o placar aos 10 minutos. O gol foi marcado por Jonas, após um belo chute de fora da área.
O Adac F.C. não se abateu com o gol sofrido e partiu para cima em busca do empate. A equipe pressionou o Unidos do Jardim nos últimos minutos da partida, mas não conseguiu furar a defesa adversária.
Com o placar final de 1 X 0, o Unidos do Jardim conquistou um importante resultado que o deixa na 5º. Já o Adac F.C. segue na luta pela 7, 
mas precisa pontuar nos próximos jogos se quiser alcançar seus objetivos..', ' Unidos do Jardim e Adac F.C. se enfrentam em partida emocionante', NOW(), NOW(), 'Autor 1', 'arquivosNews/666b1ceab1c81.jpg'),

       (' Em um jogo emocionante e com chances para os dois lados, o Unidos do Jardim Rezende e o E.C. Barabola empataram em 1 x 0 na tarde de hoje, no Estádio Municipal de Sapucaí-Mirim. A partida foi marcada por belos lances, muita disputa e um placar final que reflete o equilíbrio da partida.
O Unidos do Jardim Rezende, que vinha de uma derrota na última rodada, entrou em campo buscando se recuperar e conquistar um bom resultado. Já o E.C. Barabola, que buscava uma vaga na 3, também precisava da vitória para seguir em frente.
O primeiro tempo foi bastante equilibrado, com as duas equipes criando boas chances de gol. O Unidos do Jardim Rezende teve a posse de bola durante a maior parte do tempo, mas não conseguiu furar a defesa adversária. Já o E.C. Barabola apostou em jogadas rápidas e chegou ao gol em algumas oportunidades.
O segundo tempo começou ainda mais emocionante. O Unidos do Jardim Rezende pressionou forte em busca do gol da vitória, enquanto o E.C. Barabola se defendia com garra e buscava aproveitar os espaços deixados pelo adversário.
Após diversas chances perdidas, o Unidos do Jardim Rezende finalmente conseguiu abrir o placar aos 3 minutos. O gol foi marcado por Joaqui, após um belo chute de fora da área.
O E.C. Barabola não se abateu com o gol sofrido e partiu para cima em busca do empate. A equipe pressionou o Unidos do Jardim Rezende nos últimos minutos da partida, e conseguiu o gol de empate aos [minuto] minutos, com [nome do jogador].
Com o placar final de [placar], o Unidos do Jardim Rezende e o E.C. Barabola dividem pontos importantes na tabela de classificação da [competição].', 'Unidos do Jardim Rezende empata com E.C. Barabola em jogo emocionante sub 14', NOW(), NOW(), 'Autor 2', 'arquivosNews/6668d06122362.jpg'),

       ('O Unidos do Jardim Rezende conquistou uma importante vitória sobre o Estrela Dourada na tarde de hoje, no Estádio Municipal de Sapucaí-Mirim. A partida, válida pela Guarani, foi bastante acirrada e terminou com o placar de 1 X 0.
O Unidos do Jardim Rezende, que vinha de um empate na última rodada, entrou em campo pressionando o Estrela Dourada desde os primeiros minutos. Já o Estrela Dourada, que buscava se recuperar de uma série de resultados negativos, apostou em um jogo mais cauteloso, buscando explorar os contra-ataques.
O primeiro tempo foi bastante equilibrado, com as duas equipes criando boas chances de gol. O Unidos do Jardim Rezende teve a posse de bola durante a maior parte do tempo, mas não conseguiu furar a defesa adversária. Já o Estrela Dourada apostou em jogadas rápidas e chegou ao gol em algumas oportunidades.
O segundo tempo começou ainda mais emocionante. O Unidos do Jardim Rezende pressionou forte em busca do gol da vitória, enquanto o Estrela Dourada se defendia com garra e buscava aproveitar os espaços deixados pelo adversário.', 'Unidos do Jardim Rezende vence Estrela Dourada em partida acirrada', NOW(), NOW(), 'Autor 3', 'arquivosNews/6668d59c6a570.jpg')";

$resInserirNews = mysqli_query($conecao, $inserirNews);
if ($resInserirNews) {
    echo "Dados inseridos na tabela news.<br>";
} else {
    echo "Erro ao inserir dados na tabela news: " . mysqli_error($conecao) . "<br>";
}



mysqli_close($conecao);
?>
