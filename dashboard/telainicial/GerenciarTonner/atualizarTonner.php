<?php
require_once '..\..\..\php/Tonner.php';

session_start();

$msg = "";

// Verifica se o ID da solicitação veio e é numérico
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $solicitacaoid = $_GET['id'];

    $tonner = new Tonner();
    $detalhesTonner = $tonner->listarTonnerPorId($solicitacaoid);

    if (!$detalhesTonner) {
        die('ID do toner inválido ou não encontrado.');
    }

    // Status atual e prioridade do banco
    $statusAtualBanco = $detalhesTonner['status'] ?? '';
    $prioridade = $detalhesTonner['situacao'] ?? '';

    // Pega os valores da URL, se existirem, senão usa o banco
    $statusEstoque = $_GET['statusEstoque'] ?? $prioridade;
    $tonnerId = $_GET['tonnerId'] ?? ($detalhesTonner['tonnerId'] ?? null);

} else {
    die('ID do toner inválido ou não fornecido.');
}

// Se for POST, processa atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['atualizarTonner'])) {

        $statusNovo = $_POST['status'] ?? '';
        $statusEstoque = $_POST['statusEstoque'] ?? '';
        $tonnerId = $_POST['tonnerId'] ?? null;
        $situacao = $_POST['situacao'] ?? '';

        // Regra de negócio: não fechar se não tem estoque
        if ($statusNovo === "Fechado" && $statusEstoque !== "Em estoque") {
            $msg = "❌ Não é possível fechar a solicitação: O item solicitado não possui estoque.";
        } else {
            // Atualiza o objeto Tonner
            $tonner->setSolicitacaoId($solicitacaoid);
            $tonner->setStatus($statusNovo);
            $tonner->setSituacao($situacao);
            $tonner->setTecnico($_SESSION['usuario'] ?? ''); // segurança

            $tonner->atualizarSolicitacao($statusNovo, $situacao, $solicitacaoid);
            $tonner->adicionarAtualizacao();

            // Se fechou e tem estoque, baixa no estoque
            if ($statusNovo === "Fechado" && $statusEstoque === "Em estoque" && $tonnerId) {
                require_once '..\..\..\php/Estoque.php';
                $estoque = new Estoque();
                $estoque->setQuantidade(1); // ajustar se precisar
                $estoque->setTipo_Movimentacao("SAIDA");
                $estoque->setMotivo("Entrega de Suprimento");
                $estoque->setUsuarioId($_SESSION['usuario_id'] ?? 0);
                $estoque->setItemId($tonnerId); // descomente se necessário

                $resultadoBaixa = $estoque->incluirEstoque();

                if (!$resultadoBaixa) {
                    $msg = "⚠️ Falha ao registrar a baixa no estoque.";
                }
            }

            // Se não houve erro na baixa ou regra de negócio, redireciona
            if (empty($msg)) {
                header("Location: detalhesTonner.php?id=$solicitacaoid");
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Atualizar Toner</title>
    <link rel="stylesheet" href="/gerenciadorti/css/atualizarTonner.css" />
    <link rel="icon" href="../img/chesiquimica-logo-png.png" type="image/png" />
</head>
<body>
    <?php if ($statusAtualBanco === "Fechado" || $statusAtualBanco === "Cancelado") { ?>
        <p style="color: red; font-weight: bold;">Impossível alterar as informações desta Solicitação.</p>
    <?php } else { ?>
        <?php if (!empty($msg)) { ?>
            <p style="color: red; font-weight: bold;"><?= htmlspecialchars($msg) ?></p>
        <?php } ?>

        <h3>Atualizar Solicitação Nº: <?= htmlspecialchars($solicitacaoid) ?></h3>
        <form action="atualizarTonner.php?id=<?= htmlspecialchars($solicitacaoid) ?>&statusEstoque=<?= urlencode($statusEstoque) ?>&tonnerId=<?= urlencode($tonnerId) ?>" method="POST">

            <input type="hidden" name="statusEstoque" value="<?= htmlspecialchars($statusEstoque) ?>">
            <input type="hidden" name="tonnerId" value="<?= htmlspecialchars($tonnerId) ?>">

            <label for="status">Status da Requisição</label>
            <select name="status" id="status" required>
                <option value="Aberto" <?= ($statusAtualBanco == 'Aberto') ? 'selected' : '' ?>>Aberto</option>
                <option value="Em andamento" <?= ($statusAtualBanco == 'Em andamento') ? 'selected' : '' ?>>Em andamento</option>
                <option value="Fechado" <?= ($statusAtualBanco == 'Fechado') ? 'selected' : '' ?>>Fechado</option>
                <option value="Cancelado" <?= ($statusAtualBanco == 'Cancelado') ? 'selected' : '' ?>>Cancelado</option>
            </select>
            <br />

            <label for="situacao">Situação:</label>
            <input type="text" name="situacao" value="<?= htmlspecialchars($statusEstoque) ?>" readonly>
            <br />

            <button type="submit" name="atualizarTonner">Atualizar</button>
        </form>
    <?php } ?>

    <a href="detalhesTonner.php?id=<?= htmlspecialchars($solicitacaoid) ?>">Voltar</a>
</body>
</html>
