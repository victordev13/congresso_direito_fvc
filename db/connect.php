<?php
    $host = "localhost";
    $db = "locadora";
    $user = "root";
    $pwd = "";

$connect = @mysqli_connect($host, $user, $pwd, $db) or die(mysqli_connect_error());

          
    function FecharConexao($connect){
        @mysqli_close($connect) or die(mysqli_error($connect));
 }
?>