<?php
    $host = "";
    $db = "";
    $user = "";
    $pwd = "";

    function Conexao(){
            $connect = @mysqli_connect($host, $user, $pwd, $db) or die(mysqli_connect_error());
            mysqli_set_charset($connect, 'utf8');
            return $connect;
          }
          
    function FecharConexao($connect){
            @mysqli_close($connect) or die(mysqli_error($connect));
          
        }

?>