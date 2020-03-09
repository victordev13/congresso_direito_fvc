<?php
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set( 'America/Sao_Paulo' );
require('fpdf/alphapdf.php');
require('PHPMailer/class.phpmailer.php');
require_once '../../functions.php';

function userID(){
  return htmlspecialchars($_GET["id"]);
}

function getNome()
{
  $conection = conection();
  $id_subscribe = userID();
  $query = mysqli_query($conection, "SELECT nome FROM inscritos WHERE id_inscritos='$id_subscribe'");
  $row = mysqli_fetch_array($query);
  $curso = $row['nome'];
  return $curso;
}

function getEmail()
{
  $conection = conection();
  $id_subscribe = userID();
  $query = mysqli_query($conection, "SELECT email FROM inscritos WHERE id_inscritos='$id_subscribe'");
  $row = mysqli_fetch_array($query);
  $curso = $row['email'];
  return $curso;
}

function getCPF()
{
  $conection = conection();
  $id_subscribe = userID();
  $query = mysqli_query($conection, "SELECT cpf FROM inscritos WHERE id_inscritos='$id_subscribe'");
  $row = mysqli_fetch_array($query);
  $cpf = $row['cpf'];
  return $cpf;
}

function getStatus()
{
  $conection = conection();
  $id_subscribe = userID();
  $query = mysqli_query($conection, "SELECT status FROM inscritos WHERE id_inscritos='$id_subscribe'");
  $row = mysqli_fetch_array($query);
  $status = $row['status'];
  return $status;
}

// --------- Variáveis que podem vir de um banco de dados por exemplo ----- //
$empresa  = "Universidade Vale do Cricaré";
$curso    = "Congresso de Direito da FVC";
$data     = "08/03/2020";
$carga_h  = "10 horas";


$texto1 = utf8_decode($empresa);
$texto2 = utf8_decode("pela participação no ".$curso." \n realizado em ".$data." com carga horária total de ".$carga_h.".");
$texto3 = utf8_decode("São Mateus, ".utf8_encode(strftime( '%d de %B de %Y', strtotime( date( 'Y-m-d' ) ) )));


$pdf = new AlphaPDF();

// Orientação Landing Page ///
$pdf->AddPage('L');

$pdf->SetLineWidth(1.5);


// desenha a imagem do certificado
$pdf->Image('certificado.jpg',0,0,295);

// opacidade total
$pdf->SetAlpha(1);

// Mostrar texto no topo
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(109,46); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $texto1, '', 'L', 0); // Tamanho width e height e posição

// Mostrar o nome
$pdf->SetFont('Arial', '', 30); // Tipo de fonte e tamanho
$pdf->SetXY(20,86); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, getNome(), '', 'C', 0); // Tamanho width e height e posição

// Mostrar o corpo
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(20,110); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $texto2, '', 'C', 0); // Tamanho width e height e posição

// Mostrar a data no final
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(32,172); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(165, 10, $texto3, '', 'L', 0); // Tamanho width e height e posição

$pdfdoc = $pdf->Output('', 'S');



// ******** Agora vai enviar o e-mail pro usuário contendo o anexo
// ******** e também mostrar na tela para caso o e-mail não chegar

$subject = 'Seu Certificado do Workshop';
$messageBody = "Olá getNome()<br><br>É com grande prazer que entregamos o seu certificado.<br>Ele está em anexo nesse e-mail.<br><br>Atenciosamente,<br>Lincoln Borges<br><a href='http://www.lnborges.com.br'>http://www.lnborges.com.br</a>";


$mail = new PHPMailer();
$mail->SetFrom("certificado@lnborges.com.br", "Certificado");
$mail->Subject    = $subject;
$mail->MsgHTML(utf8_decode($messageBody));
$mail->AddAddress(getEmail()); 
$mail->addStringAttachment($pdfdoc, 'certificado.pdf');
$mail->Send();

$certificado="arquivos/".getCPF().".pdf"; //atribui a variável $certificado com o caminho e o nome do arquivo que será salvo (vai usar o CPF digitado pelo usuário como nome de arquivo)
$pdf->Output($certificado,'F'); //Salva o certificado no servidor (verifique se a pasta "arquivos" tem a permissão necessária)
// Utilizando esse script provavelmente o certificado ficara salvo em www.seusite.com.br/gerar_certificado/arquivos/999.999.999-99.pdf (o 999 representa o CPF digitado pelo usuário)

if(getStatus() == 1){
  $pdf->Output(); // Mostrar o certificado na tela do navegador
}else{
  echo "Erro ao gerar certificado";
}


?>
