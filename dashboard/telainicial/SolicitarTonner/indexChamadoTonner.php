<?php
session_start();
require_once '..\..\..\php\Tonner.php';
require_once '..\..\..\php\Imobilizados.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ..\..\..\index.php");
    exit();
}

$imobilizados = new Imobilizados();
$impressorasAtivas = $imobilizados->listarImpressorasAtivas();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tonnerSolicitacao = new Tonner();

    $tonnerSolicitacao->setStatus($_POST['status']);
    $tonnerSolicitacao->setAutorId($_SESSION['usuario_id']);
    $tonnerSolicitacao->setAutorNome($_SESSION['usuario']);
    $tonnerSolicitacao->setAutorEmail($_SESSION['email_usuario']);
    $tonnerSolicitacao->setAutorSetor($_SESSION['setor']);

    $impressoraId = isset($_POST['modeloTonner']) ? $_POST['modeloTonner'] : '';
    $tonnerSolicitacao->setImpressoraId($impressoraId);

    $modeloNome = '';
    foreach ($impressorasAtivas as $imp) {
        if ($imp['idEquipamento'] == $impressoraId) {
            $modeloNome = $imp['tipo'];
            break;
        }
    }
    $tonnerSolicitacao->setModeloTonner($modeloNome);

    $corTonnerString = isset($_POST['corTonner']) ? $_POST['corTonner'] : '';
    $tonnerSolicitacao->setCorTonner($corTonnerString);

    try {
        $novoChamadoId = $tonnerSolicitacao->solicitarTonner();

        if ($novoChamadoId) {
            header("Location: solicitacaoAberta.php?tonnerSolicitacao=" . $novoChamadoId);
            exit();
        } else {
            $erroMsg = "Erro ao abrir chamado!";
        }

    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'impressoraId sem tonner associado') !== false) {
            $erroMsg = "⚠️ Você precisa associar um tonner a essa impressora antes de solicitar!";
        } else {
            $erroMsg = "Erro inesperado: " . htmlspecialchars($e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="indexChamadoTonner.js" defer></script>
    <title>Solicitar Tonner</title>
    <link rel="icon" href="../../../img/chesiquimica-logo-png.png" type="image/png" />
    <link rel="stylesheet" href="../../../css/base.css" />
    <link rel="stylesheet" href="../../../css/tonner.css" />
</head>

<body>

<div class="container">
    <div class="left-section">
        <img src="../../../img/chesiquimica-logo-png.png" class="brand-logo" alt="Logo Chesiquímica" />
        <img src="../../../img/chesiquimica-letreiro-png.png" class="brand-name" alt="Logo Chesiquímica" />
    </div>

    <div class="right-section">
        <?php if (isset($erroMsg)): ?>
            <div style="margin-top:20px; padding:10px; background-color:#f8d7da; color:#721c24; border:1px solid #f5c6cb; border-radius:5px;">
                <?= $erroMsg ?>
            </div>
        <?php endif; ?>
        <h2>Solicitação de Tonner</h2>
        <form id="tonner" method="POST">
            <input type="hidden" name="status" value="Aberto" />
            <input type="hidden" id="corTonnerHidden" name="corTonner" value="" />

            <div class="modeloTonner">
                <label for="modeloTonner">Modelo da Impressora</label>
                <select id="modeloTonner" name="modeloTonner" required>
                    <option value=""></option>
                    <?php foreach ($impressorasAtivas as $impressora): ?>
                        <option value="<?= htmlspecialchars($impressora['idEquipamento']) ?>">
                            <?= htmlspecialchars($impressora['descricaoEquipamento']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="coresContainer" style="display:none; margin-top: 10px;">
                <h3>Selecione a cor de tinta:</h3>
                <input type="radio" id="preto" name="corTonner" value="preto" />
                <label for="preto">Preto</label><br />
                <input type="radio" id="azul" name="corTonner" value="azul" />
                <label for="azul">Azul</label><br />
                <input type="radio" id="amarelo" name="corTonner" value="amarelo" />
                <label for="amarelo">Amarelo</label><br />
                <input type="radio" id="vermelho" name="corTonner" value="vermelho" />
                <label for="vermelho">Vermelho</label><br />
            </div>

            <br>
            <div class="button-enviar">
                <button id="enviar" type="submit">Solicitar</button>
            </div>
        </form>

        

        <div class="button-voltar">
            <a href="..\..\..\php\validacao.php">Voltar</a>
        </div>
    </div>
</div>

</body>
</html>
