<!DOCTYPE html>
<html lang="pt-BR">
<?php

include("./Config/conexao.php");
$conexao = mysqli_connect("localhost", "root", "", "bd_soccer");

// Function to handle file upload with validation
function enviarArquivo($error, $size, $name, $tmp_name) {
  include("./Config/conexao.php");
  $titulo = mysqli_real_escape_string($mysqli, $_POST["titulo"]);
  $noticia = mysqli_real_escape_string($mysqli, $_POST["noticias"]);

  if ($error) 
    die("Falha ao enviar arquivo");

  if ($size > 2097152) 
    die("Arquivo muito grande! ! Max:2MB");

  $pasta = "arquivosNews/";
  $nomeDoArquivo = $name;
  $novoNomeDoArquivo = uniqid();
  $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

  if ($extensao != "jpg" && $extensao != 'png') 
    die("Tipo de arquivo não aceito");
  
  $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
  $deu_certo = move_uploaded_file($tmp_name, $path);

  /*
 SELECT id, noticia, titulo, nome,  DATE_FORMAT(data_criacao,'%d/%m/%Y') AS DataFormatada FROM arquivo
ORDER BY data_criacao desc;

      TIME_FORMAT(CURTIME(), '%h - %i - %s') AS HORA_FORMATADA;
  */
  

    if ($mysqli) {
      $titulo = mysqli_real_escape_string($mysqli, $_POST["titulo"]);
      $noticia = mysqli_real_escape_string($mysqli, $_POST["noticias"]);
      $current_date_time = date('Y-m-d H:i:s'); // Data e hora atuais

      $sql = "INSERT INTO News (`nome`, `path`, `noticia`, `titulo`, `data_criacao`) 
              VALUES ('$nomeDoArquivo', '$path', '$noticia', '$titulo', NOW())";

      if ($mysqli->query($sql) === TRUE) {
          //Redirect para a mesma página após a inserção bem sucedida
          header("Location: " . $_SERVER['REQUEST_URI']);
          exit;
      } else {
          echo "<p>Erro ao inserir arquivo no banco de dados: " . $mysqli->error . "</p>";
      }
  } else {
      die("Failed to connect to MySQL: " . mysqli_connect_error());
  }

}

if (isset($_FILES['arquivos'])) {
  $arquivos = $_FILES['arquivos'];
  $tudo_certo = true;
  foreach ($arquivos['name'] as $index => $arq) { 
    $tudo_certo = enviarArquivo( $arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos["tmp_name"][$index]);
    if(!$deu_certo)
      $tudo_certo = false;
  }
  if($tudo_certo)
    echo "<p>Todos os arquivos foram enviados com sucesso!</p>";
  else
    echo "<p>Falha!</p>";
}


$sql_query = $mysqli->query("SELECT id, noticia, titulo, nome, path, 
                             DATE_FORMAT(data_criacao,'%d/%m/%Y') AS DataFormatada, 
                             TIME_FORMAT(data_criacao,'%H:%i:%s') AS HoraFormatada 
                             FROM News 
                             ORDER BY data_criacao DESC") or die($mysqli->error);

function buscarImagem($id) {
  $mysqli = conectarBanco();

  if ($mysqli) {
      $sql = "SELECT imagem FROM imagens WHERE id = $id";
      $result = $mysqli->query($sql);

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $imagem = $row["imagem"];

          // Definir tipo de conteúdo e cabeçalhos
          header("Content-Type: image/jpeg");
          header("Content-Length: " . strlen($imagem));

          // Exibir imagem
          echo $imagem;
      } else {
          echo "Imagem não encontrada";
      }

      $mysqli->close();
  } else {
      echo "Falha ao conectar ao banco de dados";
  }
}

// Rota para recuperar imagem por ID
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  buscarImagem($id);
}


?>




<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Inserir Notícias</title>

  <link rel="stylesheet" href="CriarNews.css" />
  <link rel="stylesheet" href="./css/menu.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="noticias">
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
            <a href="./pagAdm.html">Home</a>
            <a href="./CalendarioInse/CalendarioInserir.php">Editar Calendario</a>
            <a href="./CriarNews.php">Criar Noticias</a>
            <a href="./index.html">Sair</a>

        </ul>
     
    </nav>
