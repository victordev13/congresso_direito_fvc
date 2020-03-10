<?php
require_once 'checkLogin.php';
require_once 'src/dompdf/autoload.inc.php';
require_once '../user_functions.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->set_base_path('/congresso_direito_fvc/user/src/');

$nome = 'Victor';
$categoria = 'Estudante/1°Período';

$html = "<!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>PDF</title>
        <style>
        @page{}
            body{

                background: none!important;
            }
            .cracha{
                background: url('src/model.png');
                background-size: cover;
                font-family: Arial, Helvetica, sans-serif;
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
            
            .codigobarras img{ 
                float:left; 
            }	

            .codigobarras{
                margin-top: 380px;
                font-family: 'Roboto', sans-serif;
                font-size: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
            }
        </style>
    </head>
    <body>
        <div class='cracha'>
            <p class='label1'>".getNome()."</p>
            <p class='label2'>".$categoria."</p>
            <p class='codigobarras'>".getCPF()."</p>
        </div>
</body>
</html>";

echo $html;
//$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser

$dompdf->stream(''.getCPF().'');
?>