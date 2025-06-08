<?php
    session_start();
    require_once "Usuario.php";
    echo $_SESSION['usuario_id'];
    
    if(!isset($_SESSION['usuario_id'])){

        header('Location: ..\index.php');
    }else{

        if ($_SESSION['setor']==="TI"){
           header ("Location: ..\dashboard/telaInicial/telaAdm.php");
           
        }else{
            // echo "Não";
           header ("Location: ..\dashboard/telainicial/telaUsuario.php");
        }
    }

?>