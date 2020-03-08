<?php 
require_once '../functions.php';
require_once '../adm_functions.php';
acessoRestrito(0);
require_once '../includes/header.php';




if(isset($_POST['validar'])){
    validaPagamento($cpf);
}
?>


<form  method="post"></form>
<input type="submit" value="Validar" name="validar">

<?php
require_once '../includes/footer.php'
?>