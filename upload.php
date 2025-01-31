<?php
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
//if (isset($_POST['ajouter'])) {
    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $file = basename($_FILES["fileToUpload"]["name"]);
    $date = date("Y-m-d h:i:s");
    $user = $_SESSION['id'];
    $size = $_FILES["fileToUpload"]["size"]/1000;
    $sql = "INSERT INTO document (nameDoc, path, tailleDoc, dateDoc, creePar, extentionDoc)
      VALUES ('$file',  '$target_dir','$size','$date' ,'$user','$extension')";
      $conn->exec($sql);
//}
header("location:classement.php");

?>