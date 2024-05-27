<?php 
require('base/connect.php');
session_start();
if(isset($_POST['submit'])) {
  $username = trim($_POST['login']);
  $password = trim($_POST['password']);
  if($username != "" && $password != "") {
    try {
      $query = "SELECT * FROM user where login = :username AND motDePasse = :password";
      $stmt = $conn->prepare($query);
      $stmt->bindParam('username', $username, PDO::PARAM_STR);
      $stmt->bindParam('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
          $_SESSION['id']   = $row['id'];
          $_SESSION['login'] = $row['login'];
          $_SESSION['email']   = $row['email'];
          $_SESSION['telephone'] = $row['telephone'];
          $_SESSION['prenom'] = $row['prenom'];
          $_SESSION['nom'] = $row['nom'];
          $_SESSION['password'] = $row['motDePasse'];
          $_SESSION['adresse'] = $row['adresse'];
          $_SESSION['idu'] = $row['idenUnique'];
         // $_SESSION['cin'] = $row['cin'];
          $id = $row['id'];
          $sql = "SELECT * from user,role,droitacces where droitacces.iduser = '$id' and role.id = droitacces.idrole";
          $stm = $conn->prepare($sql);
          $stm->execute();
          $ligne   = $stm->fetch(PDO::FETCH_ASSOC);
          $_SESSION['role'] = $ligne['nameRole'];
          header("location:accueil.php");
       
      } else {
        $message="Login ou mot de passe est incorrect";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    $message = "Veuillez remplir tous les champs";
  }
}

$conn = null;
?>
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>GEDOC | Login</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.min.css">    
</head>

<body class="theme-blush">

<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <form class="card auth_form" method="POST">
                    <div class="header">
                        <img class="logo" src="assets/images/logo.svg" alt="">
                        <h5>Log in</h5>
                    </div>
                    <b class="ml-3 text-danger"><?php if (isset($message)){echo $message;}?> </b>
                    <div class="body">
                        <div class="input-group mb-3">
                            <input name="login" type="text" class="form-control" placeholder="Username">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input name="password" type="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><a href="javascript:void()" class="forgot" title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                            </div>                            
                        </div>
                        <div class="checkbox">
                            <input id="remember_me" type="checkbox">
                            <label for="remember_me">Remember Me</label>
                        </div>
                        <input type="submit" value="SIGN IN" class="btn btn-primary btn-block waves-effect waves-light" name="submit">                        
                    </div>
                </form>
                <div class="copyright text-center">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>,
                    <span><a href="javascript:void()" target="_blank">GEDOC</a></span>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <img src="assets/images/signin.svg" alt="Sign In"/>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
</body>
</html>