<?php
require_once 'checkLogin.php';
require_once 'src/dompdf/autoload.inc.php';
require_once '../user_functions.php';


// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->set_base_path('src/');

$nome = "nome";
$categoria = "categoria";

$html = file_get_contents("src/cracha.php");

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("arquivo");
?>