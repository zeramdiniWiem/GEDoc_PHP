<?php 
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$nom = $_POST['nameRole'];
	$pre = $_POST['service'];

	$sql = "UPDATE role SET nameRole='$nom' where id = '$id'";
    $conn->exec($sql);
    header("location:roles.php");
}
?>