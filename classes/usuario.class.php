<?php
require_once 'db/connect.php';

class Usuario {

    function login($usuario, $senha){
        global $connect;

		$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";
		$resultado = mysqli_query($connect, $sql);

		if($resultado){
			return true;
		}else{
			return $resultado;
		}

		FecharConexao($connect);
	}

	function getNome($usuario){	
        global $connect;
	
		$sql = "SELECT nome FROM usuario WHERE usuario = '$usuario'";
		$resultado = mysqli_query($connect, $sql);
		
		if($resultado){
			$dados = mysqli_fetch_array($resultado);
			$nome = $dados['0'];
			return $nome;
		}else{
			return $resultado;
		}

		FecharConexao($connect);
	}

	function getNivelAcesso($usuario){
		global $connect;

		$sql = "SELECT nivel FROM usuario WHERE usuario = '$usuario'";
		$resultado = mysqli_query($connect, $sql);
		
		if($resultado){
			$dados = mysqli_fetch_array($resultado);
			$nome = $dados['0'];
			return $nivel;
		}else{
			return $resultado;
		}

		FecharConexao($connect);
	}
}

?>