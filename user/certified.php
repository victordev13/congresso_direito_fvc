<?php
require_once '../functions.php';
include('./checkLogin.php');

@session_start();

$id_subscribe = $_SESSION['id_subscribe'];
if (isset($_POST['baixar'])) {
  header("location: gerar_certificado/gerador.php?id=".$id_subscribe);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Certificado - Congresso de Direito da FVC</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">

  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/css/demo.css" rel="stylesheet" />

  <!-- Fonts and Icons -->
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
  <link href="../assets/css/themify-icons.css" rel="stylesheet">

</head>

<body class="bg-dark">
  <main>
    <nav class="navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="../img/fvclogo.png" class="d-inline-block align-top" height="50" alt="">
        </a>
        <a href="../login.php" class="btn btn-fvc my-2 my-sm-0" type="submit">Acesso restrito</a>
      </div>
    </nav>

    <!-- removi o menu desse arquivo pois algumas telas precisam somente da inclusao de js e css-->
    <!--   Big container   -->
    
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <!--      Wizard container        -->
          <div class="wizard-container">
            <div class="card wizard-card" data-color="green" id="wizardProfile">
              <form action="" method="POST">
                <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->
                <div class="wizard-header text-center">
                  <h3 class="wizard-title">Certificado</h3>
                  <p class="category">Obtenha seu certificado</p>
                </div>

                <div class="wizard-navigation">
                  <div class="progress-with-circle">
                    <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                  </div>
                  <ul>
                    <li>
                      <a href="../index.php" data-toggle="tab" aria-expanded="false">
                        <div class="icon-circle checked">
                          <i class="ti-user"></i>
                        </div>
                        INSCRIÇÃO
                      </a>
                    </li>
                    <li>
                      <a href="index.php" data-toggle="tab" aria-expanded="false">
                        <div class="icon-circle checked">
                          <i class="ti-settings"></i>
                        </div>
                        STATUS
                      </a>
                    </li>
                    <li class="active">
                      <a href="certified.php" data-toggle="tab" aria-expanded="true">
                        <div class="icon-circle checked">
                          <i class="ti-layout-cta-center"></i>
                        </div>
                        CERTIFICADO
                      </a>
                    </li>
                  </ul>
                </div>
                  <div class="tab-content">
                    <div class="tab-pane active" id="about">
                      <div class="row">
                        <h5 class="info-text">O certificado estará disponível para download no final da apresentação!</h5>
                        <div class="col-sm-8 col-sm-offset-2">
                          <div class="choice choice active" data-toggle="wizard-checkbox">
                            <button type="submit" name="baixar" class="btn btn-primary btn-fill">BAIXAR CERTIFICADO</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="clearfix"></div>
              </form>
            </div>

          </div>
        </div> <!-- wizard container -->
      </div>
    </div><!-- end row -->
    </div> <!--  big container -->


  </main>

  <footer class="footer">
  </footer>

</body>

<script src="../assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="../js/jquery.mask.js" type="text/javascript"></script>
<script src="../js/mask.js"></script>

<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="../assets/js/demo.js" type="text/javascript"></script>
<script src="../assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>

<!--  More information about jquery.validate here: https://jqueryvalidation.org/	 -->
<script src="../assets/js/jquery.validate.min.js" type="text/javascript"></script>

</html>