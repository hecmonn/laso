<?php
$title = "Edit Order";
require_once("../includes/header.php");
$po_id = $_GET["po_id"];
$sql = "SELECT * FROM comp_ent WHERE id = ".$po_id;
$res = exec_query($sql);
while($row = mysqli_fetch_assoc($res)){
	$person_charge = $row["person_name"];
	$date=  $row["created_date"] ;
	$rem = $row["remarks"];
	$tot_gen = $row["tot_gen"];
}

if(isset($_POST["submit"])){
	$count = count($_POST["moq"]);
	echo $count;
	$tot_gen =0;
	for($i=0; $i<$count; $i++){
		$id = $_POST["id"][$i];
		$moq = !empty($_POST["moq"][$i]) ? null : mysql_prep($_POST["moq"][$i]);
		$fob = mysql_prep($_POST["fob_sh"][$i]);
		exec_query("begin;");
		$price = $moq * $fob;
		$tot_gen = $tot_gen + $price;
		$sql = "UPDATE pi_entries SET moq = {$moq}, fob_sh = {$fob} WHERE id= {$id}";
		$res = exec_query($sql);
		$upd_tot_gen = "UPDATE comp_ent SET tot_gen = {$tot_gen} WHERE id={$po_id}";
		$res_upd = exec_query($upd_tot_gen);
	}
	if($res && $res_upd){
		exec_query("commit;");
		$_SESSION["message"]= "Order #" .$po_id." succesfully updated.";
		redirect_to("index.php");
	}
	else {
		exec_query("rollback;");
		$_SESSION["message"] = "Data not updated, please try again.";
		redirect_to("edit_orders.php?po_id=".$po_id);
	}
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo session_message(); ?>
			<h4><strong><?php echo "PO Number: </strong>#". $po_id; ?></h4>
			<h4><strong><?php echo "Person in charge: </strong>" . htmlentities(ucfirst($person_charge)); ?></h3>
			<h4><strong><?php echo "Date Issued: </strong>" . htmlentities($date); ?></h3><br>
		</div>
	</div>
	<form action ="edit_orders.php?po_id= <?php echo $po_id ?>" method="post">
		<table class="table table-striped">
			<tr>
				<th>Photo</th>
				<th>Style</th>
				<th>Composition</th>
				<th>Color</th>
				<th>MOQ</th>
				<th>Unit Price</th>
			</tr>
			<?php
			$get_prod = $User->edit_orders($po_id);
			echo $get_prod;

			?>
		</table>
		<input type="submit" name="submit" value="Edit" class="btn btn-info pull-right">
	</form>
	<a href="manage_orders.php">
		<button class="btn btn-danger pull-right bttn-edit" style="margin-right:10px;">Cancel</button>
	</a>
	
</div>
<?php require_once("../includes/footer.php"); ?>