<?php //AUTHOR: HECTOR MONARREZ
$title =  "About";
require_once("../includes/header.php"); 
$supplier_set = $User->supplier_name();
$sql = "SELECT * FROM comp_ent WHERE id_supp =" . $User->supp_id; 
$cont_rows = exec_query($sql);
$rows = mysqli_num_rows($cont_rows);?>

<?php 
//add supplier info from class User
?>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h4><strong><?php echo "Company name: </strong>". htmlentities(ucfirst($User->supp_name)); ?></h4>
			<h4><strong><?php echo "Address: </strong>". htmlentities(ucfirst($User->supp_address)); ?></h4>
			<h4><strong><?php echo "Cellphone: </strong>". htmlentities($User->supp_cell); ?></h4>
			<h4><strong><?php echo "Email: </strong>".  htmlentities($User->supp_email); ?></h4>
		</div>
		<div class="col-md-6">
			<h4><strong><?php echo "Contact: </strong>" . htmlentities($User->supp_cont); ?></h4>
			<h4><strong><?php echo "Placed orders: </strong>" . $rows; ?></h4>
		</div>	
	</div>
</div>
</body>
<?php require_once("../includes/footer.php"); ?>

