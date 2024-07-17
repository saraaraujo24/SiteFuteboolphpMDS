<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Calendário</title>
    <style>
        .bodyEDite {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .formE {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .labelE {
            display: block;
            margin-bottom: 10px;
        }
        .inputE {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #7c559b;
            border-radius: 4px;
            box-sizing: border-box;
            transition: all linear 160ms;
            outline: none;
        }
        .inputE[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .inputE[type="submit"]:hover {
            background-color: green;
        }

        .containerbtnAlterar {
            align-items: center;
            justify-content: center;
            display: flex;
            width: 100%;
        }

        .btnAlterar {
            background-color:#7c559b;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            border: none !important;
            transition: all linear 160ms;
            cursor: pointer;
            margin: 0 !important;
            width: 50%;
            height: 35px;
            border-radius: 8px;
        }

        .btnAlterar:hover {
            transform: scale(1.05);
            background-color:#7c559b;
        }
        .TiEdt {
            color: #331A4D;
        }
        .img-preview {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class='bodyEDite '>

<?php
require 'iniciaCalen.php';

// Pega o ID da URL
$codigo = isset($_GET['codigo']) ? (int)$_GET['codigo'] : null;

// Valida o ID
if (empty($codigo)) {
    echo "<p>ID para alteração não definido</p>";
    exit;
}

// Busca os dados do usuário a ser editado
$PDO = db_connect();
$sql = "SELECT data, hora, local, time1_img, time2_img FROM calendario WHERE codigo = :codigo";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!is_array($usuario)) {
    echo "<p>Nenhum usuário encontrado</p>";
    exit;
}

// Processa as imagens do time 2
$time2_imgs = isset($usuario['time2_img']) ? explode(',', $usuario['time2_img']) : [];
?>
 
 <form class='formE' action="edita.php" method="post" enctype="multipart/form-data">

    <center><h3 class="TiEdt">Edite</h3></center>
    <label class='labelE' for="data">Data:</label>
    <input class='inputE' type="text" name="data" id="data" placeholder="dd/mm/YYYY" value="<?php echo htmlspecialchars($usuario["data"], ENT_QUOTES, 'UTF-8'); ?>">
    <br><br>
    <label class='labelE' for="hora">Hora:</label>
    <input class='inputE' type="text" name="hora" id="hora" value="<?php echo htmlspecialchars($usuario['hora'], ENT_QUOTES, 'UTF-8'); ?>">
    <br><br>
    <label class='labelE' for="local">Local:</label>
    <input class='inputE' type="text" name="local" id="local" value="<?php echo htmlspecialchars($usuario['local'], ENT_QUOTES, 'UTF-8'); ?>">
    <br><br>

    <label class='labelE' for="time1_img">Imagem do Time 1: </label><br>
    <?php if (!empty($usuario['time1_img'])): ?>
        <img class="img-preview" src="<?php echo htmlspecialchars($usuario['time1_img'], ENT_QUOTES, 'UTF-8'); ?>" alt="Imagem Time 1" width="100"><br>
    <?php endif; ?>
    <input class='inputE' type="file" name="time1_img" id="time1_img"><br><br>

    <label class='labelE' for="time2_img">Imagens do Time 2: </label><br>
    <?php foreach ($time2_imgs as $img): ?>
        <?php if (!empty($img)): ?>
            <img class="img-preview" src="<?php echo htmlspecialchars($img, ENT_QUOTES, 'UTF-8'); ?>" alt="Imagem Time 2" width="100"><br>
        <?php endif; ?>
    <?php endforeach; ?>
    <input class='inputE' type="file" name="time2_img[]" id="time2_img" multiple><br><br>

    <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
    <div class="containerbtnAlterar">
        <input class="btnAlterar" type="submit" value="Alterar">
    </div><br>
    <center>
        <a href='CalendarioInserir.php'><button type="button" class="btnAlterar">Voltar</button></a>
    </center>
</form>

</body>
</html>
