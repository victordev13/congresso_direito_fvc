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
                    $erro = "Pagamento já foi realizado anteriormente!";
                    $showInfoPagamento = 1;
                    }else{
                        $showData = 1;
                        $showButtonConfirmar = 1;
                    }
                }else{
                    $erro = "CPF não encontrado, solicite a inscrição no site!";
                }
            }else{
                $erro = "CPF Inválido, digite corretamente!";
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
    <title>Financeiro - Congresso de Direito da FVC</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>

<body class="bg-dark">
    <main>
        <nav class="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="../img/fvclogo.png" class="d-inline-block align-top" height="50" alt="">
                </a>
                <a href="../logout.php" class="btn btn-fvc my-2 my-sm-0" type="submit">Sair</a>
            </div>
        </nav>
                    <div class="row justify-content-center align-items-center" style="height:80vh; width: 100%;">
                <div class="card" style="min-width: 600px">
                    <div class="card-body">
                        <div class="card-body">
                        <p class="my-2 my-sm-0" >Bem vindo, <b> <?php echo $_SESSION['usuario'] ?></b></p><hr>
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
                                echo "<div class='alert alert-success alerta-sm' role='alert'>";
                                echo $mensagem;
                                echo "</div>";
                            }
                            ?>
                            <div class="row">
                                
                                <?php if(isset($showData)) { ?>
                                    <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">Inscrito</th>
                                        <th>Período/Visitante</th>
                                        <th>Status Pagamento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php

                                        echo "<th>".getNomeInscrito($cpf)."</td>";
                                        echo "<td>".getPeriodo($cpf)."</td>";
                                        echo "<td>".getStatusPagamento($cpf)."</td>";

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
                                        <th scope="col">Inscrito</th>
                                        <th>Data do pagamento</th>
                                        <th>Usuário Responsável</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php

                                        echo "<th>".getNomeInscrito($cpf)."</td>";
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