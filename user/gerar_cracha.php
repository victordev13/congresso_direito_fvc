<?php
require_once 'checkLogin.php';
require_once 'src/dompdf/autoload.inc.php';
require_once '../user_functions.php';


// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->set_base_path('src/');

$nome = 'Victor de Carvalho Silva';
$categoria = 'Estudante/1°Período';

$html ="
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <link rel='stylesheet' type='text/css' href='../css/style.css'>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>PDF</title>
        <style>
        @page{}
            body{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 16pt;
                background: none;
            }
            div.cracha{
                background: url('src/model.png');
                background-size: cover;
                width: 316px;
                height: 443px;
                position: fixed
            }
            p{
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
            div.codigoBarra{
            
            }
        </style>
    </head>
    <body>
        <div class='cracha'>
            <p class='label1'>".$nome."</p>
            <p class='label2'>".$categoria."</p>
            <div class='codigobarras'>".fbarcode(getCPF())."</div>
        </div>
</body>
</html>
";



echo $html;
$nome = 'nome';
$categoria = 'categoria';

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser


//$dompdf->stream('arquivo');
?>