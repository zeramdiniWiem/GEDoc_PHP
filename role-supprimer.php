<?php 
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM role WHERE id = '$id'";
      $conn->exec($sql);
      header("location:roles.php");
}
?>