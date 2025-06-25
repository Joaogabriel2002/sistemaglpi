<?php
session_start();
require_once '..\..\..\..\..\..\php\Itens.php';
require_once '..\..\..\..\..\..\php\Imobilizados.php';

if(!isset($_SESSION['usuario_id'])){
    header("Location: ..\..\index.php");
    exit;
}
if($_SESSION['setor'] !== "TI"){  
    header('Location: ..\..\php\validacao.php');
    exit;
}

$item = new Itens();
$equipamento = new Imobilizados();
$equipamentos = $equipamento->listarImpressorasAtivas();

$msg = "";

// pegar dados da URL
$modeloTonnerId = isset($_GET['id']) ? $_GET['id'] : '';
$modeloTonnerNome = isset($_GET['nome']) ? $_GET['nome'] : '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modeloTonner = $_POST['modeloTonner'] ?? '';
    $modeloImpressora = $_POST['modeloImpressora'] ?? '';

    if (!empty($modeloTonner) && !empty($modeloImpressora)) {
        $vinculo = new Itens();
        $vinculo->setImpressoraId($modeloImpressora);
        $vinculo->setModeloId($modeloTonner);

        $resultado = $vinculo->vincularItem();

        if ($resultado) {
            $msg = "Vinculação realizada com sucesso! ID gerado: " . $resultado;
        } else {
            $msg = "Falha ao vincular item.";
        }
    } else {
        $msg = "Por favor, selecione um modelo de tonner e uma impressora.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Solicitar Tonner</title>
    <link rel="icon" href="../../../img/chesiquimica-logo-png.png" type="image/png" />
    <link rel="stylesheet" href="/sistemaglpi/css/base.css" />
    <link rel="stylesheet" href="/sistemaglpi/css/tonner.css" />
</head>

<body>

<div class="container">
    <div class="left-section">
        <img src="../../../../../../img/chesiquimica-logo-png.png" class="brand-logo" alt="Logo Chesiquímica" />
        <img src="../../../../../../img/chesiquimica-letreiro-png.png" class="brand-name" alt="Logo Chesiquímica" />
    </div>

    <div class="right-section">
        <?php if (!empty($msg)): ?>
            <div style="margin-top:20px; padding:10px; background-color:#f0f0f0; color:#333; border:1px solid #ccc; border-radius:5px;">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <h2>Vincular Suprimento</h2>
        <form id="tonner" action="vincularItem.php?id=<?= urlencode($modeloTonnerId) ?>&nome=<?= urlencode($modeloTonnerNome) ?>" method="POST">

            <div class="modeloTonner">
                <input type="hidden" id="modeloTonnerId" name="modeloTonner" value="<?= htmlspecialchars($modeloTonnerId) ?>" readonly required>
            </div>

            <div class="campo-form">
                <label for="modeloTonnerNome">Nome do Tonner</label>
                <input type="text" id="modeloTonnerNome" value="<?= htmlspecialchars($modeloTonnerNome) ?>" readonly>
            </div><br>

            <div class="modeloImpressora">
                <label for="modeloImpressora">Modelo da Impressora</label>
                <select id="modeloImpressora" name="modeloImpressora" required>
                    <option value=""></option>
                    <?php foreach ($equipamentos as $eqp): ?>
                        <option value="<?= htmlspecialchars($eqp['idEquipamento']) ?>">
                            <?= htmlspecialchars($eqp['descricaoEquipamento']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <br>
            <div class="button-enviar">
                <button id="enviar" type="submit">Vincular</button>
            </div>
        </form>

        <div class="button-voltar">
            <a href="listaItens.php">Voltar</a>
        </div>
    </div>
</div>

</body>
</html>
