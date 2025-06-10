<?php
require_once '..\..\..\..\..\php/Imobilizados.php';

session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../index.php');
    exit;
}

$imobilizado = new Imobilizados();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['AlterarDados'])) {
    $id = $_POST['id'];
    $tipo_id = $_POST['tipo_id'];
    $patrimonio = $_POST['patrimonio'];
    $modelo_id = $_POST['modelo_id'];
    $localizacao = $_POST['localizacao'];
    $nota_fiscal = $_POST['nota_fiscal'];
    $usuario_id = $_POST['usuario_id'];
    $status = $_POST['status'];

    if ($imobilizado->atualizarImobilizado($id, $tipo_id, $patrimonio, $modelo_id, $localizacao, $nota_fiscal, $usuario_id, $status)) {
        echo '<div style="color: green; font-weight: bold; margin-top: 10px;">Dados atualizados com sucesso!</div>';
    } else {
        echo '<div style="color: red; font-weight: bold; margin-top: 10px;">Erro ao atualizar dados.</div>';
    }
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idAtual = $_GET['id'];
} else {
    die('ID do imobilizado inválido ou não fornecido.');
}

$detalhesImobilizado = $imobilizado->listarImobilizadoPorId($idAtual);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Imobilizado</title>
    <link rel="stylesheet" href="..\..\..\..\..\css/cadastro.css">
    <link rel="icon" href="..\..\..\..\..\img/chesiquimica-logo-png.png" type="image/png">
</head>
<body>

<div class="container">
    <!-- <div class="left-section">
        <img src="..\..\..\..\..\img/chesiquimica-logo-png.png" alt="Logo ChesiQuímica" class="brand-logo">
        <img src="..\..\..\..\..\img/chesiquimica-letreiro-png.png" alt="Logo ChesiQuímica" class="brand-name">
    </div> -->

    <div class="right-section">
        <a href="listaimobilizados.php" class="back-link">Voltar</a>
        <h2 class="form-title">Editar Imobilizado</h2>

        <form class="form" method="post">
    <input type="hidden" name="id" value="<?php echo $detalhesImobilizado['id']; ?>">

    <div class="campo-form">
        <label>Modelo:</label>
        <input type="text" name="modelo" value="<?php echo htmlspecialchars($detalhesImobilizado['modelo']); ?>" required>
    </div>

    <div class="campo-form">
        <label>Tipo:</label>
        <input type="text" name="tipo" value="<?php echo htmlspecialchars($detalhesImobilizado['tipo']); ?>" required>
    </div>

    <div class="campo-form">
        <label>Patrimônio:</label>
        <input type="text" name="patrimonio" value="<?php echo htmlspecialchars($detalhesImobilizado['patrimonio']); ?>" required>
    </div>

    <div class="campo-form">
        <label>Nota Fiscal:</label>
        <input type="text" name="nota_fiscal" value="<?php echo htmlspecialchars($detalhesImobilizado['nota_fiscal']); ?>" required>
    </div>

    <div class="campo-form">
        <label>Status:</label>
        <input type="text" name="status" value="<?php echo htmlspecialchars($detalhesImobilizado['status']); ?>" required>
    </div>

    <div class="campo-form">
        <label>Usuário:</label>
        <input type="text" name="usuario_id" value="<?php echo htmlspecialchars($detalhesImobilizado['usuario_id']); ?>" required>
    </div>

    <div class="campo-form">
        <label>Localização:</label>
        <input type="text" name="localizacao" value="<?php echo htmlspecialchars($detalhesImobilizado['localizacao']); ?>" required>
    </div>

    <button type="submit" name="AlterarDados" class="submit-btn">Alterar Dados</button>
</form>


        <br>

        <!-- Botão Excluir -->
        <a href="excluirImobilizado.php?id=<?=$detalhesImobilizado['id']; ?>" 
           onclick="return confirm('Tem certeza que deseja excluir este imobilizado?');" 
           style="display: block; text-align: center; color: white; background-color: red; padding: 10px 0; border-radius: 8px; text-decoration: none; margin-top: 20px;">
            Excluir Imobilizado
        </a>
    </div>
</div>

</body>
</html>
