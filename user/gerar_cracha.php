<?php
require_once 'checkLogin.php';
require_once 'src/dompdf/autoload.inc.php';
require_once '../user_functions.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$nome = 'Victor';
$categoria = 'Estudante/1°Período';

$dompdf->loadHtml("<!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>". 'Crachá - '.getCPF()."</title>
        <style>

            body{

                background: none!important;
            }
            .cracha{
                background: url('src/model.png') no-repeat;
                font-family: 'Roboto', sans-serif;
                font-size: 16pt;
                width: 316px;
                height: 443px;
                position: fixed;
            }
            .label1, .label2{
                width: 280px;
                margin-left: 20px;
                display: block;
                position: fixed;
            }
            .label1{
                margin-top: 205px;
            }
            .label2{
                margin-top: 300px;
            }
            
            .codigobarras{ 
                float:left; 
            }	

            .codigobarras{
                margin-top: 380px;
                font-size: 20px;
                margin-left: 100px;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <div class='cracha'>
            <p class='label1'>".getNome()."</p>
            <p class='label2'>".getCategoria(getCPF())."</p>
            <p class='codigobarras'>".getCPF()."</p>
        </div>
</body>
</html>");

$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream(''.getCPF().'');
?>