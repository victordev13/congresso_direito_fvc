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
			header("Location: ../login.php?login=".$_SESSION['nivelAcesso']."");
		}
	}
}

function direcionaParaPainel(){
	$nivel = $_SESSION['nivelAcesso'];
	
	if($nivel == 0){
		header("Location: financeiro/");
	}else if($nivel == 1){
		header("Location: admin/");
	}
}

function getPainel(){
	$nivel = $_SESSION['nivelAcesso'];
	
	if($nivel == 0){
		return "financeiro";
	}else if($nivel == 1){
		return "admin";
	}
}

?>