<?php
function conection()
{
	include('db/connect.php');
	$conection = new mysqli($host, $username, $password, $db_name);
	mysqli_set_charset($conection, "utf8");
	if (!$conection) {
		die("Não foi possível conectar ao banco de dados" . mysqli_connect_error());
	} else {
		return $conection;
	}
}

function fecharConexao($connect)
{
	@mysqli_close($connect) or die(mysqli_error($connect));
}

function formatarCPF($valor)
{
	$valor = trim($valor);
	$valor = str_replace(".", "", $valor);
	$valor = str_replace(",", "", $valor);
	$valor = str_replace("-", "", $valor);
	$valor = str_replace("/", "", $valor);
	return $valor;
}

function formata($string)
{
	$connect = conection();

	$stringTratada = mysqli_real_escape_string($connect, $string);
	return $stringTratada;
	fecharConexao($connect);
}

function acessoRestrito($nivelUsuarioPermitido)
{
	global $connect;

	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION['logado']) && !isset($_SESSION['nivelAcesso'])) {
		header('Location: ../login.php');
	} else {
		if ($_SESSION['nivelAcesso'] != $nivelUsuarioPermitido) {
			header("Location: ../login.php?login=" . $_SESSION['nivelAcesso'] . "");
		}
	}
}

function direcionaParaPainel()
{
	$nivel = $_SESSION['nivelAcesso'];

	if ($nivel == 0) {
		header("Location: financeiro/");
	} else if ($nivel == 1) {
		header("Location: admin/");
	}
}

function getPainel()
{
	$nivel = $_SESSION['nivelAcesso'];

	if ($nivel == 0) {
		return "financeiro";
	} else if ($nivel == 1) {
		return "admin";
	}
}

function verifyCPF($cpf)
{
	$cpf = "$cpf";
	if (strpos($cpf, "-") !== false) {
		$cpf = str_replace("-", "", $cpf);
	}
	if (strpos($cpf, ".") !== false) {
		$cpf = str_replace(".", "", $cpf);
	}
	$sum = 0;
	$cpf = str_split($cpf);
	$cpftrueverifier = array();
	$cpfnumbers = array_splice($cpf, 0, 9);
	$cpfdefault = array(10, 9, 8, 7, 6, 5, 4, 3, 2);
	for ($i = 0; $i <= 8; $i++) {
		$sum += $cpfnumbers[$i] * $cpfdefault[$i];
	}
	$sumresult = $sum % 11;
	if ($sumresult < 2) {
		$cpftrueverifier[0] = 0;
	} else {
		$cpftrueverifier[0] = 11 - $sumresult;
	}
	$sum = 0;
	$cpfdefault = array(11, 10, 9, 8, 7, 6, 5, 4, 3, 2);
	$cpfnumbers[9] = $cpftrueverifier[0];
	for ($i = 0; $i <= 9; $i++) {
		$sum += $cpfnumbers[$i] * $cpfdefault[$i];
	}
	$sumresult = $sum % 11;
	if ($sumresult < 2) {
		$cpftrueverifier[1] = 0;
	} else {
		$cpftrueverifier[1] = 11 - $sumresult;
	}
	$returner = false;
	if ($cpf == $cpftrueverifier) {
		$returner = true;
	}

	$cpfver = array_merge($cpfnumbers, $cpf);
	if (count(array_unique($cpfver)) == 1 || $cpfver == array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0)) {
		$returner = false;
	}
	return $returner;
}

function verifySubscribe($cpf)
{
	$conection = conection();
	$query = mysqli_query($conection, "SELECT * FROM inscritos WHERE cpf='$cpf'");
	if (mysqli_num_rows($query) >= 1) {
		return true;
	} else {
		return false;
	}
}

function subscribe($nome, $email, $cpf, $tel, $periodo, $turno)
{
	$codigobarra = rand(100000000000000000, 999999999999999999);
	$conection = conection();
	$sql = "INSERT INTO inscritos (nome, email, cpf, tel, periodo, turno, status, codigobarra) 
          VALUES('$nome', '$email', '$cpf', '$tel', '$periodo', '$turno', 0, '$codigobarra')";

	if (mysqli_query($conection, $sql)) {
		return true;
	} else {
		return false;
	}
}

function userLogin($email, $cpf)
{
	$conection = conection();
	$query = mysqli_query($conection, "SELECT * FROM inscritos WHERE email='$email' and cpf='$cpf'");
	if (mysqli_num_rows($query) >= 1) {
		return true;
	} else {
		return false;
	}
}

function getIDSubscribe($email, $cpf)
{
	$conection = conection();
	$query = mysqli_query($conection, "SELECT * FROM inscritos WHERE email='$email' and cpf='$cpf'");
	$row = mysqli_fetch_array($query);
	$id_subscribe = $row['id_inscritos'];
	return $id_subscribe;
}


function fbarcode($valor)
{

	$fino = 1;
	$largo = 3;
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
	<img src=".././img/img/p.gif" width="<?php echo $fino; ?>" height="<?php echo $altura; ?>" border="0">
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
<?php
} //Fim da fun��o

function esquerda($entra, $comp)
{
	return substr($entra, 0, $comp);
}

function direita($entra, $comp)
{
	return substr($entra, strlen($entra) - $comp, $comp);
}
