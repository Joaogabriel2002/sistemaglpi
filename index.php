<?php
session_start();
$login_error_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'php/Usuario.php';

    $email = $_POST['email'];
    $senha = sha1($_POST['senha']);

    $usuario = new Usuario();
    $usuario->setEmail($email);
    $usuario->setSenha($senha);
    $resultado = $usuario->login();

    if ($resultado) {
        $_SESSION['usuario_id'] = $resultado['id'];
        $_SESSION['usuario'] = $resultado['primeiro_nome'] = explode(" ", $resultado['nome'])[0];
        $_SESSION['email_usuario'] = $email;
        $_SESSION['setor'] = $resultado['setor'];
        header('Location:php\validacao.php');

    } else {
         $login_error_message = "Verifique seu email e senha, por favor!";
    }
    
}


?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chesiquimica - Login</title>
    <link rel="icon" href="img/chesiquimica-logo-png.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/headerLogin.css">
    <link rel="stylesheet" href="css/base.css">
</head>

<body>
    <div class="container">
        <div class="left-section">
            <img src="img/chesiquimica-logo-png.png" alt="Logo Chesiquimica" class="brand-logo">
            <img src="img/chesiquimica-letreiro-png.png" alt="Chesiquimica" class="brand-name">

        </div>
        <div class="right-section">
            <?php if (!empty($login_error_message)): ?>
                <p class="error-message"><?php echo $login_error_message; ?></p>
            <?php endif; ?>
            <h1 class="login-title">LOGIN </h1>

            <form class="login-form" action="index.php" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" placeholder="seuemail@exemplo.com" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" placeholder="********" required >
                </div>
                <div >
                    <button type="submit" name="enviar" class="btn-login"> Logar</button>
                    <p class="signup-text">AINDA NÃO CRIOU SUA CONTA? <a href="cadastro/indexCadastro.php" class="signup-link">CADASTRE-SE</a></p>
                </div>
            </form>

        </div>
    </div>
</body>

</html>