<?php
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
$stmt = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id and document.type IS NULL ORDER BY document.idDoc desc");
$stmt->execute();
$stmt1 = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id and document.type IS NULL ORDER BY document.idDoc desc");
$stmt1->execute();
$cnt = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id and document.type IS NOT NULL ORDER BY document.idDoc desc");
$cnt->execute();
$users = $conn->prepare("SELECT * FROM user");
$users->execute();
$doc = $conn->prepare("SELECT * FROM document where document.type = 'facture'");
$doc->execute();
$idSess = $_SESSION['id'];
$mesFichiers = $conn->prepare("SELECT * FROM document,user where document.creePar = user.id and creePar = '$idSess'");
$mesFichiers->execute();
include('header.php') ;
?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Accueil</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card w_data_1">
                       <div class="body">
                            <div class="w_icon indigo"><i class="zmdi zmdi-account"></i></div>
                            <h4 class="mt-3"><?php echo count($users->fetchAll()); ?></h4>
                            <span class="text-muted">Utilisateurs</span>
                       </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card w_data_1">
                       <div class="body">
                            <div class="w_icon pink"><i class="zmdi zmdi-file"></i></div>
                            <h4 class="mt-3"><?php echo count($stmt->fetchAll()); ?></h4>
                            <span class="text-muted">Documents en attente</span>
                       </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card w_data_1">
                       <div class="body">
                            <div class="w_icon pink"><i class="zmdi zmdi-file-plus"></i></div>
                            <h4 class="mt-3"><?php echo count($doc->fetchAll()); ?></h4>
                            <span class="text-muted">Documents</span>
                       </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card w_data_1">
                       <div class="body">
                            <div class="w_icon orange"><i class="zmdi zmdi-file-text"></i></div>
                            <h4 class="mt-3"><?php echo count($mesFichiers->fetchAll()); ?></h4>
                            <span class="text-muted">Vos Fichiers</span>
                       </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Documents</strong></h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
								<table class="table table-hover mb-0 c_table footable footable-1 footable-paging footable-paging-center breakpoint breakpoint-md" style="">
									<thead>
										<tr class="footable-header">
											<th class="footable-sortable footable-first-visible" style="display: table-cell;">Options<span class="fooicon fooicon-sort"></span></th>
											<th class="footable-sortable footable-first-visible" style="display: table-cell;">Documents<span class="fooicon fooicon-sort"></span></th>
											<th data-breakpoints="xs" class="footable-sortable" style="display: table-cell;">User<span class="fooicon fooicon-sort"></span></th>
											<th data-breakpoints="xs" class="footable-sortable footable-last-visible" style="display: table-cell;">Type<span class="fooicon fooicon-sort"></span></th>
										</tr>
									</thead>
									<tbody>
									<?php while ($row = $cnt->fetch()) {?>
										<tr>
											<td>
												<?php if ($row['id'] == $_SESSION['id']) { ?>
												<a href="classement.php?id=<?php echo $row['idDoc'] ; ?>" class="ml-auto text-black"><span class="badge badge-success badge-pill ml-auto">&#10004;</span></a>
													&nbsp;
												<a href="upload-supprimer.php?id=<?php echo $row['idDoc'] ; ?>"><span class="badge badge-danger badge-pill">x</span></a>
												<?php }else{ ?>
												<a href="javascript:void()" class="ml-auto text-black"><span class="badge badge-default badge-pill ml-auto">&#10004;</span></a>
													&nbsp;
												<a href="javascript:void()"><span class="badge badge-default badge-pill">x</span></a>
												<?php } ?>
													
											</td>
											<td><?php echo" <a href='".$row['path'].$row['nameDoc']."'>".$row['nameDoc']."</a>"; ?></td>
											<td><?php echo $row['nom']." ".$row['prenom']; ?></td>
											<td><?php echo $row['type']; ?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>			
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Fichiers <strong>en attente</strong></h2>
                        </div>
                        <div class="body todo_list">                        
                            <ul class="list-group">
								<li class="list-group-item d-flex justify-content-between align-items-center">
										<a href="" class="text-black">Documents</a>
										<a href="" class="ml-auto text-black">Options</a>
								</li>
							<?php while ($row = $stmt1->fetch()) {?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="" class=""><?php echo $row['nameDoc'];?></a>
									<a href="javascript:void()" class="ml-auto text-black"><span class="badge badge-default badge-pill ml-auto">&#10004;</span></a>
										&nbsp;
									<a href="javascript:void()"><span class="badge badge-default badge-pill">x</span></a>
                                </li>
							<?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
include('footer.php');
?>