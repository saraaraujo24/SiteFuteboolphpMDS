<!doctype html>
<html>
<head>
<meta charset="utf8">
<title>Cadastro de Jogos</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
      integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="calendario.css" />
<link rel="stylesheet" href="../css//menu.css">
<link rel="stylesheet" href="../css/style.css">

</head>
<style>

 
</style>
<body>
<nav class="navbar">
        <!-- LOGO -->
        <div class="logo">
            <img src="../img/LOGO VERTICAL3.png" width="100" height="150">
        </div>
        <!-- NAVEGAÇÃO MENU -->
        <div class="menu-btn">
            <i class="fa fa-bars fa-2x" onclick="menuShow()"></i>
        </div>
        <ul class="estiloUl">
            <a href="../pagAdm.html">Home</a>
            <a href="CalendarioInserir.php">Editar Calendario</a>
            <a href="../CriarNews.php">Criar Noticias</a>
            <a href="../index.html">Sair</a>
            <div class="close-icon" onclick="closeMenu()">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
            </div>
        </ul>
        <div class="menu-icon" onclick="openMenu()">
            <i class="fa fa-bars"></i>
        </div>
</nav>


  
<h2>Lista de Jogos</h2>
<center><h2>Total de Jogos: <span id="totalJogos"></span></h2></center>

<table id="tabelaJogos" class="tableCalen">
    <thead>
    <tr>
        <th>Data</th>
        <th>Hora</th>
        <th>Local</th>
        <th>Imagem Time 1</th>
        <th>Imagem Time 2</th>
    </tr>
    </thead>
    <tbody id="corpoTabela">
    </tbody>
</table>

    <br><br>
    <script src="lista_jogos.js"></script>
   
        <h2>Cadastrar Jogos</h2>
        <form class="screen" action="" method="post" enctype="multipart/form-data">
        <div class='inputCadas'>
            <label class='labelCadas' for="data">Data: </label><br>
            <input class='inputCadas' type="text" name="data" id="data" placeholder="dd/mm/YYYY"><br><br>
            
            <label class='labelCadas' for="hora">Hora: </label><br>
            <input class='inputCadas' type="text" name="hora" id="hora"><br><br>
            
            <label class='labelCadas' for="local">Local: </label><br>
            <input class='inputCadas' type="text" name="local" id="local"><br><br>
            
            <label class='labelCadas' for="time1_img">Imagem do Time 1: </label><br>
            <input class='inputCadas' type="file" name="time1_img" id="time1_img"><br>

            <label class='labelCadas' for="time1_img">Nome do Time 1: </label>
            <input class='inputCadas' type="text" name="NameTime1" id="local"><br><br>
            <br><br>
            
            <label class='labelCadas' for="time2_img">Imagem do Time 2: </label><br>
            <input class='inputCadas' type="file" name="time2_img[]" id="time2_img" multiple>
            <label class='labelCadas' for="time1_img">Nome do Time 2: </label>
            <input class='inputCadas' type="text" name="NameTime2" id="local"><br><br>
        </div>
        
        <div class="CadasJogos">
            <input type="submit" value="Cadastrar">
        </div>
    </form>
            <?php
require_once 'iniciaCalen.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $data = isset($_POST['data']) ? $_POST['data'] : null;
    $hora = isset($_POST['hora']) ? $_POST['hora'] : null;
    $local = isset($_POST['local']) ? $_POST['local'] : null;
    $NameTime1 = isset($_POST['NameTime1']) ? $_POST['NameTime1'] : null;
    $NameTime2 = isset($_POST['NameTime2']) ? $_POST['NameTime2'] : null;
    // Verifica se os campos obrigatórios foram preenchidos
    if (empty($data) || empty($hora) || empty($local)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;
    }

    // Trata o upload da imagem do time 1
    $time1_img_path = null;
    if (isset($_FILES['time1_img']) && $_FILES['time1_img']['error'] === UPLOAD_ERR_OK) {
        $time1_img_tmp = $_FILES['time1_img']['tmp_name'];
        $time1_img_name = $_FILES['time1_img']['name'];
        $time1_img_path = 'imagensTimes/time1_img/' . $time1_img_name; // Defina o diretório correto
        move_uploaded_file($time1_img_tmp, $time1_img_path);
    }

    // Trata o upload da imagem do time 2 (opcional, múltiplas imagens)
    $time2_img_paths = [];
    if (isset($_FILES['time2_img'])) {
        foreach ($_FILES['time2_img']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['time2_img']['error'][$key] === UPLOAD_ERR_OK) {
                $time2_img_name = $_FILES['time2_img']['name'][$key];
                $time2_img_path = 'imagensTimes/time2_img/' . $time2_img_name; // Defina o diretório correto
                move_uploaded_file($tmp_name, $time2_img_path);
                $time2_img_paths[] = $time2_img_path;
            }
        }
    }

    // Insere os dados no banco de dados
    $PDO = db_connect();
    $sql = "INSERT INTO calendario (data, hora, local ,NameTime1,NameTime2, time1_img, time2_img) 
        VALUES (:data, :hora, :local,:NameTime1,:NameTime2, :time1_img, :time2_img)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':hora', $hora);
    $stmt->bindParam(':local', $local);
    $stmt->bindParam(':NameTime1',$NameTime1);
    $stmt->bindParam(':NameTime2',$NameTime2);
    $stmt->bindParam(':time1_img', $time1_img_path);
    $stmt->bindParam(':time2_img', implode(',', $time2_img_paths)); // Salva múltiplos caminhos separados por vírgula

    if ($stmt->execute()) {
        echo "Jogo cadastrado com sucesso!";
        // Redireciona para a página desejada após o cadastro
        header('Location: ./CalendarioInserir.php');
    } else {
        echo "Erro ao cadastrar jogo.";
        print_r($stmt->errorInfo());
    }
}
?>
<script src="../js/menu.js"></script>
<script>
       // Verifica se o usuário está logado pelo localStorage
   document.addEventListener('DOMContentLoaded', function() {
    var isLoggedIn = window.localStorage.getItem('isLoggedIn');
    if (!isLoggedIn || isLoggedIn !== 'true') {
        alert('Não possui liberação para acessar essa página');
        window.location.href = '../index.html';
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
</script>
<br><br><br><br>
    <!--Footer-->
    <footer class="footer">
          <div>
                <a  class="lynks" href="https://m.facebook.com/escolinhadefutebolujr" target="_blank"><i class="fa fa-facebook"></i></a>
                <a class="lynks"href="https://www.youtube.com/@TVUnidosJR/videos" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                <a  class="lynks"href="https://www.instagram.com/p/C6zheUSvj5m/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a class="lynks"href="https://wa.me/553597317199" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
            </div>
            
            <div>
                <img class="imagi" src="../img/Coruja.png" width="150" height="150" >  
            </div>
            <p>©Copyright</p>
            <p>Todos os direitos reservados</p>
        </div>
    </footer>
    <!--end footer-->

</body>
</html>
