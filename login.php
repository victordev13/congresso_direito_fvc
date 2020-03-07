<?php
require_once 'includes/header.php';
require_once 'functions.php';
require_once 'classes/usuario.class.php';

session_start();

$mensagem = "";
$erro = "";

if(isset($_POST['login'])){
    if(isset($_POST['usuario']) && isset($_POST['senha'])){
        $usuario = formata($_POST['usuario']);
        $senha = md5($_POST['senha']);
        $login = Usuario::login($usuario, $senha);

        if($login){
            $_SESSION['logado'] = true;
            $_SESSION['login'] = $login;
            $_SESSION['nome'] = Usuario::getNome($usuario);
            $SESSION['nivelAcesso'] = Usuario::getNivelAcesso($usuario);
            goToPainel();
        }else{
            $erro = "Usuário e/ou Senha inválidos<br>
                Entre em contato com o administrador do sistema";
        }
    }
}
?>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/fvclogo.png"  class="d-inline-block align-top" height="50" alt="">
            </a>
            <a href="index.php" class="btn btn-fvc my-2 my-sm-0" type="submit">Voltar</a>
        </div>
    </nav>
<body class="bg-dark">
    <div class="row justify-content-center align-items-center" style="height:80vh; width: 100%">
        <div class="card login">
            <div class="card-body"> 
            		<img src="img/fvclogo.png" class="logo-form rounded mx-auto d-block" style="width: 300px">
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