<?php
session_start();
require_once '..\..\..\..\..\..\php\Estoque.php';

if(!isset($_SESSION['usuario_id'])){
    header ("Location: ..\..\index.php");
}
if($_SESSION['setor'] !== "TI"){  
    header ('Location: ..\..\php\validacao.php');
}

$movimentacao = new Estoque();
$movimentacoes = $movimentacao->listarMovimentacoes();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque Atual</title>
    <link rel="icon" href="../../img/chesiquimica-logo-png.png" type="image/png">
    <link rel="stylesheet" href="/sistemaglpi/css/listaUsuarios.css">
</head>
<body>
    <h1>Movimentações Gerais:</h1>
    <a href="MovimentacaoEstoque.php">Voltar</a>

    <table border="1">
    <tr>
        <th>Data Movimentação</th>
        <th>Item</th>
        <th>Tipo de Movimentação</th>
        <th>Quantidade</th>
        <th>Motivo</th>
        <th>Usuário</th>
    </tr>

    <?php foreach ($movimentacoes as $mov) { ?>
        <tr>
            <td><?= htmlspecialchars($mov['data_movimentacao']) ?></td>
            <td><?= htmlspecialchars($mov['nomeItem']) ?></td>
            <td><?= htmlspecialchars($mov['tipo_movimentacao']) ?></td>
            <td><?= htmlspecialchars($mov['quantidade']) ?></td>
            <td><?= htmlspecialchars($mov['motivo']) ?></td>
            <td><?= htmlspecialchars($mov['usuario']) ?></td>

            <!-- <td><a href="detalhesImobilizados.php?id=<?= $mov['id']; ?>">&#9998;</a></td> -->
        </tr>
    <?php } ?>
</table>


</body>
</html>
