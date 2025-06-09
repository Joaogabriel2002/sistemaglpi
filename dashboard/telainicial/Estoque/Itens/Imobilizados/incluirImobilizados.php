<?php
require_once '..\..\..\..\..\php/Imobilizados.php';

$msg = "";

// if(!isset($_SESSION['usuario_id'])){
//     header("Location:..\..\index.php");
//     exit();
// }


$imobilizado = new Imobilizados();
$modelos= $imobilizado->buscarModelos();
$setor= $imobilizado->buscarSetores();



if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $imobilizado = new Imobilizados;
    $imobilizado->setModelo($_POST['modelo']);
    $imobilizado->setTipo($_POST['tipo']);

    $imobilizado->cadastrarImobilizados();
    $erros = 0;
    if ($erros > 0) {
        $msg = "Erro ao cadastrar $erros item(s).";
    } else {
        $msg = "Item cadastrado com sucesso!";
    }
}





?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro - ChesiQuímica</title>
    <script src="scriptEstoque.js"></script>
    <link rel="stylesheet" href="../../../../../css/incluirEstoque.css" />
</head>

<body>


<div class="container">
    <div class="left-section">
        <img src="../../../../../img/chesiquimica-logo-png.png" alt="Logo ChesiQuímica" class="brand-logo" />
        <img src="../../../../../img/chesiquimica-letreiro-png.png" alt="Logo ChesiQuímica" class="brand-name" />
    </div>

    <div class="right-section">
        <a href="imobilizados.php" class="back-link">Voltar</a>
        <?php if ($msg) : ?>
            <div class="mensagem-feedback"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>
        <h2 class="form-title">Cadastro</h2>

        <form class="form" action="cadastroImobilizados.php" method="POST" id="form-estoque">
            <div class="campo-form">
                <label for="modeloTonner">Modelo:</label>
                <select id="modelo" name="modelo" required>
                    <option value=""></option>
                    <?php foreach ($modelos as $mdl): ?>
                        <option value="<?= htmlspecialchars($mdl['idEquipamento']) ?>">
                        <?= htmlspecialchars($mdl['descricaoEquipamento']) ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>


            <div id="itens-container">
                <div class="campo-form item-row">
                    <label>Nrº Patrimônio</label>               
                    <input type="text" id="patrimonio" name="patrimonio" required>
                </div>

            <div class="campo-form">
                <label for="setor">Setor:</label>
                <select id="setor" name="setor" required>
                    <option value=""></option>
                    <?php foreach ($setor as $st): ?>
                        <option value="<?= htmlspecialchars($st['setor']) ?>">
                        <?= htmlspecialchars($st['setor']) ?>
                        </option>
                    <?php endforeach; ?>

                </select><br><br>
            </div>
            <button type="submit" class="submit-btn">Cadastrar</button>
        </form>
    </div>
</div>
</body>

</html>
