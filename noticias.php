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

    <title>Sobre Unidos Jardin Rezende</title>
    <?php
    include 'global.php';
    include("./Config/conexao.php");
    $conexao = mysqli_connect("localhost", "root", "", "bd_soccer");
    $sql_read = "SELECT * FROM News";


    $sql_query = $mysqli->query("SELECT id, noticia, titulo, nome, path, DATE_FORMAT(data_criacao,'%d/%m/%Y') AS DataFormatada FROM News ORDER BY data_criacao DESC") or die($mysqli->error);

    ?>


    <style>
        .NewsPag {
            display: flex;
            /* Make the body a flex container */
            min-height: 100vh;
            /* Set minimum height for viewport */
            flex-direction: column;
            /* Arrange content vertically */
            align-items: center;
            justify-content: center;

        }

        .NCon {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            /* Ajustar o espaço entre os containers */
            justify-content: center;
            /* Centralizar os containers */
        }


       

        .card1 {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 40px;
            padding: 15px;
            width:90%;
            /* Definir uma largura fixa para cada card */
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .icone {
            display: flex;
            align-items: center;
            
        }

        .icone img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 10px;
        }

        .noticia-data,
        .noticia-titulo {
            margin: 10px 0;
            font-weight: bold;
            font-size: 120%;
            margin-left: 10%;
        }

        .ler-mais {
            background-color: #7c559b;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .ler-mais:hover {
            background-color: #e8daef;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            /* Centraliza horizontalmente */
            align-items: center;
            /* Centraliza verticalmente */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 1000px;
            position: relative;
            text-align: center;
            border-radius: 8px;
            overflow: hidden;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            cursor: pointer;
        }

        /* Estilos gerais para dispositivos pequenos */

        /* CSS para dispositivos com largura entre 468px e 976px */
        @media only screen and (min-width: 268px) and (max-width: 700px) {
            .NCon {
                display: flex;
                flex-direction: column;
                align-items: center;
                /* Para centralizar os cartões no contêiner */
            }

            .card1 {
                width: 80%;
                margin-bottom: 20px;
                /* Espaçamento entre os cartões */
            }

            .icone {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;  
            }
            .noticia-data,
            .noticia-titulo {
                font-weight: bold;
                font-size: 120%;
                text-align: center;
            }
            .icone img {
            width: 80%;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 10px;
            align-items: center;
            justify-content: center;
        }
           
        }
 
    </style>
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
                        <img id="modal-img" src="" alt="" width="50%" height="50%">
                        <p id="modal-data"></p>
                        <p class="noticia-titulo" id="modal-titulo"></p>
                        <p id="modal-noticia"></p>
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
