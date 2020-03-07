<?php

require_once 'db/connect.php';

function formatarCPF($valor){
	$valor = trim($valor);
	$valor = str_replace(".", "", $valor);
	$valor = str_replace(",", "", $valor);
	$valor = str_replace("-", "", $valor);
	$valor = str_replace("/", "", $valor);
	return $valor;
}

function formata($string){
	global $connect;
	
	$stringTratada = mysqli_real_escape_string($connect, $string);
	return $stringTratada;
	FecharConexao($connect);
}

function acessoRestrito($nivelUsuarioPermitido){
	global $connect;

	if(!isset($_SESSION)){
		session_start();
	}
	if(!isset($_SESSION['logado']) && !isset($_SESSION['nivelAcesso'])){
		header('Location: ../login.php');
	}else{
		if($_SESSION['nivelAcesso'] != $nivelUsuarioPermitido){
			header("Location: ../login.php");
		}
	}
}

function direcionaAcesso(){
	global $connect;

	$sql = "";

	$nivel = "";
	if($nivel == 0){
		header("Location: admin/");
	}
}
?>