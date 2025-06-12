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
$itens = $item->listarItens();
$equipamentos = $equipamento->listarImpressorasAtivas();

$msg = "";  // variável para mensagem de feedback

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
    <script src="indexChamadoTonner.js" defer></script>
    <title>Solicitar Tonner</title>
    <link rel="icon" href="../../../img/chesiquimica-logo-png.png" type="image/png" />
    <link rel="stylesheet" href="../../../../../../css/base.css" />
    <link rel="stylesheet" href="../../../../../../css/tonner.css" />
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
        <form id="tonner" action="vincularItem.php" method="POST">

            <div class="modeloTonner">
                <label for="modeloTonner">Modelo de Tonner</label>
                <select id="modeloTonner" name="modeloTonner" required>
                    <option value=""></option>
                    <?php foreach ($itens as $its): ?>
                        <option value="<?= htmlspecialchars($its['id']) ?>">
                            <?= htmlspecialchars($its['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

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
            <a href="..\..\..\php\validacao.php">Voltar</a>
        </div>
    </div>
</div>

</body>
</html>
