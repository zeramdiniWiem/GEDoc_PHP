<?php 
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
    $n = $_POST['nameRole'];
    $type = $_POST['type'];
    $r = $_POST['r'];
    $w = $_POST['w'];
    $x = $_POST['x'];
	foreach ($type as $i => $value) {
		if(isset($r[$i])){
			$r[$i] = "r";
		}
		if(isset($w[$i])){
			$w[$i] = "w";
		}
		if(isset($x[$i])){
			$x[$i] = "x";
		}
		$sql = "INSERT INTO role (nameRole,typeDoc,permission)
		  VALUES ('$n','$value','$r[$i] $w[$i] $x[$i]')";
		  $conn->exec($sql);
		  echo $value;
	}
    //$typeDocument = $_POST['typeDocument'];
    
   
    /**/


?>