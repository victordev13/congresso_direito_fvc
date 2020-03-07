<?php
session_start();

if(isset($_SESSION['logado'])){
    if(isset($_SESSION['usuario']) && isset($_SESSION['nome']) && isset($_SESSION['nivelAcesso'])){
        unset($_SESSION['usuario']);
        isset($_SESSION['nome']);
        isset($_SESSION['nivelAcesso']);    
        header("Location: login.php?logout");
    }
}

