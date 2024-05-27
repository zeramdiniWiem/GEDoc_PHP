<?php
require('base/connect.php');
$idSess = $_SESSION['id'];
$notif = $conn->prepare("SELECT * FROM notifications,user where notifications.user = user.id AND user.id = '$idSess'");
$notif->execute();
?>
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>GEDOC |  </title>

<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link href="assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" href="assets/plugins/dropify/css/dropify.min.css">
<link rel="stylesheet" href="assets/css/style.min.css">
<style type="text/css">
    .hide{
        display: none;
    }
    td{
        font-size: small;
    }
</style>
</head>

<body class="theme-blush">

<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/loader.svg" width="48" height="48" alt="Aero"></div>
        <p>Please wait...</p>
    </div>
</div>

<div class="overlay"></div>

<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <form>
        <input type="search" value="" placeholder="Search..." />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<div class="navbar-right">
    <ul class="navbar-nav">
        <li><a href="#search" class="main_search" title="Search..."><i class="zmdi zmdi-search"></i></a></li>
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" title="App" data-toggle="dropdown" role="button"><i class="zmdi zmdi-apps"></i></a>
            <ul class="dropdown-menu slideUp2">
                <li class="header">Options</li>
                <li class="body">
                    <ul class="menu app_sortcut list-unstyled">
                        <li>
                            <a href="profile.php">
                                <div class="icon-circle mb-2 bg-blue"><i class="zmdi zmdi-account"></i></div>
                                <p class="mb-0">Profile</p>
                            </a>
                        </li>
                        <li>
                            <a href="mes-fichiers.php">
                                <div class="icon-circle mb-2 bg-amber"><i class="zmdi zmdi-file-plus"></i></div>
                                <p class="mb-0">Mes Fichier</p>
                            </a>
                        </li>
                        <?php if ($_SESSION['role'] == "Administration") {; ?>
                        <li>
                            <a href="comptes.php">
                                <div class="icon-circle mb-2 bg-purple"><i class="zmdi zmdi-accounts-outline"></i></div>
                                <p class="mb-0">Comptes</p>
                            </a>
                        </li>
                        <li>
                            <a href="roles.php">
                                <div class="icon-circle mb-2 bg-green"><i class="zmdi zmdi-star"></i></div>
                                <p class="mb-0">Roles</p>
                            </a>
                        </li>
                        <?php }?>
                        <li>
                            <a href="contact.html">
                                <div class="icon-circle mb-2 bg-purple"><i class="zmdi zmdi-settings"></i></div>
                                <p class="mb-0">Paramètres</p>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <div class="icon-circle mb-2 bg-red"><i class="zmdi zmdi-power"></i></div>
                                <p class="mb-0">Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" title="Notifications" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i>
            </a>
            <ul class="dropdown-menu">
                <li class="header">Notifications</li>
                <li class="body">
                    <ul class="menu list-unstyled">
					<?php while ($row = $notif->fetch()) {?>
                        <li>
                            <a href="javascript:void(0);" onclick="report('<?php echo $row['titre']; ?>','<?php echo utf8_encode($row['message']); ?>','<?php echo $row['date']; ?>')">
                                <div class="icon-circle bg-blue"><i class="zmdi zmdi-file"></i></div>
                                <div class="menu-info">
                                    <h4><?php echo $row['titre']; ?> </h4>
                                    <p><i class="zmdi zmdi-time"></i><?php echo " ".$row['date']; ?></p>
                                </div>
                            </a>
                        </li>
						
					<?php 
						
					}?>
                    </ul>
                </li>
                <li class="footer"> <a href="javascript:void(0);">Voir toutes les Notifications</a> </li>
            </ul>
        </li>
    </ul>
</div>

<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="index.html"><img src="assets/images/logo.svg" width="25" alt="Aero"><span class="m-l-10">GEDOC</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <div class="detail" style="padding:1em;">
                        <h4><?php echo $_SESSION['prenom']." ".$_SESSION['nom']; ?></h4>
                        <small><span class="badge badge-info"><?php echo $_SESSION['role']; ?></span></small>         
                    </div>
                </div>
            </li>
            <li><a href="accueil.php"><i class="zmdi zmdi-home"></i><span>acceuil</span></a></li>
            <li><a href="documents.php"><i class="zmdi zmdi-file"></i><span>Documents</span></a></li>
            <li><a href="classement.php"><i class="zmdi zmdi-file-plus"></i><span>classement</span></a></li>
            <li class="m-b--10"><a href="workflow.php"><i class="zmdi zmdi-swap-vertical"></i><span>Workflow</span></a></li>
            <form action="upload.php" method="post" enctype="multipart/form-data" id="formUpload">
              <input type="file" class="dropify" name="fileToUpload" id="fileToUpload">
              <input type="submit" class="btn btn-primary" value="Upload" name="submit">
            </form>
        </ul>
    </div>
</aside>
<script type="text/javascript">
	function report(titre,message,date){
		 Notiflix.Report.Info( titre, message+' <br><br>-'+date, 'Fermer' ); 
	}
</script>