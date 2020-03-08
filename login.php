<?php

require_once 'functions.php';
require_once 'classes/usuario.class.php';
/*
****DESCRICAO DOS NIVEIS DE ACESSO****
    Financeiro: 0
    Administrador: 1
*/
session_start();

$mensagem = "";
$erro = "";

if (isset($_POST['login'])) {
    if (isset($_POST['usuario']) && isset($_POST['senha'])) {
        $usuario = $_POST['usuario'];
        $senha = md5($_POST['senha']);
        $login = Usuario::login($usuario, $senha);

        if ($login === true) {
            if (!isset($_SESSION['logado'])) {
                $_SESSION['logado'] = true;
                $_SESSION['login'] = $login;
                $_SESSION['nome'] = Usuario::getNome($usuario);
                $_SESSION['nivelAcesso'] = Usuario::getNivelAcesso($usuario);
                echo "<script>console.log('set sessions = true')";
                direcionaParaPainel();
            }
        } else {
            $erro = "Usuário e/ou Senha inválidos<br>";
        }
    }
}

if (isset($_SESSION['logado'])) {
    $linkAcesso = "<a href='" . getPainel() . "'>Acessar</a>";
    $mensagem = "Já está logado " . $linkAcesso . "/<a href='logout.php'>Sair</a>";
}

if (isset($_GET['logout']) && !isset($_SESSION['logado'])) {
    $mensagem = "Logout efetuado com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição - Congresso de Direito da FVC</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>

<body class="bg-dark">
    <main>
        <nav class="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="img/fvclogo.png" class="d-inline-block align-top" height="50" alt="">
                </a>
                <a href="index.php" class="btn btn-fvc my-2 my-sm-0" type="submit">Voltar</a>
            </div>
        </nav>


        <body class="bg-dark">
            <div class="row justify-content-center align-items-center" style="height:80vh; width: 100%">
                <div class="card login">
                    <div class="card-body direito">
                        <div class="card-body">
                            <?php
                            if (!$erro == "") {
                                echo "<div class='alert alert-danger alerta-sm' role='alert'>";
                                echo $erro;
                                echo "</div>";
                            }
                            if (!$mensagem == "") {
                                echo "<div class='alert alert-warning alerta-sm' role='alert'>";
                                echo $mensagem;
                                echo "</div>";
                            }
                            ?>
                            <form method="POST" id="formLogin" name="formLogin">
                                <div class="form-group mt-4" id="campoUsuario">
                                    <input type="text" class="form-control" id="usuario" placeholder="Nome de Usuário" name="usuario" minlength=4 maxlength=20 required="">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha" required="" minlength=6 maxlength=12>
                                </div>
                                <button type="submit" class="btn btn-lg btn-block btn-fvc mb-3" name="login">Login</button>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                require_once 'includes/footer.php';
                ?>