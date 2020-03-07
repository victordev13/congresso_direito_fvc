<?php
    $host = "localhost";
    $db = "congresso";
    $user = "phpmyadmin";
    $pwd = "root";

$connect = @mysqli_connect($host, $user, $pwd, $db) or die(mysqli_connect_error());

    function FecharConexao($connect){
        @mysqli_close($connect) or die(mysqli_error($connect));
 }
?>