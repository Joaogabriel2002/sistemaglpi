<?php
require_once "..\..\..\..\..\..\php/Itens.php";

$msg = "";
$success = false;

// Variáveis para manter o valor do formulário, para limpar em caso de sucesso
$nome = "";
$tipo = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $itens = new Itens();

    // Pegando os valores enviados pelo formulário
    $nome = trim($_POST['nome'] ?? '');
    $tipo = trim($_POST['tipo'] ?? '');

    if (strlen($nome) < 3) {
        $msg = "O nome do item deve ter pelo menos 3 caracteres.";
    } elseif (empty($tipo)) {
        $msg = "O tipo do item é obrigatório.";
    } else {
        // Setando os atributos
        $itens->setNome($nome);
        $itens->setTipo($tipo);
        $resultado = $itens->cadastrarItens();

        if ($resultado) {
            $msg = "Item cadastrado com sucesso!";
            $success = true;
            // Limpa os valores para resetar o formulário
            $nome = "";
            $tipo = "";
        } else {
            $msg = "Erro ao cadastrar o item.";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - ChesiQuímica</title>
    <link rel="stylesheet" href="..\..\..\..\..\..\css/incluirEstoque.css">
    <link rel="icon" href="../img/chesiquimica-logo-png.png" type="image/png">
</head>

<body>

    <div class="container">
        <div class="left-section">
            <img src="..\..\..\..\..\..\img/chesiquimica-logo-png.png" alt="Logo ChesiQuímica" class="brand-logo">
            <img src="..\..\..\..\..\..\img/chesiquimica-letreiro-png.png" alt="Logo ChesiQuímica" class="brand-name">
        </div>

        <div class="right-section">
            <a href="..\estoque.php" class="back-link">Voltar</a>
            <?php if (!empty($msg)) : ?>
                <p style="color: <?= $success ? 'green' : 'red' ?>;"><?= $msg ?></p>
            <?php endif; ?>
            <h2 class="form-title">Cadastro</h2>

            

            <form class="form" action="cadastrarItem.php" method="POST">
                <div class="campo-form">
                    <label>Descrição</label>
                    <input type="text" name="nome" placeholder="Descrição do Item" required value="<?= htmlspecialchars($nome) ?>">
                </div>

                <div class="campo-form">
                    <label>Tipo:</label>
                    <select name="tipo" id="tipo" required>
                        <option value=""></option>
                        <option value="Tonner" <?= $tipo === "Tonner" ? 'selected' : '' ?>>Tonner</option>
                        <option value="Material De Escritório" <?= $tipo === "Material De Escritório" ? 'selected' : '' ?>>Material de Escritório</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Cadastrar-se</button>
            </form>
        </div>
    </div>

</body>

</html>
