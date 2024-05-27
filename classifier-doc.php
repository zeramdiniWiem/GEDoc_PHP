<?php 
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');

if(isset($_POST['contrat'])){
	$id = $_POST['id'];
	$sujet = $_POST['sujet'];
	$date = $_POST['date'];
	$objectif = $_POST['objectif'];
	$duree = $_POST['duree'];
	$notes = $_POST['notes'];
	$update = "UPDATE document SET type = 'contrat' WHERE idDoc = '$id'";
	$conn->exec($update);
	$sql = "INSERT INTO contrat (sujet, date, duree, objectif, notes, idDoc)
      VALUES ('$sujet','$date','$duree','$objectif' ,'$notes','$id')";
      $conn->exec($sql);
	  header("location:documents.php");
}

if(isset($_POST['courier'])){
	$id = $_POST['id'];
	$objectif = $_POST['objectif'];
	$description = $_POST['description'];
	$notes = $_POST['notes'];
	$update = "UPDATE document SET type = 'courier' WHERE idDoc = '$id'";
	$conn->exec($update);
	$sql = "INSERT INTO courier (objectifs, description, notes, idDoc)
      VALUES ('$objectif','$description','$notes','$id')";
      $conn->exec($sql);
	  header("location:documents.php");
}

if(isset($_POST['facture'])){
	$id = $_POST['id'];
	$adresse = $_POST['adresse'];
	$numF = $_POST['numF'];
	$modeP = $_POST['modeP'];
	$prix = $_POST['prix'];
	$description = $_POST['description'];
	$notes = $_POST['notes'];
	$update = "UPDATE document SET type = 'facture' WHERE idDoc = '$id'";
	$conn->exec($update);
	$sql = "INSERT INTO facture (adress, num, modeP, prix, description, notes, idDoc)
      VALUES ('$adresse','$numF','$modeP','$prix','$description','$notes','$id')";
      $conn->exec($sql);
	  header("location:documents.php");
}


if(isset($_POST['extrait'])){
	$id = $_POST['id'];
	$ref = $_POST['ref'];
	$debit = $_POST['debit'];
	$credit = $_POST['credit'];
	$solde = $_POST['solde'];
	$description = $_POST['description'];
	$update = "UPDATE document SET type = 'extrait' WHERE idDoc = '$id'";
	$conn->exec($update);
	$sql = "INSERT INTO extrait (ref, description, debit, credit, solde, idDoc)
      VALUES ('$ref','$description','$debit','$credit','$solde','$id')";
      $conn->exec($sql);
	  header("location:documents.php");
}
?>