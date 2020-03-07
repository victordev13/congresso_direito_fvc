<?php
require_once 'db/connect.php';

class Participante {

	function cadastrar($nome, $email, $cpf, $categoria, $periodo, $turno){
		$sql = "INSERT INTO evento_direito.participante (nome, email, cpf,   ) VALUES('$nome', '$email', '$cpf', '$categoria', '$periodo', '$turno');";
		$resultado = mysqli_query($connect, $sql);
		if($resultado){
			return true;
		}else{
			return false;
		}
		FecharConexao($connect);
	}

	
}

?>