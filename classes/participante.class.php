<?php
require_once 'db/connect.php';

class Participante {

	function cadastrar($nome, $email, $cpf, $categoria, $periodo, $turno){
		//$sql = "INSERT INTO participante (nome, email, cpf,   ) VALUES('$nome', '$email', '$cpf', '$categoria', '$periodo', '$turno');";
		$resultado = mysqli_query($connect, $sql);

		if($resultado){
			return true;
		}else{
			return false;
		}
		FecharConexao($connect);
	}

	function login($email, $cpf){
        global $connect;

		//$sql = "SELECT * FROM participante WHERE email = '$email' AND cpf = '$cpf'";
		$resultado = mysqli_query($connect, $sql);

		if(mysqli_num_rows($resultado)){
			return true;
		}else{
			return false;
		}

		FecharConexao($connect);
	}

	function imprimirCracha(){
		
	}

	function reimprimirCracha(){

	}

	function validaPagamento(){

	}


	
}

?>