<div class='CriarTamanho'><br><br><br><br>
  <form method="POST" action="" enctype="multipart/form-data" >
    <div class="noticias-container">
      <center><h1 class='tituloNoticias'>Notícias</h1></center>
      <div class='noticias-textarea'><br><br>
        <label><p>Insira o Tiulo da Noticia</p></label>
        <input class='noticias-titulo' name="titulo"   placeholder="Escreva o titulo da notícia aqui..."> 
        <label><p>Insira o texto da Noticia</p></label>
        <textarea class="noticias-textareaInserir" name="noticias" 
          placeholder="Escreva sua notícia aqui..."></textarea>
      </div>
      <center><p class='tituloImages'>Selecione as imagens:</p></center>
      <div class='selecionarImg-container'>
        <input class='SelecionarImg' type="file"  name="arquivos[]" id="file" multiple>
    </div>
    <div>
          <center>
          <button class='buttonEnviar' type="submit" name="submit" value="Incluir">Enviar</button>
          </center>    
      
      </div>
     </form>
    </div>

    
  </form><br>

  <h2 >Salvos no banco de dados</h2>

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
                            echo"<div>";
                            echo"</div>";
                            echo "</div>";
                            echo"<div class='button-container'>";
                            echo "<button class='ler-mais' data-path='" . $News['path'] . "' data-data='" . $News['DataFormatada'] . "' data-titulo='" . $News['titulo'] . "' data-noticia='" . $News['noticia'] . "'>Ler Mais</button>";
                            echo "<button class='BotaoEditar' 
                            data-id='" . $News['id'] . "' 
                            data-titulo='" . $News['titulo'] . "' 
                            data-noticia='" . htmlspecialchars($News['noticia']) . "' 
                            data-path='" . $News['path'] . "' 
                            onclick='openEditModal(this)'>Editar</button>";
                            echo "<a class='BotaoRemo' href='./excluirNoticias.php?id=" . $News['id'] . "' onclick=\"return confirm('Tem certeza de que deseja remover?');\">";
                            echo "<i class='fa fa-trash'></i> </a>"; // Adiciona o ícone do Font Awesome antes do texto "Remover"
                            echo"</div>";
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
                        <img id="modal-img" src="" alt="" width="40%" height="40%">
                        <p id="modal-data"></p>
                        <p class="noticia-titulo" id="modal-titulo"></p>
                        <p id="modal-noticia"></p>
                    </div>
                </div>
            </div>

        </div>
    </section>


  <div class='NCon'>
    <?php
    while ($News = $sql_query->fetch_assoc()) {
      echo "<div class='item-container'>";
      echo "<img src='" . $News['path'] . "' alt=''>";
      echo "<p id='noticia-data'>" . $News['DataFormatada'] . "</p>";
      echo "<p id='noticia-titulo'>" . $News['titulo'] . "</p>";
      echo "<p id='noticia-texto'><span class='resumo'>" . $News['noticia'] . "</span></p>";
      echo "<button class='btnLerNoCr' id='ler_mais'>Ler Mais</button>";
      echo "<a class='BotaoRemo' href='./excluirNoticias.php?id=" . $News['id'] . "' onclick=\"return confirm('Tem certeza de que deseja remover?');\">";
      echo "<i class='fa fa-trash'></i> </a>"; // Adiciona o ícone do Font Awesome antes do texto "Remover"
      echo "</div>";
    }
    ?>
</div>

      
      <script src="./js/botaoNews.js"></script>
      <script src="./js/menu.js"></script>
</div>
 <!-- Modal para Editar Notícias -->
 <div id="editModal" class="modal">
        <div class="modal-contentEdite">
            <span class="close">&times;</span>
            <div class="content1">
                <form id="editForm" method="POST" action="editeNews.php" enctype="multipart/form-data">
                    <div class="noticias-container">
                        <center><h2 class="tituloNoticias">Editar Notícia</h2></center>
                        <div class="noticias-textarea"><br>
                            <label><p>Editar Título</p></label>
                            <input class="noticias-titulo" name="titulo" id="editTitulo" placeholder="Escreva o título da notícia aqui...">
                            <label><p>Editar Notícia</p></label>
                            <textarea class="noticias-textareaInserir" name="noticia" id="editNoticia" placeholder="Escreva sua notícia aqui..."></textarea>
                            <br><br>
                            <label class="labelE" for="time1_img">Editar Imagem </label><br>
                            <img class="img-preview" id="editImgPreview" src="" alt="Imagem da notícia" width="15%"><br>
                            <input class="inputE" type="file" name="caminho" id="editCaminho"><br><br>

                            <input type="hidden" name="id" id="editId">

                        </div>
                        <div>
                            <center>
                                <button class="buttonEnviar" type="submit" name="submit" value="Alterar">Alterar</button>
                            </center>    
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    // JavaScript no final do index.php
<script>
function openEditModal(button) {
    // Extrair dados da notícia do botão
    var id = button.getAttribute('data-id');
    var titulo = button.getAttribute('data-titulo');
    var noticia = button.getAttribute('data-noticia');
    var path = button.getAttribute('data-path');

    // Preencher campos do formulário de edição no modal
    document.getElementById('editId').value = id;
    document.getElementById('editTitulo').value = titulo;
    document.getElementById('editNoticia').value = noticia;
    document.getElementById('editImgPreview').src = path;

    // Mostrar o modal
    var modal = document.getElementById('editModal');
    modal.style.display = "block";

    // Fechar modal ao clicar no 'x'
    var span = modal.getElementsByClassName("close")[0];
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Fechar modal ao clicar fora dele
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}
</script>


    <!--end faça mais-->
    <!--Footer-->
    <footer class="footer">
          <div>
                <a  class="lynks" href="https://m.facebook.com/escolinhadefutebolujr" target="_blank"><i class="fa fa-facebook"></i></a>
                <a class="lynks"href="https://www.youtube.com/@TVUnidosJR/videos" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                <a  class="lynks"href="https://www.instagram.com/p/C6zheUSvj5m/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a class="lynks"href="https://wa.me/553597317199" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
            </div>
            
            <div>
                <img class="imagi" src="img/Coruja.png" width="150" height="150" >  
            </div>
            <p>©Copyright</p>
            <p>Todos os direitos reservados</p>
        </div>
    </footer>
    <!--end footer-->
</body>
</html>