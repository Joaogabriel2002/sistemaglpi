<?php
session_start();
require_once '..\..\..\..\..\php\Imobilizados.php';

if(!isset($_SESSION['usuario_id'])){
    header ("Location: ..\..\index.php");
}
if($_SESSION['setor'] !== "TI"){  
    header ('Location: ..\..\php\validacao.php');
}

$imobilizados = new Imobilizados();
$imobilizado = $imobilizados->listarImobilizados();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque Atual</title>
    <link rel="icon" href="../../img/chesiquimica-logo-png.png" type="image/png">
    <link rel="stylesheet" href="/gerenciadorti/css/listaUsuarios.css">
</head>
<body>
    <h1>Estoque Atual:</h1>
    <a href="imobilizados.php">Voltar</a>

    <table border="1">
    <tr>
        <th>Patrimônio</th>
        <th>Modelo</th>
        <th>Status</th>
        <th></th>
    </tr>

    <?php foreach ($imobilizado as $imb) { ?>
        <tr>
            <td><?= htmlspecialchars($imb['patrimonio']) ?></td>
            <td><?= htmlspecialchars($imb['modelo']) ?></td>
            <td><?= htmlspecialchars($imb['status']) ?></td>
            <td>Selecionar</td>
        </tr>
    <?php } ?>
</table>


</body>
</html>
