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
    
    if(mysqli_num_rows($resultado) >= 1){
        $dados = mysqli_fetch_array($resultado);
        $nome = $dados['0'];
        return $nome;
    }else{
        return $resultado;
    }

    FecharConexao($connect);
}

function getIdAdmin(){
    $connect = conection();
    
    $usuario = $_SESSION['usuario'];
    $sql = "SELECT id_usuario FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($connect, $sql);
    
    if($resultado){
        if(mysqli_num_rows($resultado) >= 1){
            $dados = mysqli_fetch_array($resultado);
            $id_usuario = $dados['0'];
            return $id_usuario;
        }else{
            return $resultado;
        }
    }
    

    FecharConexao($connect);
}

function getNivelAcesso($usuario){
    $connect = conection();

    $sql = "SELECT nivel FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($resultado) >= 1){
        $dados = mysqli_fetch_array($resultado);
        $nivel = $dados['0'];
        return $nivel;
    }else{
        return $resultado;
    }

    FecharConexao($connect);
}
//  FUNÇÕES DO USUÁRIO FINANCEIRO //
    function verificaStatusPagamento($cpf){
        $connect = conection();

        $sql = "SELECT status_pagamento FROM `inscritos` WHERE cpf = '$cpf'";
        $resultado = mysqli_query($connect, $sql);
        
        if($resultado){
            $row = mysqli_fetch_array($resultado);
            $status_pagamento = $row['0'];

            if($status_pagamento == '1'){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
       

        FecharConexao($connect);
    }

    function validaPagamento($cpf){
        $connect = conection();

        //INSERIR REGISTRO NA TABELA PAGAMENTO  E ALTERAR COLUNA DE STATUS DO INSCRITO
        registraPagamento($cpf);

        $sql = "UPDATE inscritos SET status_pagamento='1' WHERE cpf='$cpf'";
        $resultado = mysqli_query($connect, $sql);
        
        if($resultado == 1){
            return true;
        }else{
            return false;
        }
       

        FecharConexao($connect);
	}

    function registraPagamento($cpf){
        $connect = conection();

        $id_usuario = getIdAdmin();
        $id_inscrito = getIdUsuario($cpf);

        $sql = "INSERT INTO `pagamento` (`id_pagamento`, `id_usuario`, `id_inscritos`, `horario`) VALUES (NULL, '$id_usuario', '$id_inscrito', CURRENT_TIMESTAMP)";
        $resultado = mysqli_query($connect, $sql);
        
        if($resultado){
            if(mysqli_num_rows($resultado)){
                return true;
            }else{
                return false;
            }
        }
        
    
        FecharConexao($connect);
    }

    function getDataPagamento($cpf){
        $connect = conection();

        $sql = "SELECT status_pagamento FROM `inscritos` WHERE cpf = '$cpf'";
        $resultado = mysqli_query($connect, $sql);
        
        if($resultado){
            $row = mysqli_fetch_array($resultado);
            $status_pagamento = $row['0'];

            if($status_pagamento == '1'){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
       

        FecharConexao($connect);
    }

    function getUsuarioPagamento($cpf){
        $connect = conection();
        $id_inscrito = getIdInscrito($cpf);
         
        $sql = "SELECT usuario FROM `pagamento` INNER JOIN usuario ON id_usuario = id_usuario WHERE 'id_inscrito' = '$id_inscrito'";
        $resultado = mysqli_query($connect, $sql);
        
        if($resultado){
            $row = mysqli_fetch_array($resultado);
            $usuario = $row['0'];

            return $usuario;
        }else{
            return false;
        }
       

        FecharConexao($connect);
    }

    function getIdUsuario($cpf){
        $connect = conection();

        $sql = "SELECT id_incritos FROM inscritos WHERE cpf='$cpf'";
        $resultado = mysqli_query($connect, $sql);
        
        if($resultado){
            $row = mysqli_fetch_array($resultado);
            $id_usuario = $row['0'];

            if(mysqli_num_rows($resultado)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

        FecharConexao($connect);
    }
    
//  FIM FUNÇÕES DO USUÁRIO FINANCEIRO //

?>