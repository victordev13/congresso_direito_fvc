<?php
require_once 'functions.php';
        $connect = conection();

//insira os dados e acesse a pagina via url
        if(isset($_GET['u']) && isset($_GET['s']) && isset($_GET['n'])){
            $usuario = $_GET['u'];
            $senha = $_GET['s'];
            $nivel = $_GET['n'];

        if(!$usuario=="" && !$senha==""){
            $senha = md5($senha);
            $sql = "INSERT INTO `usuario` (`usuario`, `senha`, `nivel`) VALUES ('$usuario', '$senha', '$nivel')";
            $resultado = mysqli_query($connect, $sql);

            if($resultado){
                echo "Sucesso!";
            }else{
                echo "Err. result: ".var_dump($resultado);
            }     
            
            FecharConexao($connect);
            }
        }
        
        
    
?>