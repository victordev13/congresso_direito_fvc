<?php
require_once '../functions.php';
require_once '../adm_functions.php';
require_once '../user_functions.php';
acessoRestrito(1);

$naoLiberado = "";
$nome = "";
$mensagemErro = "";
$liberado = "";

if (isset($_POST['liberar'])) {
    if(!empty($_POST['cpf'])){     
        $cpf = formatarCPF($_POST['cpf']);   
        if(verifyCPF($cpf)){
            if(verifySubscribe($cpf)){
                $res = verificaStatusPagamento($cpf);
                if($res == true){
                    $nome = getNomeInscrito($cpf);
                    $liberado = true;
                    
                }else{
                    $naoLiberado = true;
                    $nome = getNomeInscrito($cpf);
                    $mensagemErro = "Pagamento não efetuado!<br>Favor procurar o setor Financeiro.";
                }
            }else{
                $naoLiberado = true;
                $mensagemErro = "CPF não encontrado, solicite a inscrição no site!";
            }
        }else{
            $naoLiberado = true;
            $mensagemErro = "CPF Inválido!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Congresso de Direito da FVC</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    
</head>

<body class="bg-dark">
<main>
<!-- Modal -->
<div class="modal modal-bg" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Liberar com comprovante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        <input type="hidden" class="form-control mr-sm-3"  name="confirmaCPF" value="<?php echo $cpf;?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name="confirma" class="btn btn-danger">Confirmar Lberação</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- FIM MODAL LIBERAÇÃO -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="../img/fvclogo.png" class="d-inline-block align-top" height="50" alt="">
                </a>
                
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">Inicio <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="#">Item 1<span class="sr-only"></span></a>
                    <a class="nav-item nav-link" href="#">Item 2<span class="sr-only"></span></a>
                    <a href="../logout.php" class="btn btn-fvc my-2 my-lg-0 ml-2 " type="submit">Sair</a>
                </div>
            </div>
        </div>
        </nav>
                    <div class="row justify-content-center align-items-center" style="height:80vh; width: 100%;">
                <div class="card" style="min-width: 600px">
                        <div class="card-body" style="padding: 30px">
                        <p class="my-2 my-sm-0" >Bem vindo, <b> <?php echo $_SESSION['usuario'] ?></b>
                        
                        </p>
                        
                        <hr>
                            <form method="POST" id="formCPF" name="formCPF" class="form-inline justify-content-center align-items-center">
                                <label for="cpf" class="mr-sm-2">CPF:</label>
                                <input type="text" class="form-control mr-sm-3" id="cpf"  name="cpf" placeholder="123.456.789-10">
                                <button type="submit" class="btn btn-fvc mb-4" name="liberar">Confirmar presença</button>
                            </form>
                            <?php

                            if(isset($_POST['confirma'])){
                                $cpf = $_POST['confirmaCPF'];
                                liberaComComprovante($cpf);
                                $liberado = true;
                            }

                            if ($naoLiberado) {
                                echo "<div class='nao-permitido'>ACESSO NÃO PERMITIDO</div>";
                               
                                echo "<div class='mensagem'>";
                                if(!$nome==""){
                                    echo "Nome: ".$nome."<br>";
                                }
            
                                echo "<div class='alert alert-danger alerta-sm' role='alert'>".$mensagemErro."</div>";
                                echo "</div>";

                                echo "<form><button type='button' class='btn btn-secondary my-2 my-lg-0 ml-2' data-toggle='modal' data-target='#modal' data-backdrop='false'>Liberar com comprovante</button></form>";

                            }
                            if ($liberado) {

                                echo "<div class='liberado'>";
                                echo "ACESSO LIBERADO!";
                                echo "</div>";
                                echo "<center>".marcarPresenca($cpf)."</center>";
                            
                            }
                            ?>
                            <div class="row">
                            </div>
                        </div>
                </div>
                
<?php

require_once '../includes/footer_adm.php'
?>