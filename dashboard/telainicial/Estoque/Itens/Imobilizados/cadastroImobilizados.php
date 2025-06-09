<?php
require_once '..\..\..\..\..\php/Imobilizados.php';
$msg = "";


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
        <h2 class="form-title">Cadastro de Modelos Imobilizados</h2>

        <form class="form" action="cadastroImobilizados.php" method="POST" id="form-estoque">
            <div class="campo-form">
                <label>Descrição do Modelo:</label>
                <input type="text" name="modelo" placeholder="" required />
            </div>


            <div id="itens-container">
                <div class="campo-form item-row">
                    <label>Tipo</label>               
                    <select name="tipo" id="tipo" required>
                        <option value=""></option>
                        <option value="Aparelhos de Redes">Aparelhos de Redes</option>
                        <option value="Computador">Computador</option>
                        <option value="Impressora">Impressora</option>
                        <option value="Notebook">Notebook</option>
                        <option value="Outros">Outros</option>
                    </select>
            <button type="submit" class="submit-btn">Cadastrar</button>
        </form>
    </div>
</div>
</body>

</html>
