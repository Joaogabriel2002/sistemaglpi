<?php
    session_start();

    if(!isset($_SESSION['usuario_id'])){
        header ('Location: ..\..\index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Usuario</title>
    <link rel="icon" href="img/chesiquimica-logo-png.png" type="image/png">
    <link rel="stylesheet" href="../../css/userteste.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@600&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="left-section">
            <img src="../../img/chesiquimica-logo-png.png" alt="Logo ChesiQuímica" class="brand-logo">
            <img src="../../img/chesiquimica-letreiro-png.png" alt="Logo ChesiQuímica" class="brand-name">
        </div>

        <div class="right-section">
            <div class="title-right">
                <h1>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h1>
            </div>

            <div class="botoes">
                <a href="AbrirChamado/indexChamado.php" class="opcoes alongado">Abrir um Chamado</a>
                <a href="SolicitarTonner\indexChamadoTonner.php" class="opcoes alongado">Solicitar Tonner</a>
                
                <a href="AbrirChamado\listarChamadosPorId.php" class="opcoes">Listar Chamados</a>
                <a href="SolicitarTonner\listarTonnerPorId.php" class="opcoes">Listar Solicitações tonner</a>
                


                <a href="..\..\login\logoff.php" class="opcoes alongado sair">Sair</a>
            </div>
        </div>
    </div>
</body>

</html>
