<?php //AUTHOR: HECTOR E. MONARREZ A.
$title="View Order";
require_once("../includes/header.php");
require_once("../includes/Photograph.php");
$po_id =$_GET["po_id"];
$ids = validate_existence();
if(!in_array($po_id, $ids)){
	redirect_to("error.php");
}
$ini = $User->supplier_name();
$sql = "SELECT * FROM comp_ent WHERE id = " . $po_id;
$res = exec_query($sql);
	while($row = mysqli_fetch_assoc($res)){
		$person_charge = $row["person_name"];
		$date=  $row["created_date"] ;
		$rem = $row["remarks"];
		$tot_gen = $row["tot_gen"];
		$id_supp = $row["id_supp"];
	}
$accepted_pis = $User->accepted_orders();
$status = null;
if(in_array($po_id, $accepted_pis)){
	$status = "ACCEPTED";
}
?>
<link rel="stylesheet" type="text/css" href="stylesheets/modal_img.css">
<div class="container">
	<div class="title">
		<h2>Order Details</h1>
		<div class="row">
			<div class="col-md-6">
				<a href="manage_orders.php"><img src="images/arrow-left.png" width="23" height="25"><br>Back</a>
			</div>
			<div class="col-md-6">
				<?php if($status == "ACCEPTED") {
					echo "<div class=\"stat\">". $status ."</div><br>";
				}?>
				<a href="../includes/create_pdf.php?id_supp=<?php echo $id_supp."&"; ?>po_id=<?php echo $po_id ?>" target="_blank" class="btn btn-lg btn-warning pull-right">Export PDF</a>
			</div>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-md-6">
			<h4><strong><?php echo "PO Number: </strong>#". $po_id; ?></h4>
			<h4><strong><?php echo "Person in charge: </strong>" . htmlentities(ucfirst($person_charge)); ?></h3>
			<h4><strong><?php echo "Date Issued: </strong>" . date("jS F, Y", strtotime($date)); ?></h3><br>
		</div>
		<div class="col-md-6">
			<h4><strong><?php echo "Company name: </strong>". htmlentities(ucfirst($User->supp_name)); ?></h4>
			<h4><strong><?php echo "Address: </strong>". htmlentities(ucfirst($User->supp_address)); ?></h4>
			<h4><strong><?php echo "Cellphone: </strong>". htmlentities($User->supp_cell); ?></h4>
			<h4><strong><?php echo "Email: </strong>".  htmlentities($User->supp_email); ?></h4>

		</div>
	</div>
	<table class = "table table-striped">
		<tr>
			<th>Photo</th>
			<th>Style</th>
			<th>Composition</th>
			<th>Color</th>
			<th>MOQ</th>
			<th>FOB</th>
		</tr>
		<?php
			$table_detail = $User->show_order_detail($po_id);
			echo $table_detail;
		?>
	</table>
	<div class="col-md-6">
		<div class="remarks"><h4><strong><?php echo "Remarks: </strong><br>". $rem; ?></h4></div>
	</div>
	<div class="col-md-6">
		<h4><strong><?php echo "Grand Total: </strong><br>". "$" . number_format($tot_gen,2,'.',',') . " USD" ; ?></h4>
	</div>
</div>
<?php include_once("../includes/footer.php"); ?>
<script type="text/javascript" src="javascripts/img_modal.js"></script>