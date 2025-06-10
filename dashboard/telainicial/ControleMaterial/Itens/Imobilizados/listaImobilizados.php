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
    <link rel="icon" href="../../../../../img/chesiquimica-logo-png.png" type="image/png">
    
        <link rel="stylesheet" href="../../../../../css/listaUsuario.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@600&display=swap"
        rel="stylesheet">
<style>
        body {
            font-family: poppins;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
    </style>
</head>
<body>
    <h1>Estoque Atual:</h1>
    <a href="imobilizados.php">Voltar</a>

    <table border="1">
    <tr>
        <th>Patrimônio</th>
        <th>Modelo</th>
        <th>Tipo</th>
        <th>Status</th>
        <th>Ações</th>

    </tr>

    <?php foreach ($imobilizado as $imb) { ?>
        <tr>
            <td><?= htmlspecialchars($imb['patrimonio']) ?></td>
            <td><?= htmlspecialchars($imb['modelo']) ?></td>
            <td><?= htmlspecialchars($imb['tipo']) ?></td>
            <td><?= htmlspecialchars($imb['status']) ?></td>
            <td><a href="detalhesImobilizados.php?id=<?= $imb['id']; ?>">&#9998;</a></td>
        </tr>
    <?php } ?>
</table>


</body>
</html>
