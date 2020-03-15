<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
require('gerar_certificado/fpdf/alphapdf.php');
require_once '../functions.php';
include('./checkLogin.php');

function formatCpf($value){
  $cpf = preg_replace("/\D/", '', $value);

  return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);
}

@session_start();

$id_subscribe = $_SESSION['id_subscribe'];

$conection = conection();
$query = mysqli_query($conection, "SELECT * FROM inscritos WHERE id_inscritos='$id_subscribe'");
$row = mysqli_fetch_array($query);
$nome = $row['nome'];
$email = $row['email'];
$cpf = $row['cpf'];
$status = $row['status'];

// --------- Variáveis que podem vir de um banco de dados por exemplo ----- //
$curso    = "III SEMINÁRIO JURÍDICO DO CAD-FVC";

//inserir funcao para pegar data e calcular horas presentes
$data     = " 26 de março de 2020";
$carga_h  = "8 horas";


$texto1 = utf8_decode("Portador do CPF: " . formatCpf($cpf) . "\nParticipou do " . $curso . ", com carga horária total de " . $carga_h . ".");
$texto2 = utf8_decode("São Mateus, " . $data);


$pdf = new AlphaPDF();

// Orientação Landing Page ///
$pdf->AddPage('L');

$pdf->SetLineWidth(1.5);

// desenha a imagem do certificado
$pdf->Image('gerar_certificado/certificado.jpg', 0, 0, 295);

// opacidade total
$pdf->SetAlpha(1);


// Mostrar o nome
$pdf->SetFont('Arial', 'B', 20); // Tipo de fonte e tamanho
$pdf->SetXY(20, 105); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, strtoupper($nome), '', 'C', 0); // Tamanho width e height e posição

// Mostrar o corpo
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(20, 120); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $texto1, '', 'C', 0); // Tamanho width e height e posição

// Mostrar a data no final
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(20, 150); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $texto2, '', 'C', 0); // Tamanho width e height e posição


$pdfdoc = $pdf->Output('', 'S');

if ($status == 1) {
  $pdf->Output(); // Mostrar o certificado na tela do navegador
} else {
  echo "Erro ao gerar certificado";
}
