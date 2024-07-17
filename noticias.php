<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pagNoticia.css">
    <title>Sobre Unidos Jardin Rezende</title>
    <?php
    include 'global.php';
    include("./Config/conexao.php");
    $conexao = mysqli_connect("localhost", "root", "", "bd_soccer");
    $sql_read = "SELECT * FROM News";


    $sql_query = $mysqli->query("SELECT id, noticia, titulo, nome, path, DATE_FORMAT(data_criacao,'%d/%m/%Y') AS DataFormatada FROM News ORDER BY data_criacao DESC") or die($mysqli->error);

    ?>
</head>

<body>
    <nav class="navbar">
        <!-- LOGO -->
        <div class="logo">
            <img src="img/LOGO VERTICAL3.png" width="100" height="150">
        </div>
        <!-- NAVEGAÇÃO MENU -->
        <div class="menu-btn">
            <i class="fa fa-bars fa-2x" onclick="menuShow()"></i>
        </div>
        <ul class="estiloUl">
            <li><a href="index.html">Home</a></li>
            <li><a href="historia.html">História</a></li>
            <li><a href="./CalendarioInse/calendario.html">Jogos</a></li>
            <li><a href="midia.html">Galeria</a></li>
            <li><a href="noticias.php">Notícias</a></li>
            <li><a href="contato.html">Contato</a></li>
            <li><a href="./login2/index.html">Login</a></li>
        </ul>
    </nav>
    <section class='NewsPag'>
        <div class="noticias">
            <div class='NCon'>
                <section id="historia-membros">
                    <div class='centralizadoMembros1'>
                        <?php
                        while ($News = $sql_query->fetch_assoc()) {
                            echo "<div class='card1'>";
                            echo "<div class='icone'>";
                            echo "<img src='" . $News['path'] . "' alt=''>";
                            echo "<div>";
                            echo "<p class='noticia-titulo'>" . $News['titulo'] . "</p>";
                            echo "<p class='noticia-data'>" . $News['DataFormatada'] . "</p>";
                            echo "</div>";
                            echo "</div>";
                            echo "<button class='ler-mais' data-path='" . $News['path'] . "' data-data='" . $News['DataFormatada'] . "' data-titulo='" . $News['titulo'] . "' data-noticia='" . $News['noticia'] . "'>Ler Mais</button>";
                            echo "</div>";
                        }
                        ?>

                    </div>
                </section>
            </div>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="content1">
                        <img id="modal-img" src="" alt="" width="30%" height="30%">
                        <p id="modal-data"></p>
                        <p class="noticia-titulo" id="modal-titulo"></p>
                        <p  class="modal-noticia" id="modal-noticia"></p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script src='./js/botaoNews.js'>

    </script>
    <footer class="footer">
        <div class="main-content">
            <div class="links">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
            </div>
            <div>
                <img class="imagi" src="img/Coruja.png" width="150" height="150">
            </div>
            <p>©Copyright</p>
            <p>Todos os direitos reservados</p>
        </div>
    </footer>
    <script src="js/menu.js"></script>
</body>

</html>
