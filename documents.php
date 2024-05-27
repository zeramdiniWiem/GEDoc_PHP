<?php
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
$stmt = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id AND document.type IS NOT NULL ORDER BY document.idDoc desc");
$stmt->execute();
$stmt1 = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id AND document.type IS NOT NULL ORDER BY document.idDoc desc");
$stmt1->execute();

if (isset($_GET['mot'])) {
    $mot = $_GET['mot'];
    $chercher = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id AND MATCH(nameDoc) AGAINST('".$mot."') AND document.type IS NOT NULL ORDER BY document.idDoc desc");
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        $chercher = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id AND document.type = '$type' AND MATCH(nameDoc) AGAINST('".$mot."')");
        if (isset($_GET['date1'])) {
            $date1 = $_GET['date1'];
            $date2 = $_GET['date2'];
            $chercher = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id AND document.type = '$type' AND document.dateDoc BETWEEN '$date1' AND '$date2' AND MATCH(nameDoc) AGAINST('".$mot."')");
        }
    }
    $chercher->execute();
}
include('header.php') ;
?>
<style type="text/css">
    .bootstrap-select{
        background-color: white;
    }
</style>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Liste des Documents</h2>
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
                        <ul class="nav nav-tabs pl-0 pr-0" id="op">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#list_view">Liste</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#grid_view">Gallery</a></li>
                        </ul>
                        <form method="GET">
                            <div class="row mb-3">
                                <div class="col-lg-2">
                                    <label>Nom Document</label>
                                    <input type="text" name="mot" class="form-control" style="background-color: white;">
                                </div>
                                <div class="col-lg-2">
                                    <label>Type</label>
                                    <select class="form-control" style="background-color: white;" name="type">
                                        <option>Type</option>        
                                        <option value="facture">Facture</option>        
                                        <option value="contrat">Contrat</option>        
                                        <option value="courier">Courier</option>        
                                        <option value="extrait Compte">Extrait Compte</option>        
                                        <option value="bon de commande">Bon de Commande</option>        
                                        <option value="bon de livraison">Bon de Livraison</option>        
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label>Depuit</label>
                                    <input type="date" name="date1" class="form-control" placeholder="" style="background-color: white;">
                                </div>
                                <div class="col-lg-3">
                                    <label>Vers</label>
                                    <input type="date" name="date2" class="form-control" placeholder="" style="background-color: white;">
                                </div>
                                <div class="col-lg-2">
                                    <button class="btn btn-info" style="margin-top: 2.3em;">Chercher</button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="tab-content">
                            <div class="tab-pane active show" id="list_view">
                                <div class="table-responsive" id="doc">
                                    <table class="table table-hover mb-0 c_table" id="table-doc">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Documents</th>
                                                <th>Extension</th>
                                                <th>Path</th>
                                                <th data-breakpoints="xs">Créer par</th>
                                                <th data-breakpoints="xs sm md">Créer en</th>
                                                <th data-breakpoints="xs">Taille</th>
                                                <th data-breakpoints="xs">Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $stmt->fetch()) {?>
                                            <tr>
                                                <td>
                                                    <?php 
                                                        if ($row['id'] == $_SESSION['id']) {
                                                            echo"<a href='classement.php?id=".$row['idDoc']."' class='text-info'><i class='zmdi zmdi-edit'></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a href='upload-supprimer.php?id=".$row['idDoc']."' class='text-danger'><i class='zmdi zmdi-delete'></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a type='button' class='text-info' data-toggle='modal' data-target='#voir-".$row['idDoc']."'><i class='zmdi zmdi-eye'></i></a>";
                                                        }else{
                                                            /*echo"<a href='javascript:void()' class='text-muted' disabled><i class='zmdi zmdi-edit'></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a href='javascript:void()' class='text-muted'><i class='zmdi zmdi-delete' disabled></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a href='javascript:void()' class='text-muted'><i class='zmdi zmdi-eye'></i></a>";*/
                                                            echo"<a href='classement.php?id=".$row['idDoc']."' class='text-info'><i class='zmdi zmdi-edit'></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a href='upload-supprimer.php?id=".$row['idDoc']."' class='text-danger'><i class='zmdi zmdi-delete'></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a type='button' class='text-info' data-toggle='modal' data-target='#voir-".$row['idDoc']."'><i class='zmdi zmdi-eye'></i></a>";
                                                        }
                                                    ?>
                                                        
                                                </td>
                                                <td><?php echo" <a href='".$row['path'].$row['nameDoc']."'>".$row['nameDoc']."</a>"; ?></td>
                                                <td><?php echo $row['extentionDoc']; ?></td>
                                                <td><?php echo $row['path']; ?></td>
                                                <td><?php echo $row['nom']." ".$row['prenom']; ?></td>
                                                <td><?php echo $row['dateDoc'];?></td>
                                                <td><?php echo $row['tailleDoc']." kb"; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                            </tr>
                                            <div class="modal fade" id="voir-<?php echo $row['idDoc'] ?>" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="title" id="largeModalLabel"></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if (isset($_GET['mot'])) {?>
                                <div class="table-responsive" id="res">
                                    <table class="table table-hover mb-0 c_table" id="table-doc">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Documents</th>
                                                <th>Extension</th>
                                                <th>Path</th>
                                                <th data-breakpoints="xs">Créer par</th>
                                                <th data-breakpoints="xs sm md">Créer en</th>
                                                <th data-breakpoints="xs">Taille</th>
                                                <th data-breakpoints="xs">Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $chercher->fetch()) {?>
                                            <tr>
                                                <td>
                                                    <?php 
                                                        if ($row['id'] == $_SESSION['id']) {
                                                            echo"<a href='classement.php?id=".$row['idDoc']."' class='text-info'><i class='zmdi zmdi-edit'></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a href='upload-supprimer.php?id=".$row['idDoc']."' class='text-danger'><i class='zmdi zmdi-delete'></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a type='button' class='text-info' data-toggle='modal' data-target='#voir-".$row['idDoc']."'><i class='zmdi zmdi-eye'></i></a>";
                                                        }else{
                                                            /*echo"<a href='javascript:void()' class='text-muted' disabled><i class='zmdi zmdi-edit'></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a href='javascript:void()' class='text-muted'><i class='zmdi zmdi-delete' disabled></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a href='javascript:void()' class='text-muted'><i class='zmdi zmdi-eye'></i></a>";*/
                                                            echo"<a href='classement.php?id=".$row['idDoc']."' class='text-info'><i class='zmdi zmdi-edit'></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a href='upload-supprimer.php?id=".$row['idDoc']."' class='text-danger'><i class='zmdi zmdi-delete'></i></a>
                                                            &nbsp;&nbsp;&nbsp;<a type='button' class='text-info' data-toggle='modal' data-target='#voir-".$row['idDoc']."'><i class='zmdi zmdi-eye'></i></a>";
                                                        }
                                                    ?>
                                                        
                                                </td>
                                                <td><?php echo" <a href='".$row['path'].$row['nameDoc']."'>".$row['nameDoc']."</a>"; ?></td>
                                                <td><?php echo $row['extentionDoc']; ?></td>
                                                <td><?php echo $row['path']; ?></td>
                                                <td><?php echo $row['nom']." ".$row['prenom']; ?></td>
                                                <td><?php echo $row['dateDoc'];?></td>
                                                <td><?php echo $row['tailleDoc']." kb"; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                            </tr>
                                            <div class="modal fade" id="voir-<?php echo $row['idDoc'] ?>" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="title" id="largeModalLabel"></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane file_manager" id="grid_view">
                                <div class="row clearfix">
                                    <?php while ($row = $stmt1->fetch()) {?>
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="card">
                                            <a href="javascript:void(0);" class="file">
                                                <?php 
                                                    if ($row['id'] == $_SESSION['id']) {
                                                        echo"<div class='hover'>
                                                            <button type='button' class='btn btn-icon btn-icon-mini btn-round btn-danger'>
                                                                <i class='zmdi zmdi-delete'></i>
                                                            </button>
                                                        </div>";
                                                }?>
                                                <div class="icon">
                                                    <i class="zmdi zmdi-file"></i>
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted"><?php echo $row['nameDoc']; ?></p>
                                                    <small><span class="badge badge-info"> <?php echo $row['type']; ?> </span><span class="date"><?php echo $row['dateDoc']; ?></span></small>
                                                </div>
                                            </a>
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
<?php if (isset($_GET['mot'])) { ?>
<script type="text/javascript">
    var doc = document.getElementById("doc");
    var res = document.getElementById("res");
    var op = document.getElementById("op");
    op.style.display = "none";
    doc.style.display = "none";
    res.style.display = "block";
    
</script>
<?php }?>
<?php include('footer.php') ?>
