<?php
require_once 'functions.php';
        $connect = conection();


//insira os dados e acesse a pagina via url
        $usuario = "";
        $senha = "";
        $nivel = 1;

        if(!$usuario=="" && $senha==""){
            $senha = md5($senha);
            $sql = "INSERT INTO `usuario` (`usuario`, `senha`, `nivel`) VALUES ('$usuario', '$senha', '$nivel')";
            $resultado = mysqli_query($connect, $sql);

            if($resultado){
                echo "Sucesso!";
            }else{
                var_dump($resultado);
            }     
        
            FecharConexao($connect);
        }
        
    
?>