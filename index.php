<?php
require_once 'includes/header.php';
require_once 'functions.php';
require_once 'classes/participante.class.php';

$erro = "";
$mensagem = "";

if (isset($_POST['login'])) {
    $email = formata($_POST['email-login']);
    $cpf = formatarCPF($_POST['cpf-login']);
    if (verifyCPF($cpf)) {
    } else {
        $erro = "CPF inválido!";
    }
}

if (isset($_POST['inscrever'])) {
    $nome = formata($_POST['nome']);
    $email = formata($_POST['email']);
    $cpf = formatarCPF($_POST['cpf']);
    $periodo = formata($_POST['periodo']);
    $turno = "";
    if (verifyCPF($cpf)) {
        if ($periodo = 0) {
            $categoria = "visitante";
        } else {
            $categoria = "aluno";
        }
        if (!$turno == "") {
            $turno = formata($_POST['turno']);
        }
        $retorno = Participante::cadastrar($nome, $email, $cpf, $categoria, $periodo, $turno);
        if ($retorno) {
            $mensagem = "Inscrição realizada com sucesso";
        } else {
            $erro = "Erro ao realizar Inscrição!";
        }
    } else {
        $erro = "CPF inválido!";
    }
}

?>
<!--   Big container   -->
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="green" id="wizardProfile">
                    <form method="POST">
                        <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->
                        <div class="wizard-header text-center">
                            <h3 class="wizard-title">Inscrição</h3>
                            <p class="category">Inscreva-se para o Congresso de Direito da FVC</p>
                        </div>

                        <div class="wizard-navigation">
                            <div class="progress-with-circle">
                                <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                            </div>
                            <ul>
                                <li>
                                    <a href="#" data-toggle="tab">
                                        <div class="icon-circle">
                                            <i class="ti-user"></i>
                                        </div>
                                        INSCRIÇÃO
                                    </a>
                                </li>
                                <li>
                                    <a href="user/login.php">
                                        <div class="icon-circle">
                                            <i class="ti-settings"></i>
                                        </div>
                                        STATUS
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <div class="icon-circle">
                                            <i class="ti-layout-cta-center"></i>
                                        </div>
                                        CERTIFICADO
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane" id="about">
                                <div class="row">
                                    <h5 class="info-text">Preencha os campos abaixo para se inscrever</h5>
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <?php
                                        if (!$erro == "") {
                                            echo "<div class='alert alert-danger alerta-sm' role='alert'>";
                                            echo $erro;
                                            echo "</div>";
                                        }
                                        if (!$mensagem == "") {
                                            echo "<div class='alert alert-warning alerta-sm' role='alert'>";

                                            echo "</div>";
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label>Nome completo</label>
                                            <input name="nome" type="text" class="form-control" placeholder="Nome..." required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="email" class="form-control" placeholder="meu@email.com" required>
                                        </div>
                                        <div class="form-group">
                                            <label>CPF</label>
                                            <input name="cpf" id="cpf" type="text" class="form-control" placeholder="123.456.789-10" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Perído ou Visitante</label><br>
                                            <select class="form-control" id="periodo" required name="periodo">
                                                <option selected disabled value="">Selecione...</option>
                                                <option value="1">Primeiro </option>
                                                <option value="2">Segundo </option>
                                                <option value="3">Terceiro </option>
                                                <option value="4">Quarto </option>
                                                <option value="5">Quinto </option>
                                                <option value="6">Sexto </option>
                                                <option value="7">Sétimo </option>
                                                <option value="8">Oitavo </option>
                                                <option value="9">Nono </option>
                                                <option value="10">Décimo </option>
                                                <option value="0">Visitante </option>
                                            </select>
                                        </div>
                                        <div class="form-group" style="display:none" id="div_turno">
                                            <label>Perído ou Visitante</label><br>
                                            <select class="form-control" id="turno" required name="turno">
                                                <option selected disabled>Selecione...</option>
                                                <option value="matutino">Matutino</option>
                                                <option value="noturno">Noturno</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-left">
                                    <button type='submit' name="inscrever" class="btn btn-success btn-fill btn-wd">
                                        Inscrever-se
                                    </button>
                                </div>
                                <div class="pull-right">
                                    <a href="user/login.php">
                                        <button type='button' id="btnInscrito" class="btn btn-default btn-fill">
                                        Já sou inscrito
                                        </button>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
    </div><!-- end row -->
</div> <!--  big container -->


</main>

<?php

require_once 'includes/footer.php';
?>

</div>