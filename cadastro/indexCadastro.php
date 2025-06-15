<?php
require_once "..\php/Usuario.php";

$usuarios = new Usuario();
$setores = $usuarios->listarSetores();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $usuario = new Usuario();
    $usuario->setEmail($_POST['email']);
    $resultado = $usuario->verificaExisteEmail();
    $email = $_POST['email'];

    if (count($resultado) > 0 || strlen($email) < 5) {
        echo '<div style="color: red; font-weight: bold; margin-top: 10px; position:absolute;top:5%;">Verifique seu email</div>';
    } else {
        $usuario->setEmail($email);
        $erro = ["nome" => 0, "senha" => 0];

        $nome = $_POST['nome'];
        if (strlen($nome) < 3) {
            $erro['nome'] = 1;
        } else {
            $usuario->setNome($nome);
        }

        $senha1 = sha1($_POST['senha']);
        $senha2 = sha1($_POST['confirmacaoSenha']);

        if ($senha1 == $senha2) {
            $usuario->setSenha($senha1);
        } else {
            $erro["senha"] = 1;
        }

        $setorEscolhido = $_POST['setor'];

        if ($setorEscolhido === "TI") {
            echo '<div style="color: red; font-weight: bold; margin-top: 10px; position:absolute;top:5%;">Você não tem permissão para cadastrar no setor TI.</div>';
        } else {
            $usuario->setSetor($setorEscolhido);

            if (in_array(1, $erro)) {
                echo '<div style="color: red; font-weight: bold; margin-top: 10px; position:absolute;top:5%;">Erro no preenchimento, verifique os campos.!</div>';
            } else {
                if ($usuario->cadastrar()) {
                    header("Location: confirmacaoCadastro.php");
                    exit;
                } else {
                    echo '<div style="color: red; font-weight: bold; margin-top: 10px; position:absolute;top:5%;">Erro ao cadastrar o usuário!!</div>';
                }
            }
        }
    }
}
?>

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - ChesiQuímica</title>
    <link rel="stylesheet" href="../css/cadastro.css">
   
    <link rel="icon" href="../img/chesiquimica-logo-png.png" type="image/png">
</head>

<body>

    <div class="container">
        <!-- Bloco Verde -->
        <div class="left-section">
            <img src="..\img/chesiquimica-logo-png.png" alt="Logo ChesiQuímica" class="brand-logo">
            <img src="..\img/chesiquimica-letreiro-png.png" alt="Logo ChesiQuímica" class="brand-name">
        </div>

        
        <div class="right-section">
            <a href="..\index.php" class="back-link">Voltar</a>
            <h2 class="form-title">Cadastro</h2>

            <form class="form" action="indexCadastro.php" method="POST">
                <div class="campo-form">
                    <label>Nome Completo:</label>
                    <input type="text" name="nome" placeholder="Digite seu nome completo" required>
                </div>
                <div class="campo-form">
                    <label>Email:</label>
                    <input type="email" name="email" placeholder="Digite seu email" required>
                </div>
                <div class="campo-form">
                    <label>Senha:</label>
                    <input type="password" name="senha" placeholder="Digite sua senha" required>
                </div>
                <div class="campo-form">
                    <label>Confirme sua senha:</label>
                    <input type="password" name="confirmacaoSenha" placeholder="Confirme sua senha" required>
                </div>
                <div class="campo-form">
                    <label>Setor:</label>
                    <select name="setor" id="setor" required>
                        <option value=""></option>
                        <?php foreach ($setores as $set): ?>
                        <option value="<?= htmlspecialchars($set['setor']) ?>">
                            <?= htmlspecialchars($set['setor']) ?>
                        </option>
                    <?php endforeach; ?>

                    </select>
                </div>
                <button type="submit" class="submit-btn">Cadastrar-se</button>
            </form>
        </div>
    </div>

</body>

</html>
