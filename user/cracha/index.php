<?php
require_once '../../functions.php';
require_once '../../user_functions.php';
include('../checkLogin.php');
include('function/gerarcodigobarra.php');

$erro = "";
$mensagem = "";

@session_start();

function formatCnpjCpf($value)
{
    $cnpj_cpf = preg_replace("/\D/", '', $value);

    if (strlen($cnpj_cpf) === 11) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
    }

    return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
}

?>
<!DOCTYPE html>
<html lang='pt-br'>

<head>
    <meta charset='UTF-8'>
    <link rel='stylesheet' type='text/css' href='css/cracha.css'>
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <title>Cartão de Entrada - Faculdade FVC </title>

</head>

<body>

    <div id="container">

        <div class="logo">
            <center>
                <img src="imagens/logo.png" width="80px">
            </center>
        </div>

        <div class="dados">


            <center class="texto">
                <p> III SEMINÁRIO JURÍDICO DO <br> CAD (Centro Acadêmico de Direito) </p>
            </center>


            <div class="nome">
                <p> <b> Participante: </b> <?php echo getNome(); ?> </p> <!-- Colocar as variavel com o nome -->
                <p> <b> CPF: </b> <?php echo formatCnpjCpf(getCPF()); ?> </p> <!-- Colocar a variavel com o CPF -->
                <br>
            </div>
            <p class="fontmenor"> A entrada no evento e contabilização de horas só será possível com a apresentação desse crachá, que poderá ser realizada online no celular com internet ou impressa.

        </div>


        <div>
            <br><br>

            <center class="codigo">
                <?php geraCodigoBarra(getCPF()); ?> <br> <!-- Aqui tem que colocar a variavel que gera o codigo de barra -->
                <?php echo getCPF(); ?>
                <!-- Aqui repete a variavel que traz o cpf do candidato -->
            </center>
            <center>
                <button id="btn"> Verão para Impressão </button>
                <button id="voltar" onClick="VoltarPagina()"> Voltar </button>
            </center>
        </div>

    </div>
    <script>
        document.getElementById('btn').onclick = function() {
            var conteudo = document.getElementById('container').innerHTML,
                tela_impressao = window.open('about:blank');

            tela_impressao.document.write(conteudo);
            tela_impressao.window.print();
            tela_impressao.window.close();
        };
    </script>

    <script type="text/javascript">
        function VoltarPagina() {
            location.href = " ../index.php";
        }
    </script>

    <body>

</html>