<?php
require_once '..\..\..\php/Tonner.php';



session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location:../../index.php');
    exit;
}



$statusFiltro = isset($_GET['status']) ? $_GET['status'] : '';
$idFiltro = isset($_GET['tonnerId']) ? $_GET['tonnerId'] : '';


$tonner= new Tonner();



// var_dump ($tonners);
if(empty($idFiltro)){
    $tonners = $tonner->listarTodosTonnerPorId($_SESSION['usuario_id'],$statusFiltro, $idFiltro);
    }else{
        $tonners = $tonner->listarTonnerPorTicket2($_SESSION['usuario_id'],$idFiltro);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Chamados Tonner</title>
    <link rel="icon" href="../img/chesiquimica-logo-png.png" type="image/png">
    <link rel="stylesheet" href="../../../css/listagem.css">
</head>
<body>
    <div class="container">
        <div class="textos">
            <h1>Lista de Solicitação Tonner</h1>
            <a class="voltar" href="..\..\..\php\validacao.php">&#8592;</a>
        </div>

        <div class="filtros-container">
            <div class="filtroStatus">
                <form action="listarTonnerPorId.php" method="GET">
                    <label for="status">Filtrar por Status:</label>
                    <select name="status" id="status">
                        <option value="">Pendentes</option>
                        <option value="Todos" <?php echo isset($_GET['status']) && $_GET['status'] == 'Todos' ? 'selected' : ''; ?>>Todos</option>
                        <option value="Aberto" <?php echo isset($_GET['status']) && $_GET['status'] == 'Aberto' ? 'selected' : ''; ?>>Abertos</option>
                        <option value="Fechado" <?php echo isset($_GET['status']) && $_GET['status'] == 'Fechado' ? 'selected' : ''; ?>>Fechados</option>
                        <option value="Em Andamento" <?php echo isset($_GET['status']) && $_GET['status'] == 'Em Andamento' ? 'selected' : ''; ?>>Em andamento</option>
                        <option value="Cancelado" <?php echo isset($_GET['status']) && $_GET['status'] == 'Cancelado' ? 'selected' : ''; ?>>Cancelados</option>
                    </select>
                    <button type="submit">Filtrar</button>
                </form>
            </div>

            <div class="filtroTicket">
                <form action="listarTonnerPorId.php" method="GET">
                    <label for="tonnerId">Filtrar por Ticket:</label>
                    <input type="number" name="tonnerId" value="<?php echo isset($_GET['tonnerId']) ? $_GET['tonnerId'] : ''; ?>">
                    <button type="submit">Filtrar</button>
                </form>
            </div>
        </div>

        <br><br>

        <table>
            <tr>
                <th>Nº Solicitação</th>
                <th>Status</th>
                <th>Data de Abertura</th>
                <th>Modelo</th>
            
                <th>Usuario</th>
                <th>Situação</th>
                <th>Ações</th>
            </tr>

            <?php
            foreach ($tonners as $tonner) {
            ?>
            <tr>
                <td><?php echo $tonner['solicitacaoId']; ?></td>
                <td><?php echo $tonner['status']; ?></td>
                <td><?php echo $tonner['dtAbertura']; ?></td>
                <td><?php echo $tonner['nome']; ?></td>
       
                <td><?php echo $tonner['autorNome']; ?></td>
                <td><?php echo $tonner['situacao']; ?></td>
                <td><a href="detalhesTonnerId.php?id=<?= $tonner['solicitacaoId']; ?>">Selecionar</a></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>
