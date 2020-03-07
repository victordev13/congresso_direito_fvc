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

function acessoRestrito($sessao, $nivelUsuario){
	global $connect;

	if(!isset($_SESSION)){
		session_start();
	}
	if(!isset($_SESSION[$sessao]) && !isset($_SESSION['nivelAcesso'])){
		header('Location: ../index.php');
	}else{
		if(isset($_SESSION['nivelAcesso'])){
			if($_SESSION['nivelAcesso'] != $nivelUsuario){
				header("Location: ../index.php");
			}
		}
		
	}
}

function direcionaAcesso(){
	$sql = "";

	$nivel = "";
	if($nivel == 0){
		header("Location: admin/");
	}
}
?>