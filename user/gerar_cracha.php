<?php
require_once 'checkLogin.php';
require_once 'src/dompdf/autoload.inc.php';
require_once '../user_functions.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

echo "<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>". 'Crachá - '.getCPF()."</title>
        <style>
            @media print{
                .cracha{background: url('src/model.png') no-repeat;}
            }
            body{
                width: 100%;
                height: 100%;
            }
            .cracha{
                background: url('src/model.png') no-repeat;
                font-family: 'Roboto', sans-serif;
                font-size: 16pt;
                width: 316px;
                height: 443px;
                
            }
            .label1, .label2{
                width: 280px;
                margin-left: 20px;
                display: block;
                position: absolute;
            }
            .label1{
                margin-top: 205px;
            }
            .label2{
                margin-top: 300px;
            }
            
            #codebar img{ 
                float:left; 
                margin-top: 370px;

            }	
            #codebar{
                margin-left: 50px;
                z-index: 10;
            }

            .codigobarras{
                font-size: 10pt;
                align-items: center;
                justify-content: center;
                position: relative;
                display: block;
            }
            .codigobarras span{
                margin-top: 380px;
                margin-left: 100px;
            }
        </style>
    </head>
    <body>
        <div class='cracha'>
            <div class='dados'>
                <p class='label1'>".getNome()."</p>
                <p class='label2'>".getCategoria(getCPF())."</p>
                <p class='codigobarras'>".fbarcode(getCPF())."<br><span>".getCPF()."</span></p>
            </div>
        </div>
</body>
</html>";

$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
//$dompdf->stream(''.getCPF().'');
?>