<?php
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set( 'America/Sao_Paulo' );
require('gerar_certificado/fpdf/alphapdf.php');
require_once '../functions.php';
include('./checkLogin.php');


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
$curso    = "Congresso de Direito da FVC";

//inserir funcao para pegar data e calcular horas presentes
$data     = "08/03/2020";
$carga_h  = "10 horas";


$texto2 = utf8_decode("pela participação no ".$curso." \n realizado em ".$data." com carga horária total de ".$carga_h.".");


$pdf = new AlphaPDF();

// Orientação Landing Page ///
$pdf->AddPage('L');

$pdf->SetLineWidth(1.5);

// desenha a imagem do certificado
$pdf->Image('gerar_certificado/certificado.jpg',0,0,295);

// opacidade total
$pdf->SetAlpha(1);


// Mostrar o nome
$pdf->SetFont('Arial', '', 30); // Tipo de fonte e tamanho
$pdf->SetXY(20,105); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $nome, '', 'C', 0); // Tamanho width e height e posição

// Mostrar o corpo
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(20,110); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $texto2, '', 'C', 0); // Tamanho width e height e posição


$pdfdoc = $pdf->Output('', 'S');

// ******** Agora vai enviar o e-mail pro usuário contendo o anexo
// ******** e também mostrar na tela para caso o e-mail não chegar

$certificado="arquivos/".$cpf.".pdf"; //atribui a variável $certificado com o caminho e o nome do arquivo que será salvo (vai usar o CPF digitado pelo usuário como nome de arquivo)

if($status == 1){
  $pdf->Output(); // Mostrar o certificado na tela do navegador
}else{
  echo "Erro ao gerar certificado";
}


?>
