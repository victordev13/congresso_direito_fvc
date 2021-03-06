<?php
require_once 'functions.php';

function loginAdmin($usuario, $senha)
{
    $connect = conection();

    $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";
    $resultado = mysqli_query($connect, $sql);

    if (mysqli_num_rows($resultado)) {
        return true;
    } else {
        return false;
    }

    FecharConexao($connect);
}

function getNomeAdmin($usuario)
{
    $connect = conection();

    $sql = "SELECT nome FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($connect, $sql);

    if (mysqli_num_rows($resultado) >= 1) {
        $dados = mysqli_fetch_array($resultado);
        $nome = $dados['0'];
        return $nome;
    } else {
        return $resultado;
    }

    FecharConexao($connect);
}

function getIdAdmin()
{
    $connect = conection();

    $usuario = $_SESSION['usuario'];
    $sql = "SELECT id_usuario FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($connect, $sql);

    if ($resultado) {
        if (mysqli_num_rows($resultado) >= 1) {
            $dados = mysqli_fetch_array($resultado);
            $id_usuario = $dados['0'];
            return $id_usuario;
        } else {
            return $resultado;
        }
    }


    FecharConexao($connect);
}

function getNivelAcesso($usuario)
{
    $connect = conection();

    $sql = "SELECT nivel FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($connect, $sql);

    if (mysqli_num_rows($resultado) >= 1) {
        $dados = mysqli_fetch_array($resultado);
        $nivel = $dados['0'];
        return $nivel;
    } else {
        return $resultado;
    }

    FecharConexao($connect);
}
//  FUNÇÕES DO USUÁRIO FINANCEIRO //
function verificaStatusPagamento($cpf)
{
    $connect = conection();

    $sql = "SELECT status FROM `inscritos` WHERE cpf = '$cpf'";
    $resultado = mysqli_query($connect, $sql);

    if ($resultado) {
        $row = mysqli_fetch_array($resultado);
        $status = $row['0'];

        if ($status == '1') {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }


    FecharConexao($connect);
}

function validaPagamento($cpf)
{
    $connect = conection();

    //INSERIR REGISTRO NA TABELA PAGAMENTO  E ALTERAR COLUNA DE STATUS DO INSCRITO
    registraPagamento($cpf);

    $sql = "UPDATE inscritos SET status='1' WHERE cpf='$cpf'";
    $resultado = mysqli_query($connect, $sql);

    if ($resultado == 1) {
        return true;
    } else {
        return false;
    }


    FecharConexao($connect);
}

function registraPagamento($cpf)
{
    $connect = conection();

    $id_inscrito = getIdInscrito($cpf);
    $id_usuario = getIdUsuario($_SESSION['usuario']);

    $sql = "INSERT INTO `log_pagamento` (`usuario`, `inscritos`, `horario`) VALUES ('$id_usuario', '$id_inscrito', CURRENT_TIMESTAMP())";
    $resultado = mysqli_query($connect, $sql);

    if ($resultado) {

        return true;
    } else {
        return false;
    }

    FecharConexao($connect);
}

function getNomeInscrito($cpf)
{
    $connect = conection();

    $query = mysqli_query($connect, "SELECT nome FROM inscritos WHERE cpf='$cpf'");

    if ($query) {
        $row = mysqli_fetch_array($query);
        $nomeUsuario = $row['0'];

        return $nomeUsuario;
    } else {
        return false;
    }
    FecharConexao($connect);
}

function getUsuarioPagamento($cpf)
{
    $connect = conection();
    $id_inscrito = getIdInscrito($cpf);

    $sql = "SELECT u.usuario FROM `log_pagamento` AS l INNER JOIN usuario AS u ON idusuario = l.usuario WHERE l.inscritos = '$id_inscrito'";
    $resultado = mysqli_query($connect, $sql);

    if ($resultado) {
        $row = mysqli_fetch_array($resultado);
        $usuario = $row['0'];

        return $usuario;
    } else {
        return false;
    }

    FecharConexao($connect);
}


function getDataPagamento($cpf)
{
    $connect = conection();
    $id_inscrito = getIdInscrito($cpf);

    $sql = "SELECT horario FROM log_pagamento WHERE log_pagamento.inscritos ='$id_inscrito'";
    $resultado = mysqli_query($connect, $sql);

    if ($resultado) {
        $row = mysqli_fetch_array($resultado);
        $data = $row['0'];

        $timestamp = strtotime($data);
        $data = date('d/m/Y', $timestamp);
        return $data;
    } else {
        return false;
    }


    FecharConexao($connect);
}

function getIdUsuario($usuario)
{
    $connect = conection();

    $sql = "SELECT idusuario FROM usuario WHERE usuario='$usuario'";
    $resultado = mysqli_query($connect, $sql);

    if ($resultado) {
        $row = mysqli_fetch_array($resultado);
        $id_usuario = $row['0'];

        if (mysqli_num_rows($resultado)) {
            return $id_usuario;
        } else {
            return false;
        }
    } else {
        return false;
    }

    FecharConexao($connect);
}

function getPeriodo($cpf)
{
    $connect = conection();

    $sql = "SELECT periodo FROM inscritos WHERE cpf='$cpf'";
    $resultado = mysqli_query($connect, $sql);

    if ($resultado) {
        $row = mysqli_fetch_array($resultado);
        $periodo = $row['0'];

        if ($periodo == 0) {
            return "Visitante";
        } else {
            return $periodo . "°";
        }
    } else {
        return false;
    }

    FecharConexao($connect);
}

function getStatusPagamento($cpf)
{
    $conection = conection();

    $query = mysqli_query($conection, "SELECT status FROM inscritos WHERE cpf='$cpf'");
    $row = mysqli_fetch_array($query);
    $status = $row['status'];

    if ($status == 0) {
        return "<span class='text-danger'>Pendente</span>";
    } else if ($status == 1) {
        return "Efetuado";
    } else {
        return "ERRO AO BUSCAR STATUS";
    }
}


//  FIM FUNÇÕES DO USUÁRIO FINANCEIRO //


// FUNÇÕES DO USUÁRIO ADMINISTRADOR //

function liberaComComprovante($cpf)
{
    $connect = conection();

    registraPagamento($cpf);

    $sql = "UPDATE inscritos SET status='2' WHERE cpf='$cpf'";
    $resultado = mysqli_query($connect, $sql);

    if ($resultado == 1) {
        return true;
    } else {
        return false;
    }

    FecharConexao($connect);
}

function getDiaEvento()
{
}

function getEntrada()
{
    //verifica qual é o dia atual e se tem alguma entrada do cpf atual
}

function getSaída()
{
    //verifica Se o usuário já saiu do evento na data atual
}

function setEntrada($id_inscritos)
{
    date_default_timezone_set('America/Sao_Paulo');

    $conection = conection();
    $dia = date("Y-m-d");
    $entrada = date("H:i:s");

    $sql = "INSERT INTO presenca (id_inscritos, dia, entrada) VALUES ('$id_inscritos', '$dia', '$entrada')";
    $query = mysqli_query($conection, $sql);

    if ($query) {
        return "Entrada realizada às " . $entrada;
    } else {
        return "Erro ao registrar entrada";
    }

    FecharConexao($conection);
}

function setSaida($id_inscritos)
{
    date_default_timezone_set('America/Sao_Paulo');

    $conection = conection();
    $dia = date("Y-m-d");
    $saida = date("H:i:s");

    $sql = "UPDATE presenca SET saida = '$saida' WHERE id_inscritos = '$id_inscritos' and dia = '$dia'";
    $query = mysqli_query($conection, $sql);

    if ($query) {
        return "Saida realizada às " . $saida;
    } else {
        return "Erro ao registrar saida";
    }

    FecharConexao($conection);
}

function marcarPresenca($cpf)
{
    $conection = conection();

    date_default_timezone_set('America/Sao_Paulo');
    $hoje = date("Y-m-d");
    $id_inscritos = getIdInscrito($cpf);

    $sql = "SELECT * FROM presenca WHERE id_inscritos='$id_inscritos' order by saida";
    $query = mysqli_query($conection, $sql);
    $resultado = mysqli_num_rows($query);


    if ($resultado >= 1) {
        $sql = "SELECT * FROM presenca WHERE id_inscritos='$id_inscritos' order by dia desc";
        $query = mysqli_query($conection, $sql);
        $retorno = mysqli_fetch_array($query);
        $dia = $retorno['dia'];
        $saida = $retorno['saida'];

        if (empty($saida)) {
            return setSaida($id_inscritos);
        }else if (strtotime($hoje) == strtotime($dia)) {
            return "Inscrito já entrou e saiu do evento hoje!";
        } else {
            return setEntrada($id_inscritos);
        }
    } else {
        return setEntrada($id_inscritos);
    }
}
// //
