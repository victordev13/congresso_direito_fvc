<?php
session_start();

if(isset($_SESSION['logado'])){
    if(isset($_SESSION['usuario']) && isset($_SESSION['nome']) && isset($_SESSION['nivelAcesso'])){
        unset($_SESSION['usuario']);
        unset($_SESSION['nome']);
        unset($_SESSION['nivelAcesso']);    
        session_destroy();
        header("Location: login.php?logout");
    }else{
        unset($_SESSION['logado']);
        session_destroy();
        header("Location: login.php?logout");
    }
}else{
    header("Location: login.php");
}

