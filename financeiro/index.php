<?php
require_once '../functions.php';
require_once '../adm_functions.php';
require_once '../user_functions.php';
acessoRestrito(0);

$erro = "";
$mensagem = "";

if (isset($_POST['buscar'])) {
    if(!empty($_POST['cpf'])){     
        $cpf = formatarCPF($_POST['cpf']);   
        if(verifyCPF($cpf)){
            if(verifySubscribe($cpf)){
                $res = verificaStatusPagamento($cpf);
                if($res == true){
                    $erro = "Pagamento já realizado!";
                    $showInfoPagamento = 1;
                    }else{
                        $showData = 1;
                        $showButtonConfirmar = 1;
                    }
                }else{
                    $erro = "CPF não encontrado, solicite a inscrição no site!";
                }
            }else{
                $erro = "CPF Inválido, digite corretamente";
            }
    }
}
if(isset($_POST['confirmar'])){
    $cpf = $_POST['cpf'];
    
    if(validaPagamento($cpf)){
        $mensagem = "Pagamento Efetuado com Sucesso!";
    }else{
        $mensagem = "erro";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição - Congresso de Direito da FVC</title>
    <link rel="stylesheet" type="text/css" href="/congresso_direito_fvc/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/congresso_direito_fvc/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="/congresso_direito_fvc/css/style.css">
    <link rel="shortcut icon" href="/congresso_direito_fvc/img/favicon.ico" type="image/x-icon">
</head>

<body class="bg-dark">
    <main>
        <nav class="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="/congresso_direito_fvc/img/fvclogo.png" class="d-inline-block align-top" height="50" alt="">
                </a>
                    <p class="">Olá, <?php echo $_SESSION['usuario'] ?></p>

                <a href="../logout.php" class="btn btn-fvc my-2 my-sm-0" type="submit">Sair</a>
            </div>
        </nav>
                    <div class="row justify-content-center align-items-center" style="height:80vh; width: 100%;">
                <div class="card" style="min-width: 600px">
                    <div class="card-body">
                        <div class="card-body">
                            <form method="POST" id="formCPF" name="formCPF" class="form-inline justify-content-center align-items-center">
                                <label for="cpf" class="mr-sm-2">CPF:</label>
                                <input type="text" class="form-control mr-sm-3" id="cpf"  name="cpf" placeholder="123.456.789-10">
                                <button type="submit" class="btn btn-fvc mb-4" name="buscar">Buscar</button>
                            </form>
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
                            <div class="row">
                                
                                <?php if(isset($showData)) { ?>
                                    <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Período/Visitante</th>
                                        <th scope="col">Status Pagamento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php

                                        echo "<th>".getNome($cpf)."</td>";
                                        echo "<td></td>";
                                        echo "<td></td>";

                                        ?>
                                        </tr>

                                    </tbody>
                                    </table>
                                <?php } ?>
<!-- DADOS DO PAGAMENTO REALIZADO-->
                                <?php if(isset($showInfoPagamento)) { ?>
                                    <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        Descricao:
                                        <th scope="col">Nome</th>
                                        <th>Data/Hora</th>
                                        <th>Usuário</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php

                                        echo "<th>".getNome($cpf)."</td>";
                                        echo "<td>".getDataPagamento($cpf)."</td>";
                                        echo "<td>".getUsuarioPagamento($cpf)."</td>";

                                        ?>
                                        </tr>

                                    </tbody>
                                    </table>
                                <?php } ?>

                                <?php if(isset($showButtonConfirmar)) { ?>
                                    <form method="POST"><input type="hidden" name="cpf" id="confirma_cpf" value="<?php echo $cpf; ?>"><button type="submit" class="btn btn-fvc mb-4" name="confirmar">Confirmar Pagamento</button></form>
                               <?php }?>
                            </div>
                        </div>
                    </div>
                </div>

<?php
require_once '../includes/footer_adm.php'
?>