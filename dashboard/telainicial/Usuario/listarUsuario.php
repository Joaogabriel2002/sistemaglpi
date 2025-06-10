<?php
session_start();
require_once '..\..\..\php\Usuario.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ..\..\index.php");
}
if ($_SESSION['setor'] === "TI") {

} else {
    header('Location: ..\..\php\validacao.php');
}

$usuario = new Usuario();
$usuario = $usuario->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuarios</title>
    <link rel="icon" href="../../img/chesiquimica-logo-png.png" type="image/png">
    <link rel="stylesheet" href="../../../css/listaUsuario.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@600&display=swap"
        rel="stylesheet">

</head>

<body>
    <div class="container">

        <div class="textos">
            <h1>Usuarios Cadastrados:</h1>
            <a class="voltar"href="..\..\..\php\validacao.php">&#8592;</a>
        </div>


        <table border="1">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Setor</th>
                <th>Ações</th>
            </tr>

            <?php foreach ($usuario as $usuarios) { ?>
                <tr>
                    <td><?php echo $usuarios['id']; ?></td>
                    <td><?php echo $usuarios['nome']; ?></td>
                    <td><?php echo $usuarios['email']; ?></td>
                    <td><?php echo $usuarios['setor']; ?></td>
                    <td><a href="detalhesUsuarios.php?id=<?= $usuarios['id']; ?>">&#9998;</a>
                </tr>

            <?php } ?>

    </div>
</body>

</html>