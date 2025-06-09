<?php
require_once '..\..\..\..\..\php/Imobilizados.php';
require_once '..\..\..\..\..\php/Usuario.php';
$msg = "";

// if(!isset($_SESSION['usuario_id'])){
//     header("Location:..\..\index.php");
//     exit();
// }


$imobilizado = new Imobilizados();
$usuario = new Usuario();
$usuarios = $usuario->listarUsuarios();
$modelos= $imobilizado->buscarModelos();
$setor= $imobilizado->buscarSetores();



if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $imobilizado = new Imobilizados;
    $imobilizado->setModelo($_POST['modelo']);
    $imobilizado->setPatrimonio($_POST['patrimonio']);
    $imobilizado->setModelo($_POST['modelo']);
    $imobilizado->setLocalizacao($_POST['localizacao']);
    $imobilizado->setNotaFiscal($_POST['nota_fiscal']);
    $imobilizado->setUsuarioId($_POST['usuario']);
    $imobilizado->setStatus($_POST['status']);


    $imobilizado->cadastrar();
    $erros = 0;
    if ($erros > 0) {
        $msg = "Erro ao cadastrar $erros item(s).";
    } else {
        $msg = "Item cadastrado com sucesso!";
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
    <link rel="stylesheet" href="../../../../../css/incluirEstoque.css" />
</head>

<body>


<div class="container">
    <div class="left-section">
        <img src="../../../../../img/chesiquimica-logo-png.png" alt="Logo ChesiQuímica" class="brand-logo" />
        <img src="../../../../../img/chesiquimica-letreiro-png.png" alt="Logo ChesiQuímica" class="brand-name" />
    </div>

    <div class="right-section">
        <a href="imobilizados.php" class="back-link">Voltar</a>
        <?php if ($msg) : ?>
            <div class="mensagem-feedback"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>
        <h2 class="form-title">Cadastro</h2>

        <form class="form" action="incluirImobilizados.php" method="POST" id="form-estoque">
            <div class="campo-form">
                <label for="modeloTonner">Modelo:</label>
                <select id="modelo" name="modelo" required>
                    <option value=""></option>
                    <?php foreach ($modelos as $mdl): ?>
                        <option value="<?= htmlspecialchars($mdl['idEquipamento']) ?>">
                        <?= htmlspecialchars($mdl['descricaoEquipamento']) ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>


            <div id="itens-container">
                <div class="campo-form item-row">
                    <label>Nrº Patrimônio</label>               
                    <input type="text" id="patrimonio" name="patrimonio" required>
                </div>

            <div class="campo-form">
                <label for="localizacao">Setor:</label>
                <select id="localizacao" name="localizacao" required>
                    <option value=""></option>
                    <?php foreach ($setor as $st): ?>
                        <option value="<?= htmlspecialchars($st['setor']) ?>">
                        <?= htmlspecialchars($st['setor']) ?>
                        </option>
                    <?php endforeach; ?>

                </select><br><br>
            </div>

            <div class="campo-form item-row">
                    <label>Nrº NFe</label>               
                    <input type="text" id="nota_fiscal" name="nota_fiscal" required>
                </div><br>
                <div class="campo-form">
                <label for="setor">Usuario(se houver):</label>
                <select id="usuario" name="usuario" required>
                    <option value=""></option>
                    <?php foreach ($usuarios as $user): ?>
                        <option value="<?= htmlspecialchars($user['id']) ?>">
                        <?= htmlspecialchars($user['nome']) ?>
                        </option>
                    <?php endforeach; ?>

                </select><br><br>
            </div>
            <div class="campo-form">
                <label for="status">Situação:</label>
                <select id="status" name="status" required>
                    <option value=""></option>
                    <option value="ativo">Ativo</option>
                    <option value="em_manutencao">Em manutenção</option>
                    <option value="reservado">Reservado</option>
                    <option value="emprestado">Emprestado</option>
                    <option value="disponivel">Disponível</option>
                    <option value="perdido">Perdido</option>
                    <option value="sucata">Sucata</option>
                </select>
            </div>

                
            <br><button type="submit" class="submit-btn">Cadastrar</button>
        </form>
    </div>
</div>
</body>

</html>
