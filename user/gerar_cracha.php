<?php
require_once 'checkLogin.php';
require_once 'src/dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$nome = "nome";
$categoria = "categoria";
$codigoDeBarra = "codigo de barra";

$html = "
    <link type='text/css' href='/absolute/path/to/pdf.css' rel='stylesheet'/>
    <div class='cracha' style='background-image: url('src/model.png');
    width: 200px;'>
        <div class='label'>".$nome."</div>
        <div class='label'>".$categoria."</div>
        <div class='codigoDeBarra'>$codigoDeBarra</div>
    </div>
";
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("arquivo");
?>