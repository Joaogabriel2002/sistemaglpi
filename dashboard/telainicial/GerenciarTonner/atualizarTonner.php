<?php
require_once '..\..\..\php/Tonner.php';
session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $solicitacaoid = $_GET['id'];

    $tonner = new Tonner();
    $detalhesTonner = $tonner->listarTonnerPorId($solicitacaoid);
    
    if (!$detalhesTonner) {
        die('ID do toner inválido ou não encontrado.');
    }
    
    $statusAtual = $detalhesTonner['status']; 
    $prioridade = $detalhesTonner['situacao'];
} else {
    die('ID do toner inválido ou não fornecido.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['atualizarTonner'])) {
        $tonner->setSolicitacaoId($solicitacaoid);
        $tonner->setStatus($_POST['status']);
        $tonner->setSituacao($_POST['situacao']);
        $tonner->setTecnico($_SESSION['usuario']);
        
        $tonner->atualizarSolicitacao($_POST['status'], $_POST['situacao'], $solicitacaoid);
        $tonner->adicionarAtualizacao();
        
        // Opcional: redirecionar para detalhes ou outra página após atualizar
        header("Location: detalhesTonner.php?id=$solicitacaoid");
        exit;
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
    <?php if ($statusAtual === "Fechado" || $statusAtual === "Cancelado") { ?>
        <p>Impossível alterar as informações deste toner.</p>
    <?php } else { ?>
        <h3>Atualizar Solicitação Nº: <?php echo htmlspecialchars($solicitacaoid); ?></h3>
        <form action="atualizarTonner.php?id=<?php echo htmlspecialchars($solicitacaoid); ?>" method="POST">
            <label for="status">Status da Requisição</label>
            <select name="status" id="status">
                <option value="Aberto" <?php echo ($statusAtual == 'Aberto') ? 'selected' : ''; ?>>Aberto</option>
                <option value="Em andamento" <?php echo ($statusAtual == 'Em andamento') ? 'selected' : ''; ?>>Em andamento</option>
                <option value="Fechado" <?php echo ($statusAtual == 'Fechado') ? 'selected' : ''; ?>>Fechado</option>
                <option value="Cancelado" <?php echo ($statusAtual == 'Cancelado') ? 'selected' : ''; ?>>Cancelado</option>
            </select>
            <br />
            <label for="situacao">Definir Situação:</label>
            <select name="situacao" id="situacao">
                <option value="Em estoque" <?php echo ($prioridade == 'Em estoque') ? 'selected' : ''; ?>>Em estoque</option>
                <option value="Sem Estoque" <?php echo ($prioridade == 'Sem estoque') ? 'selected' : ''; ?>>Sem Estoque</option>
                <option value="Comprado" <?php echo ($prioridade == 'Comprado') ? 'selected' : ''; ?>>Comprado</option>
                <option value="Entregue" <?php echo ($prioridade == 'Entregue') ? 'selected' : ''; ?>>Entregue</option>
            </select>
            <br />
            <button type="submit" name="atualizarTonner">Atualizar</button>
        </form>
    <?php } ?>
    <a href="detalhesTonner.php?id=<?php echo htmlspecialchars($solicitacaoid); ?>">Voltar</a>
</body>
</html>
