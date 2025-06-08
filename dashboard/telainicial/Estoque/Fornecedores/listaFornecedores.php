<?php
    session_start();
    require_once '..\..\..\..\php\Fornecedor.php';

    if(!isset($_SESSION['usuario_id'])){
        header ("Location: ..\..\index.php");
    }
    if($_SESSION['setor'] === "TI"){  
        
    }else{
    header ('Location: ..\..\php\validacao.php');
}

    $usuario = new Fornecedor();
    $usuario= $usuario->listarFornecedores();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuarios</title>
    <link rel="icon" href="../../img/chesiquimica-logo-png.png" type="image/png">
    <link rel="stylesheet" href="/gerenciadorti/css/listaUsuarios.css">


</head>
<body>
    <h1>Usuarios Cadastrados:</h1>
    <a href="telaFornecedores.php">Voltar</a>

    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>Email</th>
            <th></th>
        </tr>

        <?php foreach ($usuario as $usuarios)  {?>
            <tr>
                <td><?php echo $usuarios['id'];?></td>
                <td><?php echo $usuarios['nome'];?></td>
                <td><?php echo $usuarios['cnpj'];?></td>
                <td><?php echo $usuarios['email'];?></td>
                <td><a href="detalhesFornecedores.php?id=<?=$usuarios['id']; ?>" >Selecionar</a>
            </tr>

            <?php } ?>
        
</body>
</html>