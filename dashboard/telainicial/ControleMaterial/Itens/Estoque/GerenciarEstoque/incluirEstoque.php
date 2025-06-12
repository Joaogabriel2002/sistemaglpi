<?php

require_once '..\..\..\..\..\..\php\Itens.php';
require_once '..\..\..\..\..\..\php\Fornecedor.php';
require_once '..\..\..\..\..\..\php\Estoque.php';

session_start();
echo $_SESSION['usuario_id'];
$msg = "";


$itensObj = new Itens();
$listaItens = $itensObj->listarItens2();

// Buscar fornecedores do banco
$fornecedorObj = new Fornecedor();
$listaFornecedores = $fornecedorObj->listarFornecedores();

function gerarOptions($listaItens) {
    $html = '<option value="">Selecione</option>';
    foreach ($listaItens as $item) {
        $html .= '<option value="' . htmlspecialchars($item['id']) . '">' . htmlspecialchars($item['nome']) . '</option>';
    }
    return $html;
}

function gerarOptionsFornecedores($listaFornecedores) {
    $html = '<option value="">Selecione</option>';
    foreach ($listaFornecedores as $fornecedor) {
        $html .= '<option value="' . htmlspecialchars($fornecedor['nome']) . '">' . htmlspecialchars($fornecedor['nome']) . '</option>';
    }
    return $html;
}

$optionsHTML = gerarOptions($listaItens);
$optionsFornecedoresHTML = gerarOptionsFornecedores($listaFornecedores);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notaFiscal = $_POST['nota_fiscal'];
    $fornecedor = $_POST['fornecedor'];
    $itens = $_POST['item'];
    $quantidades = $_POST['quantidade'];
    $tipo_movimentacao = "ENTRADA";
    $motivo = "Entrada de Material";
    $usuario = $_SESSION['usuario_id'];

    $estoque = new Estoque();
    $erros = 0;

    foreach ($itens as $index => $item) {
    if (!empty($item) && is_numeric($quantidades[$index]) && $quantidades[$index] > 0) {
        $estoque->setItemId($item);
        $estoque->setNotaFiscal($notaFiscal);
        $estoque->setFornecedor($fornecedor);
        $estoque->setQuantidade($quantidades[$index]);
        $estoque->setTipo_Movimentacao($tipo_movimentacao);
        $estoque->setMotivo($motivo);        // <-- adicionado aqui
        $estoque->setUsuarioId($usuario);    // <-- adicionado aqui

        $ultimoId = $estoque->incluirEstoque();

        if (!$ultimoId) {
            $erros++;
        }
    }
}

    if ($erros > 0) {
        $msg = "Erro ao cadastrar $erros item(s).";
    } else {
        $msg = "Lançamento efetuado com sucesso!";
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
    <link rel="stylesheet" href="../../../../../../css/incluirEstoque.css" />
</head>

<body>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const itensContainer = document.getElementById('itens-container');
    const botaoAdd = document.getElementById('botao-adicionar');
    const optionsHTML = `<?= $optionsHTML ?>`;

    function adicionarItem() {
        const novaLinha = document.createElement('div');
        novaLinha.classList.add('campo-form', 'item-row');
        novaLinha.innerHTML = `
            <label>Item:</label>
            <select name="item[]" required>
                ${optionsHTML}
            </select>
            <label>Quantidade:</label>
            <input type="number" name="quantidade[]" min="1" required>
            <button type="button" class="remover-btn">Remover</button>
        `;

        itensContainer.appendChild(novaLinha);

        novaLinha.querySelector('.remover-btn').addEventListener('click', () => {
            itensContainer.removeChild(novaLinha);
        });
    }

    botaoAdd.addEventListener('click', adicionarItem);
});
</script>

<div class="container">
    <div class="left-section">
        <img src="../../../../img/chesiquimica-logo-png.png" alt="Logo ChesiQuímica" class="brand-logo" />
        <img src="../../../../img/chesiquimica-letreiro-png.png" alt="Logo ChesiQuímica" class="brand-name" />
    </div>

    <div class="right-section">
        <a href="MovimentacaoEstoque.php" class="back-link">Voltar</a>
        <?php if ($msg) : ?>
            <div class="mensagem-feedback"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>
        <h2 class="form-title">Cadastro</h2>

        <form class="form" action="incluirEstoque.php" method="POST" id="form-estoque">
            <div class="campo-form">
                <label>Nrº NFe:</label>
                <input type="text" name="nota_fiscal" placeholder="000000" required />
            </div>

            <div class="campo-form">
                <label>Fornecedor:</label>
                <select name="fornecedor" required>
                    <?= $optionsFornecedoresHTML ?>
                </select>
            </div>

            <div id="itens-container">
                <div class="campo-form item-row">
                    <label>Item:</label>
                    <select name="item[]" required>
                        <?= $optionsHTML ?>
                    </select>

                    <label>Quantidade:</label>
                    <input type="number" name="quantidade[]" min="1" required />
                </div>
            </div>

            <button type="button" class="submit-btn" id="botao-adicionar">Adicionar Item</button>
            <button type="submit" class="submit-btn">Cadastrar</button>
        </form>
    </div>
</div>
</body>

</html>
