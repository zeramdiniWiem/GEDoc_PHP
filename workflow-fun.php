<?php 
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
if (isset($_POST['nom'])) {
	$nameW = $_POST['nom'];
	$topic = $_POST['sujet'];
	$fichier = $_POST['fichier'];
	$des1 = $_POST['des1'];
	$des2 = $_POST['des2'];
	$des3 = $_POST['des3'];
	$des4 = $_POST['des4'];
	$fonc1 = $_POST['fonc1'];
	$fonc2 = $_POST['fonc2'];
	$fonc3 = $_POST['fonc3'];
	$fonc4 = $_POST['fonc4'];
	$des = $des1."-".$des2."-".$des3."-".$des4;
	$fonc = $fonc1."-".$fonc2."-".$fonc3."-".$fonc4;
	$reponse = "en attente";
	$sql = "INSERT INTO workflow (idDoc,nameW,topic,destinataire,reponse,fonctionD)
      VALUES ('$fichier','$nameW','$topic','$des','$reponse','$fonc')";
      $conn->exec($sql);
	
	header("location:workflow.php");
}

if (isset($_GET['confirm'])) {
	$confirm = $_GET['confirm'];
	$reponse = $_GET['reponse'];
	$sql = "UPDATE workflow SET reponse = '$reponse' WHERE idFlow = '$confirm'";
      $conn->exec($sql);
	
	header("location:workflow.php");
}

if (isset($_GET['refuser'])) {
	$refuser = $_GET['refuser'];
	$reponse = $_GET['reponse'];
	$sql = "UPDATE workflow SET reponse = 'refuser' WHERE idFlow = '$refuser'";
      $conn->exec($sql);
	
	header("location:workflow.php");
}
?>