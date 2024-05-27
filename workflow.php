<?php
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
$idSess = $_SESSION['id'];
$doc = $conn->prepare("SELECT * FROM document, user where document.creePar = user.id AND document.creePar = '$idSess'");
$doc->execute();
$user = $conn->prepare("SELECT * FROM user");
$user->execute();
$user1 = $conn->prepare("SELECT * FROM user");
$user1->execute();
$user2 = $conn->prepare("SELECT * FROM user");
$user2->execute();
$user3 = $conn->prepare("SELECT * FROM user");
$user3->execute();
$workflow = $conn->prepare("SELECT * FROM workflow, document, user WHERE workflow.idDoc = document.idDoc AND document.creePar = user.id AND document.creePar = '$idSess'");
$workflow->execute();
$sessLogin = $_SESSION['login'];
$demande = $conn->prepare("SELECT * FROM workflow, document, user where workflow.idDoc = document.idDoc AND MATCH(destinataire) AGAINST('".$sessLogin."') And user.login = '".$sessLogin."'");
$demande->execute();
include('header.php') ;
?>

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2 id="titre">Workflow</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <a class="btn btn-success btn-icon float-right" href="javascript:void()" onclick="show()"><i class="zmdi zmdi-plus"></i></a>
                    <a class="btn btn-info btn-icon float-right" href="javascript:void()" onclick="showFlow()"><i class="zmdi zmdi-swap-vertical"></i></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix" id="workflow">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Mes <strong id="title">Workflow</strong></h2>
                            <ul class="header-dropdown">
	                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
	                                <ul class="dropdown-menu dropdown-menu-right">
	                                    <li><a href="javascript:void(0);" onclick="showW()">Mes Workflow</a></li>
	                                    <li><a href="javascript:void(0);" onclick="showW()">Demande</a></li>
	                                </ul>
	                            </li>
	                        </ul>
                        </div>
                        <div class="table-responsive social_media_table" id="mesW">
                            <table class="table table-hover c_table">
                                <thead>
                                    <tr>
                                        <th>Utilisateur</th>
                                        <th>Documents</th>
                                        <th>Destinataires</th>
                                        <th>Fonctions destinataires</th>                                               
                                        <th>Status</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php while ($row = $workflow->fetch()) {
                                    	$destinataire = $row['destinataire'];
                                    	$fonctionD = $row['fonctionD'];
                                    	$fd = explode("-", $fonctionD);
                                    	$des = explode("-", $destinataire);
                                    ?>
                                    <tr>
                                        <td><?php echo $_SESSION['prenom']." ".$_SESSION['nom']; ?></td>
                                        <td><a href="javascript:void()"><?php echo $row['nameDoc']; ?></a></td>
                                        <td>
                                        	<span class="font-weight-bold"><?php echo $des[0]; ?></span> 
                                        	<i class="zmdi zmdi-arrow-right"></i>
                                        	<span class="font-weight-bold"><?php echo $des[1]; ?> </span>
                                        </td>
                                        <td>
                                        	<span class="font-weight-bold"><?php echo $fd[0]; ?> </span> 
                                        	<i class="zmdi zmdi-arrow-right"></i>
                                        	<span class="font-weight-bold">  <?php echo $fd[1]; ?> </span>
                                        </td>
                                        <?php if ($row['reponse'] == "en attente") {?>
                                        <td class="text-warning"><?php echo $row['reponse']; ?></td>
                                        <?php }elseif ($row['reponse'] == "verifier") {?>
                                        <td class="text-info"><?php echo $row['reponse']; ?></td>
                                        <?php }elseif ($row['reponse'] == "valider") { ?>
                                        <td class="text-success"><?php echo $row['reponse']; ?></td>
                                        <?php }else {?>
                                        <td class="text-danger"><?php echo $row['reponse']; ?></td>
                                        <?php }?>
                                        <td>
                                        	<?php if ($row['reponse'] == "en attente") {?>
											 	<div class="progress-container progress-warning m-t-10">
													<span class="progress-badge"> 
														10%
													</span>
													<div class="progress">
														<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
														</div>
													</div>
												</div>
											<?php }elseif ($row['reponse'] == "verifier") {?>
												 	<div class="progress-container progress-primary m-t-10">
														<span class="progress-badge"> 
															50%
														</span>
														<div class="progress">
															<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
															</div>
														</div>
													</div>
											<?php }elseif ($row['reponse'] == "valider") { ?>
												 	<div class="progress-container progress-success m-t-10">
														<span class="progress-badge"> 
															100%
														</span>
														<div class="progress">
															<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
															</div>
														</div>
													</div>
											<?php }else {?>
													<div class="progress-container progress-danger m-t-10">
														<span class="progress-badge"> 
															100%
														</span>
														<div class="progress">
															<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
															</div>
														</div>
													</div>
                                            <?php }?>
                                        </td>
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive social_media_table" id="demande" style="display: none;">
                            <table class="table table-hover c_table">
                                <thead>
                                    <tr>
                                        <th>Documents</th>
                                        <th>Destinataires</th>
                                        <th>Fonctions destinataires</th>                                                   
                                        <th>Status</th>
                                        <th>Fonction</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php while ($row = $demande->fetch()) {
                                    	$destinataire = $row['destinataire'];
                                    	$fonctionD = $row['fonctionD'];
                                    	$fd = explode("-", $fonctionD);
                                    	$des = explode("-", $destinataire);
                                    	$rep = "";
                                    	if ($des[0] == $_SESSION['login']) {
                                    		$rep = $fd[0];
                                    	}
                                    	if ($des[1] == $_SESSION['login']) {
                                    		$rep = $fd[1];
                                    	}
                                    ?>
                                    <tr>
                                        <td><a href="javascript:void()"><?php echo $row['nameDoc']; ?></a></td>
                                        <td>
                                        	<span class="font-weight-bold"><?php echo $des[0]; ?></span> 
                                        	<i class="zmdi zmdi-arrow-right"></i>
                                        	<span class="font-weight-bold"><?php echo $des[1]; ?> </span>
                                        </td>
                                        <td>
                                        	<span class="font-weight-bold"><?php echo $fd[0]; ?> </span> 
                                        	<i class="zmdi zmdi-arrow-right"></i>
                                        	<span class="font-weight-bold">  <?php echo $fd[1]; ?> </span>
                                        </td>
                                        <?php if ($row['reponse'] == "en attente") {?>
                                        <td class="text-warning"><?php echo $row['reponse']; ?></td>
                                        <?php }elseif ($row['reponse'] == "verifier") {?>
                                        <td class="text-info"><?php echo $row['reponse']; ?></td>
                                        <?php }elseif ($row['reponse'] == "valider") { ?>
                                        <td class="text-success"><?php echo $row['reponse']; ?></td>
                                        <?php }else {?>
                                        <td class="text-danger"><?php echo $row['reponse']; ?></td>
                                        <?php }?>
                                        <td class="text-info font-weight-bold"><?php echo $rep; ?></td>
                                        <td>
                                        	<div class='btn-group'>
                                                <button type='button' class='btn btn-dark dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <i class='ti-settings'></i>
                                                </button>
                                                <div class='dropdown-menu' x-placement='bottom-start' style='position: absolute; '>
                                                    <a class='dropdown-item' href='javascript:void()'><i class='ti-eye'></i> Voir</a>
                                                    <a class='dropdown-item' href='workflow-fun.php?confirm=<?php echo $row['idFlow']; ?>&reponse=<?php echo $rep; ?>'><i class='ti-check'></i> Confirmer</a>
                                                    <a class='dropdown-item' href='workflow-fun.php?refuser=<?php echo $row['idFlow']; ?>'><i class='ti-trash'></i> Refuser</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
			<div class="row clearfix" id="add" style="display:none;">
                <div class="col-lg-12">
                    <div class="card">
                       <form class="body" method="POST" action="workflow-fun.php">
					   <div class="row mb-3">
							<div class="col-lg-3">
								<div class="form-group">
									<label>Nom :</label>
									<input type="text" class="form-control" name="nom">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label>Sujet :</label>
									<input type="text" class="form-control" name="sujet">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label>Fichier :</label>
									<select class="form-control" name="fichier">
									<?php while ($row = $doc->fetch()) {?>
										<option value="<?php echo $row['idDoc'] ?>"><?php echo $row['nameDoc'] ?></option>
									<?php }?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-5">
								<div class="form-group">
									<label>Destinataire 1 :</label>
									<select class="form-control" name="des1">
									<?php while ($row = $user->fetch()) {?>
										<option value="<?php echo $row['login'] ?>"><?php echo $row['nom']."".$row['prenom'] ?></option>
									<?php }?>
									</select>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="form-group">
									<label>Fonction :</label>
									<input type="text" class="form-control" name="fonc1">
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<a class="btn btn-sm btn-info btn-icon" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="top:1.5em;"><i class="zmdi zmdi-plus"></i></a>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="form-group">
									<label>Destinataire 2 :</label>
									<select class="form-control" name="des2">
									<?php while ($row = $user1->fetch()) {?>
										<option value="<?php echo $row['login'] ?>"><?php echo $row['nom']."".$row['prenom'] ?></option>
									<?php }?>
									</select>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="form-group">
									<label>Fonction :</label>
									<input type="text" class="form-control" name="fonc2">
								</div>
							</div>
						</div>
						<div class="row collapse" id="collapseExample">
							<div class="col-lg-5">
								<div class="form-group">
									<label>Destinataire 3 :</label>
									<select class="form-control" name="des3">
									<?php while ($row = $user2->fetch()) {?>
										<option value="<?php echo $row['login'] ?>"><?php echo $row['nom']."".$row['prenom'] ?></option>
									<?php }?>
									</select>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="form-group">
									<label>Fonction :</label>
									<input type="text" class="form-control" name="fonc3">
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<a class="btn btn-sm btn-info btn-icon" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="top:1.5em;"><i class="zmdi zmdi-plus"></i></a>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="form-group">
									<label>Destinataire 4 :</label>
									<select class="form-control" name="des4">
									<?php while ($row = $user3->fetch()) {?>
										<option value="<?php echo $row['login'] ?>"><?php echo $row['nom']."".$row['prenom'] ?></option>
									<?php }?>
									</select>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="form-group">
									<label>Fonction :</label>
									<input type="text" class="form-control" name="fonc4">
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<input type="submit" class="btn btn-lg btn-info" value="Ajouter" name="ajouter">
							</div>
						</div>
					   </form>
                    </div>
                </div>
            </div>
            <div class="row clearfix" id="flow" style="display:none;">
                <div class="col-lg-12">
                    <div class="card">
                    	
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php') ?>
<script type="text/javascript">
     var table = $('#table-doc').DataTable({
        "info":false,
        "bLengthChange":false
    });
	function show(){
		var titre =  document.getElementById("titre");
		var workflow =  document.getElementById("workflow");
		var add =  document.getElementById("add");
		var flow =  document.getElementById("flow");
		if(workflow.style.display == "none"){
			titre.innerHTML = "Workflow";
			workflow.style.display = "block";
			add.style.display = "none";
			flow.style.display = "none";
		}else{
			titre.innerHTML = "Ajouter un Workflow";
			workflow.style.display = "none";
			flow.style.display = "none";
			add.style.display = "block";
		}
	}

	function showFlow(){
		var titre =  document.getElementById("titre");
		var workflow =  document.getElementById("workflow");
		var flow =  document.getElementById("flow");
		var add =  document.getElementById("add");
		if(flow.style.display == "none"){
			titre.innerHTML = "FlowChart";
			flow.style.display = "block";
			workflow.style.display = "none";
			add.style.display = "none";
		}else{
			titre.innerHTML = "Workflow";
			workflow.style.display = "block";
			flow.style.display = "none";
			add.style.display = "none";
		}
	
	}

	function showW(){
		var titre =  document.getElementById("title");
		var mesW =  document.getElementById("mesW");
		var demande =  document.getElementById("demande");
		if(mesW.style.display == "none"){
			titre.innerHTML = "Workflow";
			mesW.style.display = "block";
			demande.style.display = "none";
		}else{
			titre.innerHTML = "Demande";
			mesW.style.display = "none";
			demande.style.display = "block";
		}
	}
</script>