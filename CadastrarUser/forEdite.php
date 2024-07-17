<?php
require '../CalendarioInse/iniciaCalen.php';

// Pega o ID da URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Valida o ID
if (empty($id)) {
    echo "<p>ID para alteração não definido</p>";
    exit;
}

// Busca os dados do usuário a ser editado
$PDO = db_connect();
$sql = "SELECT nome, email, senha FROM user WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!is_array($usuario)) {
    echo "<p>Nenhum usuário encontrado</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
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

        .btnVoltar {
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
    </style>
</head>
<body class='bodyEDite'>

<form class='formE' action="edite.php" method="post">
    <label class='labelE' for="nome">Nome:</label>
    <input class='inputE' type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8'); ?>">
    <br><br>
    <label class='labelE' for="email">Email:</label>
    <input class='inputE' type="text" name="email" id="email" value="<?php echo htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8'); ?>">
    <br><br>
    <label class='labelE' for="senha">Senha:</label>
    <input class='inputE' type="text" name="senha" id="senha" value="<?php echo htmlspecialchars($usuario['senha'], ENT_QUOTES, 'UTF-8'); ?>">
    <br><br>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="containerbtnAlterar">
        <input class="btnAlterar" type="submit" value="Alterar">
    </div>
    <div >
        <center><a href="../pagAdm.html" class="btnVoltar">Voltar</a></center>
    </div>
</form>



</body>
</html>
