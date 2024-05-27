<?php 
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	
	$stmt = $conn->prepare("SELECT * FROM document where idDoc = ".$id);
	$stmt->execute();
	$row = $stmt->fetch();
	$document = $row['path'].$row['document'];
	unlink($document);
	$sql = "DELETE FROM document WHERE idDoc = ".$id;
	$conn->exec($sql);
	if ($_GET['type'] != null) {
		$type = $_GET['type'];
		$sql2 = "DELETE FROM '$type' WHERE idDoc = '$id'";
		$conn->exec($sql2);
	}
	
	header("location:classement.php");
}
?>