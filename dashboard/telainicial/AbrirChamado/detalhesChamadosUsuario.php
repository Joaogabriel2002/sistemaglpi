<?php
require_once '../../../php/Chamado.php';



session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../index.php');
    exit;
}


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $chamadoId = $_GET['id'];
} else {
    die('ID do chamado inválido ou não fornecido.'); 
} 

$idAtual= $_GET['id'];
$chamado = new Chamado();
$detalhesChamado = $chamado->listarChamadosporId2($idAtual);



$atualizacoesChamado = $chamado->listarAtualizacoesPorChamado($chamadoId);


//var_dump($atualizacoesChamado);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Chamado</title>
    <link rel="icon" href="../../img/chesiquimica-logo-png.png" type="image/png">
    <link rel="stylesheet"href="/gerenciadorti/css/detalhesTonner.css">
</head>
<body>

    <h1>Detalhes do Chamado:</h1>
    <br><br>

    <table border="1">
        <tr>
            <th>ID do Chamado</th>
            <th>Status</th>
            <th>Prioridade</th>
            <th>Data de Abertura</th>
            <th>Data de Fechamento</th>
            
            <th>Titulo Chamado</th>
            <th>Descrição</th>
            <th>Usuario</th>
            <th>Email</th>
            <th>Setor</th>
            
        </tr>

        <tr>
            <td><?php echo $detalhesChamado['chamadoId']; ?></td>
            <td><?php echo $detalhesChamado['status']; ?></td>
            <td><?php echo $detalhesChamado['tipoChamado']; ?></td>
            <td><?php echo $detalhesChamado['dtAbertura']; ?></td>
            <td><?php echo $detalhesChamado['dtFechamento']; ?></td>
            <td><?php echo $detalhesChamado['tituloChamado']; ?></td>
            <td><?php echo $detalhesChamado['descricaoChamado']; ?></td>
            <td><a href="detalhesUsuario.php?id=<?php echo $detalhesChamado['autorId']; ?>"><?php echo $detalhesChamado['autorNome']; ?></a></td>
            <td><?php echo $detalhesChamado['autorEmail']; ?></td>
            <td><?php echo $detalhesChamado['autorSetor']; ?></td>
            <!-- <td><a href="detalhesChamados.php?id=<?=$chamados['chamadoId']; ?>">Selecionar</a></td> -->

        </tr>

    </table>

    <h2>Atualizações do Chamado</h2>

    <?php


if (!empty($atualizacoesChamado)) {
    echo '<table border="1" cellpadding="5" cellspacing="0">';
    echo '<thead>
            <tr>
                <th>Data da Atualização</th>
                <th>Técnico</th>
                <th>Comentário</th>

            </tr>
          </thead>';
    echo '<tbody>';

    foreach ($atualizacoesChamado as $atualizacao) {
        ?>
        <tr>
            <td><?= htmlspecialchars($atualizacao['dt_atualizacao']); ?></td>
            <td><?= htmlspecialchars($atualizacao['tecnico']); ?></td>
            <td><?= nl2br(htmlspecialchars($atualizacao['comentario'])); ?></td>

        </tr>
        <?php
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo "<p>Nenhuma atualização encontrada para este chamado.</p>";
}

echo "<br>";
echo "<a href=\"listarChamadosPorId.php\">Voltar</a>";
?>

</body>
</html>
