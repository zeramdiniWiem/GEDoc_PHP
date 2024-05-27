<?php 
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$nom = $_POST['nom'];
	$pre = $_POST['pre'];
	$email = $_POST['email'];
	$cin = $_POST['cin'];
	$tel = $_POST['tel'];
	$adr = $_POST['adr'];
	$idu = $_POST['idu'];

	$sql = "UPDATE user SET nom='$nom', prenom='$pre', adresse='$adr', email='$email',telephone='$tel', CIN='$cin', idenUnique='$idu' WHERE id='$id'";
      $conn->exec($sql);
      header("location:comptes.php");
}
?>