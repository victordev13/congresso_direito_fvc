<?php
require_once 'functions.php';

function loginAdmin($usuario, $senha){
    $connect = conection();

    $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";
    $resultado = mysqli_query($connect, $sql);

    if(mysqli_num_rows($resultado)){
        return true;
    }else{
        return false;
    }

    FecharConexao($connect);
}

function getNomeAdmin($usuario){	
    $connect = conection();

    $sql = "SELECT nome FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado)){
        $dados = mysqli_fetch_array($resultado);
        $nome = $dados['0'];
        return $nome;
    }else{
        return $resultado;
    }

    FecharConexao($connect);
}

function getNivelAcesso($usuario){
    $connect = conection();

    $sql = "SELECT nivel FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado)){
        $dados = mysqli_fetch_array($resultado);
        $nivel = $dados['0'];
        return $nivel;
    }else{
        return $resultado;
    }

    FecharConexao($connect);
}

    function validaPagamento(){
        $connect = conection();

    $sql = "SELECT nivel FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado)){
        $dados = mysqli_fetch_array($resultado);
        $nivel = $dados['0'];
        return $nivel;
    }else{
        return $resultado;
    }

    FecharConexao($connect);
	}



?>