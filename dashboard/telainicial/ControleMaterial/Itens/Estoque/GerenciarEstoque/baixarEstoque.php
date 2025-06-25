<?php
require_once '..\..\..\..\..\..\php\Itens.php';
require_once '..\..\..\..\..\..\php\Fornecedor.php';
require_once '..\..\..\..\..\..\php\Estoque.php';
$msg = "";
session_start();    


$itensObj = new Itens();
$listaItens = $itensObj->listarItens();


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
    $notaFiscal = $_POST['nota_fiscal'] ?? '';
    $fornecedor = $_POST['fornecedor'] ?? '';
    $itens = $_POST['item'] ?? [];
    $quantidades = $_POST['quantidade'] ?? [];
    $tipo_movimentacao = "SAIDA";
    $motivo= $_POST['motivo'] ?? [];
    $usuario = $_SESSION['usuario_id'];

    $estoque = new Estoque();
    $erros = 0;

    foreach ($itens as $index => $item) {
    if (!empty($item) && is_numeric($quantidades[$index]) && $quantidades[$index] > 0) {
        $saldoAtual = $estoque->consultarSaldo($item);


        $nomeItem = '';
        foreach ($listaItens as $itemObj) {
            if ($itemObj['id'] == $item) {
                $nomeItem = $itemObj['nome'];
                break;
            }
        }

        if ($quantidades[$index] > $saldoAtual) {
            $erros++;
            $msg .= "❌ Erro: Não é possível retirar {$quantidades[$index]} un. do item {$nomeItem}. Saldo disponível: {$saldoAtual}.";
            continue;
        }

        $estoque->setItemId($item);
        $estoque->setNotaFiscal($notaFiscal);
        $estoque->setFornecedor($fornecedor);
        $estoque->setQuantidade($quantidades[$index]);
        $estoque->setTipo_Movimentacao($tipo_movimentacao);
        $estoque->setMotivo($motivo);
        $estoque->setUsuarioId($usuario);

        $ultimoId = $estoque->incluirEstoque();

        if (!$ultimoId) {
            $erros++;
        }
    }
}


    if ($erros > 0) {
        // $msg = "Erro ao baixar item";
    } else {
        $msg .= "{$quantidades[$index]} unidade(s) do {$nomeItem} baixada!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro - ChesiQuímica</title>

    <link rel="stylesheet" href="/sistemaglpi/css/incluirEstoque.css" />
    <link rel="icon" href="../img/chesiquimica-logo-png.png" type="image/png" />
</head>

<body>

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

            <form class="form" action="baixarEstoque.php" method="POST" id="form-estoque">

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
                <input type="hidden" name="tipo_movimentacao" value="SAIDA" />

            <div id="itens-container">
                <div class="campo-form item-row">
                <label for="motivo">Motivo da Baixa:</label>
                <select name="motivo" id="motivo">
                    <option value="Perda">Perda</option>
                    <option value="Baixa Manual">Baixa Manual</option>
                </select>
            </div>
            </div>

                <button type="submit" class="submit-btn">Cadastrar</button>
            </form>
        </div>
    </div>

</body>

</html>
