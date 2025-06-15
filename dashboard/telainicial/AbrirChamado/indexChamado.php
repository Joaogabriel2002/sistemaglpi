<?php
session_start();
require_once '..\..\..\php\Chamado.php';
require_once '..\..\..\php\Email.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ..\..\index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = new Email();
    $chamado = new Chamado();

    $chamado->setStatus($_POST['status']);
    $chamado->setTituloChamado($_POST['assunto']);
    $chamado->setDescricaoChamado($_POST['descricao']);
    $chamado->setAutorId($_SESSION['usuario_id']);
    $chamado->setAutorNome($_SESSION['usuario']);
    $chamado->setAutorEmail($_SESSION['email_usuario']);
    $chamado->setAutorSetor($_SESSION['setor']);

    $novoChamadoId = $chamado->abrirChamado();

    if ($novoChamadoId) {
        // Enviar email só se o chamado foi aberto com sucesso
        $destinatario = 'joaoogbriel3meia@gmail.com';
        $assunto = $_POST['assunto'];
        $mensagem = $_POST['descricao'];

        if ($email->enviarEmail($destinatario, $assunto, $mensagem)) {
            // Email enviado
        } else {
            // Email não enviado, mas não bloqueia o fluxo
            error_log("Falha ao enviar email para chamado ID: $novoChamadoId");
        }

        header("Location: chamadoAberto.php?chamadoId=" . $novoChamadoId);
        exit();
    } else {
        echo "Erro ao abrir chamado!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abrir um Chamado</title>
    <link rel="icon" href="../../../img/chesiquimica-logo-png.png" type="image/png">
    
    <link rel="stylesheet" href="../../../css/listarChamados.css">
    <link rel="stylesheet" href="../../../css/base.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@600&display=swap"
        rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="left-section">
            <img src="../../../img/chesiquimica-logo-png.png" alt="Logo Chesiquimica" class="brand-logo">
            <img src="../../../img/chesiquimica-letreiro-png.png" alt="Chesiquimica" class="brand-name">
        </div>
        <div class="right-section">
            <form action="indexChamado.php" method="POST">
                <h2>Abertura de Chamado:</h2>
                <input type="hidden" name="status" value="Aberto">
                <label for="assunto">Assunto do Chamado:</label>
                <br>
                <input type="text" name="assunto">
                <br><br>
                <label for="descricao">Descrição do Chamado</label>
                <br>
                <input type="text" name="descricao">
                
                <br><br>
                <button type="submit"> Abrir um Chamado</button>
            </form>
            <a href="..\..\..\php\validacao.php">Voltar</a>
        </div>

    </div>
</body>

</html>