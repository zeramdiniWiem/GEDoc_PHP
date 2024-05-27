<?php 
session_start();
if(empty($_SESSION['id'])){
    header("location:index.php");
}
require('base/connect.php');
$stmt = $conn->prepare("SELECT * FROM role");
$stmt->execute();

$stmt1 = $conn->prepare("SELECT * FROM document");
$stmt1->execute();
$titre = "Roles";
include('header.php');

?>

<section class="content">
    <div class="body_scroll">
        <div class="block-header">

            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>roles</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-8">
                    <div class="card">
                            <div class="body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-role" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Options</th>
                                            <th>nameRole</th>
                                            <th class="hide">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $stmt->fetch()) {?>
                                        <?php echo"<tr id='row-".$row['id']."'>
                                            <td>
                                                <div class='btn-group'>
                                                    <button type='button' class='btn btn-dark dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        <i class='ti-settings'></i>
                                                    </button>
                                                    <div class='dropdown-menu' x-placement='bottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);'>
                                                        <a class='dropdown-item' href='javascript:void()' id='edit'><i class='ti-pencil-alt'></i> Modifier</a>
                                                        <a class='dropdown-item' href='javascript:void()'  id='delete'><i class='ti-trash'></i> Supprimer</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>".$row['nameRole']."</td>
                                            <td class='hide'>".$row['id']."</td>
                                        </tr>";}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card" style="background-color: white;">
                        <div class="card-body">
                            <form method="POST" action="role-ajouter.php">
                                    <div class="c-body">
                                        <input name="id" type="text" class="form-control hide" id="id">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <label>Nom role</label>
                                                <div class="form-group">                                
                                                    <input name="nameRole" type="text" class="form-control" id="nameRole" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <select class="form-control" style="background-color: white;" name="type[]">
													<option disabled selected>Type</option>         
													<option value="facture">Facture</option>        
													<option value="contrat">Contrat</option>        
													<option value="courier">Courier</option>        
													<option value="extrait Compte">Extrait Compte</option>        
													<option value="bon de commande">Bon de Commande</option>        
													<option value="bon de livraison">Bon de Livraison</option>        
												</select>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox1" type="checkbox" name="r[]" value="r">
													<label for="checkbox1">r</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox2" type="checkbox" name="w[]" value="w">
													<label for="checkbox2">w</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox3" type="checkbox" name="x[]" value="x">
													<label for="checkbox3">x</label>
												</div>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <select class="form-control" style="background-color: white;" name="type[]">
													<option disabled selected>Type</option>         
													<option value="facture">Facture</option>        
													<option value="contrat">Contrat</option>        
													<option value="courier">Courier</option>        
													<option value="extrait Compte">Extrait Compte</option>        
													<option value="bon de commande">Bon de Commande</option>        
													<option value="bon de livraison">Bon de Livraison</option>        
												</select>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox4" type="checkbox" name="r[]" value="r">
													<label for="checkbox4">r</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox5" type="checkbox" name="w[]" value="w">
													<label for="checkbox5">w</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox6" type="checkbox" name="x[]" value="x">
													<label for="checkbox6">x</label>
												</div>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <select class="form-control" style="background-color: white;" name="type[]">
													<option disabled selected>Type</option>         
													<option value="facture">Facture</option>        
													<option value="contrat">Contrat</option>        
													<option value="courier">Courier</option>        
													<option value="extrait Compte">Extrait Compte</option>        
													<option value="bon de commande">Bon de Commande</option>        
													<option value="bon de livraison">Bon de Livraison</option>        
												</select>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox7" type="checkbox" name="r[]" value="r">
													<label for="checkbox7">r</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox8" type="checkbox" name="w[]" value="w">
													<label for="checkbox8">w</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox9" type="checkbox" name="x[]" value="x">
													<label for="checkbox9">x</label>
												</div>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <select class="form-control" style="background-color: white;" name="type[]">
													<option disabled selected>Type</option>         
													<option value="facture">Facture</option>        
													<option value="contrat">Contrat</option>        
													<option value="courier">Courier</option>        
													<option value="extrait Compte">Extrait Compte</option>        
													<option value="bon de commande">Bon de Commande</option>        
													<option value="bon de livraison">Bon de Livraison</option>        
												</select>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox10" type="checkbox" name="r[]" value="r">
													<label for="checkbox10">r</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox11" type="checkbox" name="w[]" value="w">
													<label for="checkbox11">w</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox12" type="checkbox" name="x[]" value="x">
													<label for="checkbox12">x</label>
												</div>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <select class="form-control" style="background-color: white;" name="type[]">
													<option disabled selected>Type</option>         
													<option value="facture">Facture</option>        
													<option value="contrat">Contrat</option>        
													<option value="courier">Courier</option>        
													<option value="extrait Compte">Extrait Compte</option>        
													<option value="bon de commande">Bon de Commande</option>        
													<option value="bon de livraison">Bon de Livraison</option>        
												</select>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox13" type="checkbox" name="r[]" value="r">
													<label for="checkbox13">r</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox14" type="checkbox" name="w[]" value="w">
													<label for="checkbox14">w</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox15" type="checkbox" name="x[]" value="x">
													<label for="checkbox15">x</label>
												</div>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <select class="form-control" style="background-color: white;" name="type[]">
													<option disabled selected>Type</option>         
													<option value="facture">Facture</option>        
													<option value="contrat">Contrat</option>        
													<option value="courier">Courier</option>        
													<option value="extrait Compte">Extrait Compte</option>        
													<option value="bon de commande">Bon de Commande</option>        
													<option value="bon de livraison">Bon de Livraison</option>        
												</select>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox16" type="checkbox" name="r[]" value="r">
													<label for="checkbox16">r</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox17" type="checkbox" name="w[]" value="w">
													<label for="checkbox17">w</label>
												</div>
                                            </div>
											<div class="col-sm-12 col-md-2">
                                                <div class="checkbox">
													<input id="checkbox18" type="checkbox" name="x[]" value="x">
													<label for="checkbox18">x</label>
												</div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-raised btn-primary waves-effect m-t-30" value="Ajouter" name="ajouter" id="ajouter">
                                        <input type="submit" class="btn btn-raised btn-primary waves-effect m-t-30" value="Modifier" name="modifier" id="modifier" style="display: none;">
                                    </div>
                            </form>
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
<script type="text/javascript">
    Notiflix.Confirm.Init({
        titleColor: '#f7094a',
        okButtonBackground: '#f7094a',
    });

    var table = $('#table-role').DataTable({
        "info":false,
        "bLengthChange":false
    });

    $('#table-role tbody').on('click','#delete',function(){
        var row = table.row($(this).closest('tr'));
        var id = row.data()[2];
        Notiflix.Confirm.Show(
        'Veuillez Confirmer',
        'Etes-vous sur de supprimer cela?',
        'Oui',
        'Non',
        function(){ 
            Notiflix.Loading.Circle('Veuillez patientez...');
            $.ajax({
                url: "role-supprimer.php",
                type: "GET",
                data: {
                    id: id              
                },
                cache: false,
                timeout: 10000,
                success: function(){
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Warning('Supprimé avec succés');
                    setTimeout(table.row('#row-'+id).remove().draw(false), 2000);
                },
                error: function (e) {
                  Notiflix.Notify.Error('Veuillez ressayez plus tard');
              }
            });
        },false);
    });

    $('#table-role tbody').on('click','#edit',function(){

        var btnEdit = document.getElementById("modifier");
        var btnAdd = document.getElementById("ajouter");
        btnAdd.style.display = "none";
        btnEdit.style.display = "block";
        
        var row = table.row($(this).closest('tr'));

        var id = document.getElementById("id");
        var nameRole = document.getElementById("nameRole");
        var service = document.getElementById("service");
       
        nameRole.value = row.data()[1];
        //service.value = row.data()[2];
       
        id.value = row.data()[2];

    });

    $("#modifier").click(function () {
        $("#modifier").unbind();

        var id = $("#id").val();
        var nameRole = $("#nameRole").val();
       
        var row = table.row("#row-"+id);

        var rowIndex = row.index();
        
        Notiflix.Loading.Circle('Veuillez patientez...');
        
        $("#modifier").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: "role-modifier.php",
          data:{
            id: id,
            nameRole: nameRole
          }, 
          cache: false,
          timeout: 800000,
          success: function (data) {
             $("#modifier").prop("disabled", false);
              table.cell({row:rowIndex,column:1}).data(nameRole);
              Notiflix.Loading.Remove();
              Notiflix.Notify.Success('Modifié avec succée');
          },
          error: function (e) {
              $("#modifier").prop("disabled", false);
          }
        });
    });
</script>
</body>
</html>