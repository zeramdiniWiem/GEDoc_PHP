<?php
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
$stmt = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id and document.type IS NULL ORDER BY document.idDoc desc");
$stmt->execute();


include('header.php') ;
?>
<section class="content">
    <div class="body_scroll">
    	<div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Classement </h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
    	<div class="container-fluid">
            <div class="row clearfix">
            	<div class="col-lg-12">
                    <div class="card project_list">
                        <?php if(!isset($_GET['id'])){ ?>
                        <div class="table-responsive">
                            <table class="table table-hover c_table" id="table-class">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Documents</th>
                                        <th>Extension</th>
                                        <th>Taille</th>
                                        <th>Path</th>
                                        <th>Créer en</th>
                                        <th>Créer par</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php while ($row = $stmt->fetch()) {?>
                                    <tr>
                                        <td>
                                        	<?php 
                                        		if ($row['id'] == $_SESSION['id']) {
                                        			echo"<a href='classement.php?id=".$row['idDoc']."' class='text-info' ><i class='zmdi zmdi-check'></i></a>
                                        			&nbsp;&nbsp;&nbsp;<a href='upload-supprimer.php?id=".$row['idDoc']."' class='text-danger'><i class='zmdi zmdi-delete'></i></a>
                                        			&nbsp;&nbsp;&nbsp;<a type='button' class='text-info' data-toggle='modal' data-target='#voir-".$row['idDoc']."' onclick='editor(".$row['idDoc'].")'><i class='zmdi zmdi-eye'></i></a>";
                                        		}else{
                                        			echo"<a href='javascript:void()' class='text-muted' disabled><i class='zmdi zmdi-check'></i></a>
                                        			&nbsp;&nbsp;&nbsp;<a href='javascript:void()' class='text-muted'><i class='zmdi zmdi-delete' disabled></i></a>
                                        			&nbsp;&nbsp;&nbsp;<a href='javascript:void()' class='text-muted'><i class='zmdi zmdi-eye'></i></a>";
                                        		}
                                        	?>
                                        		
                                        </td>
                                        <td><?php echo" <a href='".$row['path'].$row['nameDoc']."'>".$row['nameDoc']."</a>"; ?></td>
                                        <td><?php echo $row['extentionDoc']; ?></td>
                                        <td><?php echo $row['tailleDoc']." kb"; ?></td>
                                        <td><?php echo $row['path']; ?></td>
                                        <td><?php 
                                        echo $row['dateDoc'];
                                        ?></td>
                                        <td><span class="badge badge-info"><?php echo $row['prenom']." ".$row['nom']; ?></span></td>
                                    </tr>
                                    <div class="modal fade" id="voir-<?php echo $row['idDoc'] ?>" tabindex="-1" role="dialog">
								    <div class="modal-dialog modal-lg" role="document">
								        <div class="modal-content">
								            <div class="modal-header">
								                <h4 class="title" id="largeModalLabel"></h4>
								            </div>
								            <div class="modal-body">
                                                <textarea class="ckeditor" cols="80" name="content">
                                                    <?php echo readfile($row['path'].$row['nameDoc']); ?>
                                                </textarea>
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
                        <?php } ?>
                        <?php if(isset($_GET['id'])){ ?>
                        <div class="card">
                            <div class="body">
                                <ul class="nav nav-tabs p-0 mb-3">
                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#contrat">Contrat</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#courier">Courier</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#facture">Facture</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#extrait">Extrait Compte</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#livraison">Bon livraison</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#commande">Bon Commande</a></li>
                                </ul>                        
                                <div class="tab-content container mt-5">
                                    <div role="tabpanel" class="tab-pane in active show" id="contrat">
                                        <form method="POST" action="classifier-doc.php">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control d-none" name="id" value="<?php echo $_GET['id']; ?>" required>
                                                    <label>Sujet</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control" name="sujet" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Date</label>
                                                    <div class="form-group">                                
                                                        <input type="date" class="form-control" name="date" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Durée</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control" name="duree" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Objectifs</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control" name="objectif" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Notes</label>
                                                    <div class="form-group">                                
                                                        <textarea class="form-control" name="notes" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-raised btn-primary btn-round waves-effect" value="Classifier" name="contrat">
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="courier">
                                        <form method="POST" action="classifier-doc.php">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control d-none" name="id" value="<?php echo $_GET['id']; ?>" required>
                                                    <label>Objectifs</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control" name="objectif" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Description</label>
                                                    <div class="form-group">                                
                                                        <textarea class="form-control" name="description" required=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Notes</label>
                                                    <div class="form-group">                                
                                                        <textarea class="form-control" name="notes" required=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-raised btn-primary btn-round waves-effect" value="Classifier" name="courier">
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="facture">
                                        <form method="POST" action="classifier-doc.php">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control d-none" name="id" value="<?php echo $_GET['id']; ?>" required>
                                                    <label>Adresse</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control" name="adresse" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Numéro de Facture</label>
                                                    <div class="form-group">                                
                                                        <input type="number" class="form-control" name="numF" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Mode de paiement</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control" name="modeP" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Prix</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control" name="prix" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Description</label>
                                                    <div class="form-group">                                
                                                        <textarea class="form-control" name="description" required=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Notes</label>
                                                    <div class="form-group">                                
                                                        <textarea class="form-control" name="notes" required=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-raised btn-primary btn-round waves-effect" value="Classifier" name="facture">
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="extrait">
                                        <form method="POST" action="classifier-doc.php">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control d-none" name="id" value="<?php echo $_GET['id']; ?>" required>
                                                    <label>Reférence</label>
                                                    <div class="form-group">                                
                                                        <input type="number" class="form-control" name="ref" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Débit</label>
                                                    <div class="form-group">                                
                                                        <input type="number" class="form-control" name="debit" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Crédit</label>
                                                    <div class="form-group">                                
                                                        <input type="number" class="form-control" name="credit" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Solde</label>
                                                    <div class="form-group">                                
                                                        <input type="number" class="form-control" name="solde" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Description</label>
                                                    <div class="form-group">                                
                                                        <textarea class="form-control" name="description" required=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-raised btn-primary btn-round waves-effect" value="Classifier" name="extrait">
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="livraison">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Quantité Commande</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Quantité Livraison</label>
                                                    <div class="form-group">                                
                                                        <input type="date" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Poids</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Prix</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-raised btn-primary btn-round waves-effect" value="Classifier" name="livraison">
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="commande">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Sujet</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Date</label>
                                                    <div class="form-group">                                
                                                        <input type="date" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Durée</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Objectifs</label>
                                                    <div class="form-group">                                
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Notes</label>
                                                    <div class="form-group">                                
                                                        <textarea class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-raised btn-primary btn-round waves-effect" value="Classifier" name="commande">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php') ?>
<script type="text/javascript">
     var table = $('#table-class').DataTable({
        "info":false,
        "bLengthChange":false
    });
</script>