<?php
session_start();
require_once '..\..\..\php\Tonner.php';  
require_once '..\..\..\php\Imobilizados.php'; // Inclui a classe Imobilizados

if(!isset($_SESSION['usuario_id'])){
    header("Location: ..\..\index.php");
    exit();
}

// Instancia Imobilizados para buscar as impressoras
$imobilizados = new Imobilizados();
$impressorasAtivas = $imobilizados->listarImpressorasAtivas();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tonnerSolicitacao = new Tonner();
    
    $tonnerSolicitacao->setStatus($_POST['status']);
    $tonnerSolicitacao->setAutorId($_SESSION['usuario_id']);
    $tonnerSolicitacao->setAutorNome($_SESSION['usuario']);
    $tonnerSolicitacao->setAutorEmail($_SESSION['email_usuario']);
    $tonnerSolicitacao->setAutorSetor($_SESSION['setor']);
    
    // Recebe o ID da impressora (valor do select)
    $impressoraId = isset($_POST['modeloTonner']) ? $_POST['modeloTonner'] : '';
    $tonnerSolicitacao->setImpressoraId($impressoraId);

    // Opcional: Se quiser guardar o modelo (nome) da impressora junto
    // Você pode buscar no array $impressorasAtivas o modelo pelo ID
    $modeloNome = '';
    foreach ($impressorasAtivas as $imp) {
        if ($imp['id'] == $impressoraId) {
            $modeloNome = $imp['modelo'];
            break;
        }
    }
    $tonnerSolicitacao->setModeloTonner($modeloNome);

    // CorTonner como string
    $corTonnerString = isset($_POST['corTonner']) ? $_POST['corTonner'] : '';
    $tonnerSolicitacao->setCorTonner($corTonnerString);

    $novoChamadoId = $tonnerSolicitacao->solicitarTonner();

    if ($novoChamadoId) {
        header("Location: solicitacaoAberta.php?tonnerSolicitacao=" . $novoChamadoId);
        exit();
    } else {
        echo "Erro ao abrir chamado!";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link rel="stylesheet" href="/gerenciadorti/css/tonner.css" />
    <script src="indexChamadoTonner.js" defer></script>
    <title>Solicitar Tonner</title>
    <link rel="icon" href="../img/chesiquimica-logo-png.png" type="image/png" />
</head>

<body>
    <div class="container">
        <h2>Solicitação de Tonner</h2>
        <form id="tonner" method="POST">
            <input type="hidden" name="status" value="Aberto" />
            <input type="hidden" id="corTonnerHidden" name="corTonner" value="" />

            <div class="modeloTonner">
                <label for="modeloTonner">Modelo da Impressora</label>
                <select id="modeloTonner" name="modeloTonner" required>
                    <option value=""></option>
                    <?php foreach ($impressorasAtivas as $impressora): ?>
                        <option value="<?= htmlspecialchars($impressora['id']) ?>">
                            <?= htmlspecialchars($impressora['modelo']) ?>
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

            <div class="button-enviar">
                <button id="enviar" type="submit">Solicitar</button>
            </div>
        </form>

        <div class="button-voltar">
            <a href="..\..\..\php\validacao.php">Voltar</a>
        </div>
    </div>
</body>
</html>
