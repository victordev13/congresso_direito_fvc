<?php
session_start();

if(isset($_SESSION['subscribe'])){
	unset($_SESSION['subscribe']);
	unset($_SESSION['id_subscribe']);  
	session_destroy();
	header("Location: ../index.php?logout");
}
  
