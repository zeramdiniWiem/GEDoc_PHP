<?php
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
$idSess = $_SESSION['id'];
$stm = $conn->prepare("SELECT * FROM document, user where document.creePar = '$idSess' AND document.type IS NULL");
$stm->execute();
$stmt = $conn->prepare("SELECT * FROM document, user where document.creePar = '$idSess' AND document.type IS not NULL");
$stmt->execute();
$usr = $conn->prepare("SELECT * FROM user where user.id = '$idSess'");
$usr->execute();
$ligne = $usr->fetch();
include('header.php') ;
?>
<section class="content file_manager">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Mes Fichiers</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-upload"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Modifier</strong> Profile</h2>
                        </div>
						<form method="POST">
                        <div class="body">
                            <div class="row mb-3 mt-3">
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" class="form-control" value="<?php echo $ligne['nom']?>" name="nom">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Prénom</label>
                                        <input type="text" class="form-control" value="<?php echo $ligne['prenom']?>" name="prenom">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" value="<?php echo $ligne['login']?>" name="login">
                                    </div>
                                </div>                              
                            </div>  
                            <div class="row mb-3">
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="<?php echo $ligne['email']?>" name="email">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>C.I.N</label>
                                        <input type="number" class="form-control" value="<?php echo $ligne['CIN']?>" name="cin">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Téléphone</label>
                                        <input type="number" class="form-control" value="<?php echo $ligne['telephone']?>" name="telephone">
                                    </div>
                                </div>                              
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Adresse</label>
                                        <input type="text" class="form-control" value="<?php echo $ligne['adresse']?>" name="adresse">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>ID Unique</label>
                                        <input type="text" class="form-control" value="<?php echo $ligne['idenUnique']?>" name="idU">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label>Mot de passe</label>
                                        <input type="password" class="form-control" name="mdp">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-info" type="submit">Modifier</button>
                                </div>                                
                            </div>                            
                        </div>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php') ?>