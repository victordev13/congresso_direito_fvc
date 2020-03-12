<?php
session_start();
if(!isset($_SESSION['subscribe']) == true){
  unset($_SESSION['subscribe']);
  echo "<script>window.location = '/user/login.php'</script>";
}
?>
