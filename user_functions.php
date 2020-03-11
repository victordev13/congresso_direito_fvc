<?php
require_once 'functions.php';

	function getCPF(){
		$conection = conection();
		$id_subscribe = $_SESSION['id_subscribe'];
		$query = mysqli_query($conection, "SELECT cpf FROM inscritos WHERE id_inscritos='$id_subscribe'");
		$row = mysqli_fetch_array($query);
		$cpf = $row['cpf'];
		return $cpf;
	}

	function getNome(){
		$conection = conection();
		$id_subscribe = $_SESSION['id_subscribe'];
		$query = mysqli_query($conection, "SELECT nome FROM inscritos WHERE id_inscritos='$id_subscribe'");
		$row = mysqli_fetch_array($query);
		$nome = $row['nome'];
		return $nome;
	}
		
	function getCategoria($cpf){
		$connect = conection();

		$sql = "SELECT periodo FROM inscritos WHERE cpf = '$cpf'";
		$resultado = mysqli_query($connect, $sql);
		
		if(mysqli_num_rows($resultado) >= 1){
			$dados = mysqli_fetch_array($resultado);
			$periodo = $dados['0'];

			if($periodo == 0){
				return "Visitante";
			}else{
				return "Estudante/".$periodo."° Período";
			}
		}else{
			return false;
		}

		FecharConexao($connect);
	}
		
	function fbarcode($valor)
	{

		$fino = 2;
		$largo = 5;
		$altura = 40;

		$barcodes[0] = "00110";
		$barcodes[1] = "10001";
		$barcodes[2] = "01001";
		$barcodes[3] = "11000";
		$barcodes[4] = "00101";
		$barcodes[5] = "10100";
		$barcodes[6] = "01100";
		$barcodes[7] = "00011";
		$barcodes[8] = "10010";
		$barcodes[9] = "01010";
		for ($f1 = 9; $f1 >= 0; $f1--) {
			for ($f2 = 9; $f2 >= 0; $f2--) {
				$f = ($f1 * 10) + $f2;
				$texto = "";
				for ($i = 1; $i < 6; $i++) {
					$texto .=  substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
				}
				$barcodes[$f] = $texto;
			}
		}


		//Desenho da barra

		//Guarda inicial
	?>
	<div id="codebar">
		<img src="../img/p.gif" width="<?php echo $fino; ?>" height="<?php echo $altura; ?>" border="0">
		<img src="../img/b.gif" width="<?php echo $fino; ?>" height="<?php echo $altura; ?>" border="0">
		<img src="../img/p.gif" width="<?php echo $fino; ?>" height="<?php echo $altura; ?>" border="0">
		<img src="../img/b.gif" width="<?php echo $fino; ?>" height="<?php echo $altura; ?>" border="0">
		<?php
		$texto = $valor;
		if ((strlen($texto) % 2) <> 0) {
			$texto = "0" . $texto;
		}

		// Draw dos dados
		while (strlen($texto) > 0) {
			$i = round(esquerda($texto, 2));
			$texto = direita($texto, strlen($texto) - 2);
			$f = $barcodes[$i];
			for ($i = 1; $i < 11; $i += 2) {
				if (substr($f, ($i - 1), 1) == "0") {
					$f1 = $fino;
				} else {
					$f1 = $largo;
				}
		?>
				<img src="../img/p.gif" width="<?php echo $f1; ?>" height="<?php echo $altura; ?>" border="0">
				<?php
				if (substr($f, $i, 1) == "0") {
					$f2 = $fino;
				} else {
					$f2 = $largo;
				}
				?>
				<img src="../img/b.gif" width="<?php echo $f2; ?>" height="<?php echo $altura; ?>" border="0">
		<?php
			}
		}

		// Draw guarda final
		?>
		<img src="../img/p.gif" width="<?php echo $largo; ?>" height="<?php echo $altura; ?>" border="0">
		<img src="../img/b.gif" width="<?php echo $fino; ?>" height="<?php echo $altura; ?>" border="0">
		<img src="../img/p.gif" width="<?php echo 1; ?>" height="<?php echo $altura; ?>" border="0">
	</div>
	<?php
	} //Fim da fun��o

?>