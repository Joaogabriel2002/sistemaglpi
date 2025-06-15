<?php
    // session_start();
    // if(!isset($_SESSION['usuario_id'])){
    //     header("Location:..\index.php");
    // }

    if (isset($_GET['tonnerSolicitacao'])) {
        $tonnerSolicitacao = htmlspecialchars($_GET['tonnerSolicitacao']); // Protege contra XSS
    } else {
        $tonnerSolicitacao = null;
    }
    

        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Solicitação</title>
    <link rel="icon" href="../img/chesiquimica-logo-png.png" type="image/png">
    <link rel="stylesheet" href="/gerenciadorti/css/confirmacaoChamado.css">
</head>
<body>
    <h1>Confirmação de Cadastro</h1>
        <p>Usuário Cadastrado com Sucesso!</p>

        <!-- <p>Erro: O ID do chamado não foi recebido corretamente.</p> -->
    <a href="..\index.php">Voltar</a>
</body>
</html>