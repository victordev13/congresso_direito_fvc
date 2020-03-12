<?php
session_start();
if(!isset($_SESSION['subscribe']) == true){
  unset($_SESSION['subscribe']);
  header("location: /user/login.php");
}
?>