<?php
session_start();
require_once '..\..\..\..\..\..\php\Itens.php';

if(!isset($_SESSION['usuario_id'])){
    header ("Location: ..\..\index.php");
}
if($_SESSION['setor'] !== "TI"){  
    header ('Location: ..\..\php\validacao.php');
}

$item = new Itens();
$itens = $item->listarItens();
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
    <h1>Itens Cadastrados:</h1>
    <a href="..\estoque.php">Voltar</a>

    <table border="1">
        <tr>
            
            <th>Nome</th>
            <th>Tipo</th>
            <th>Opções  </th>
            <th>Vincular</th>
            
        </tr>

        <?php foreach ($itens as $item) { ?>
            <tr>
        
                <td><?php echo $item['nome']; ?></td>
                <td><?php echo $item['tipo']; ?></td>
                <td><a href="movimentacoesItens.php?id=<?= $item['id']; ?>">Movimentações</a></td>
                <td><a href="vincularItem.php?id=<?= $item['id']; ?>&nome=<?=urlencode($item['nome']);?>">Vincular</a></td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>
