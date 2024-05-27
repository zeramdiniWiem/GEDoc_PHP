<?php
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
$idSess = $_SESSION['id'];
$d2 = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id AND user.id = '$idSess' AND document.type IS NULL");
$d2->execute();
$d1 = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id AND user.id = '$idSess'AND document.type IS NOT NULL");
$d1->execute();
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
                        <ul class="nav nav-tabs pl-0 pr-0">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#doc">Documents</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pdf">En attente</a></li>
                            <li class="nav-item ml-auto">
                                <form>
                                    <input type="search" name="search" class="form-control" style="background-color: white;">
                                </form>
                            </li>
                        </ul>                    
                        <div class="tab-content">
                            <div class="tab-pane active" id="doc">
                                <div class="row clearfix">
                                    <?php while ($row = $d1->fetch()) {?>
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="file">
                                                <a href="javascript:void(0);">
                                                    <div class="hover">
                                                        <button type="button" class="btn btn-icon btn-icon-mini btn-round btn-warning">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-file-text text-info"></i>
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted"><?php echo $row['nameDoc'] ?></p>
                                                        <small>Type : <?php echo $row['type'] ?>  <span class="date text-muted"><?php echo $row['dateDoc'] ?></span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="tab-pane" id="pdf">
                                <div class="row clearfix">
                                    <?php while ($row = $d2->fetch()) {?>
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="file">
                                                <a href="javascript:void(0);">
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                    <div class="file-name">
														<div class="hover" style="float:right;">
															<button type="button" class="btn btn-icon btn-icon-mini btn-round btn-success" onclick="classifier(<?php echo $row['idDoc'] ?>);">
																<i class="zmdi zmdi-check"></i>
															</button>
															<button type="button" class="btn btn-icon btn-icon-mini btn-round btn-danger" onclick="supprimer(<?php echo $row['idDoc'] ?>);">
																<i class="zmdi zmdi-delete"></i>
															</button>
														</div>
                                                        <p class="m-b-5 text-muted"><?php echo $row['nameDoc'] ?></p>
                                                        <small>Path : <?php echo $row['path'] ?>  <span class="mr-2 date text-muted"><?php echo $row['dateDoc'] ?></span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php') ?>
<script>
function classifier(id){
	window.location.href="classement.php?id="+id;
}
function supprimer(id){
	window.location.href="upload-supprimer.php?id="+id;
}
</script>