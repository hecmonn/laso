<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO
$title = "View supplier";
require_once("../includes/header.php");
require_once("../includes/User.php");
$id_supp = $_GET["id_supp"];
$ids = validate_existence_supp();
if(!in_array($id_supp, $ids)){
	redirect_to("error.php");
}
$rows = $User->placed_orders($id_supp);
?>
<div class="container">
<a href="manage_suppliers.php">&laquo;Back</a>
<div class="row">
	<div class="col-md-6">
		<h2>Supplier information</h2><hr>
	</div>
	<div class="col-md-6 pull-right">
		<button style="margin-left:5px;"type="button" class="btn btn-lg btn-danger pull-right" data-toggle="modal" data-target="#modal-1">Delete</button>
		<a href="../includes/create_supplier_pdf.php?id_supp=<?php echo $id_supp ?>"  target ="_blank" class="btn btn-lg btn-warning pull-right">Export PDF</a>
		<div class="modal fade" id="modal-1">	
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title">Delete supplier confirmation</h3>
					</div>
					<div class="modal-body">
						<h4>Are you sure you want to delete this supplier?</a></h4>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn btn-info" data-dismiss="modal">Cancel</a>
						<a href="../includes/delete_supplier.php?id_supp=<?php echo $id_supp ?>" class="btn btn-danger">Delete</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
		$sql_supp = "select * from suppliers where idsuppliers= {$id_supp}";
		$res_supp = exec_query($sql_supp);
		$sql_pays = "select * from pays where id_suppliers= {$id_supp}";
		$res_pays = exec_query($sql_pays);
		$sql_us = "select * from users where id_supp = {$id_supp}";
		$res_us = exec_query($sql_us);
		while($row_us = mysqli_fetch_assoc($res_us)){
			$username = $row_us["username"];
		}
	?>
	<div class="row">
		<div class="col-md-6">
			<?php 
			while($row = mysqli_fetch_assoc($res_supp)){
				$output = "<h4><strong>Supplier code: </strong>" . htmlentities($row["idsuppliers"]) . "</h4>"; 
				$output .= "<h4><strong>Company name: </strong>" . htmlentities(ucfirst($row["name"])) . "</h4>"; 
				$output .= "<h4><strong>Address: </strong>" . htmlentities(ucfirst($row["address"])) . "</h4>"; 
				$output .= "<h4><strong>Fiscal ID: </strong>" . htmlentities($row["fiscal_id"]) . "</h4>"; 
				$output .= "<h4><strong>ZP: </strong>" . htmlentities($row["zp"]) . "</h4>";
				$output .= "<h4><strong>Society: </strong>" . htmlentities($row["society"]) . "</h4>"; 
				$output .= "<h4><strong>Organization: </strong>" . htmlentities($row["organization"]) . "</h4>"; 
				echo $output;		
			echo "</div>";
			echo "<div class=\"col-md-6\">";
				$output = "<h4><strong>Contact: </strong>" . htmlentities(ucfirst($row["contact"])) . "</h4>"; 
				$output .= "<h4><strong>Email: </strong>" . htmlentities($row["email"]) . "</h4>";  
				$output .= "<h4><strong>Username: </strong>" . htmlentities($username) . "</h4>"; 
				$output .= "<h4><strong>Created date: </strong>" . htmlentities(date("jS F, Y H:i", strtotime($row["created_date"]))) . "</h4>"; 
				$output .= "<h4><a href=\"stats_supp.php?s=$id_supp\">Supplier statistics</a></h4>"; 
				echo $output;
			echo "</div>";
			} ?>
	</div>
	<h2>Payment information</h2>
	<div class="col-md-4"><hr>
			<?php 
			while($row = mysqli_fetch_assoc($res_pays)){
				$output = "<h4><strong>Beneficiary: </strong>" . htmlentities(ucfirst($row["beneficiary"])) . "</h4>"; 
				$output .= "<h4><strong>Bank name: </strong>" . htmlentities(ucfirst($row["bank_name"])) . "</h4>"; 
				$output .= "<h4><strong>Bank account: </strong>" . htmlentities(ucfirst($row["bank_account"])) . "</h4>"; 
				$output .= "<h4><strong>Bank key: </strong>" . htmlentities($row["bank_key"]) . "</h4>"; 
				$output .= "<h4><strong>Bank city: </strong>" . htmlentities(ucfirst($row["bank_city"]. ", " . htmlentities(ucfirst($row["bank_country"])) )) . "</h4>"; 
				
				echo $output;
		echo "</div>"; ?>
		<div class="col-md-4"><br>
		<?php 
			$output = "<h4><strong>Branch: </strong>" . htmlentities(ucfirst($row["branch"])) . "</h4>"; 
			$output .= "<h4><strong>Swift: </strong>" . htmlentities(strtoupper($row["swift"])) . "</h4>"; 
			$output .= "<h4><strong>Clabe: </strong>" . htmlentities(strtoupper($row["clabe"])) . "</h4>"; 
			$output .= "<h4><strong>Aba: </strong>" . htmlentities($row["aba"]) . "</h4>";
			$output .= "<h4><strong>Iban: </strong>" . htmlentities($row["iban"]) . "</h4>";
			echo $output;
		echo "</div>"; ?>
		<div class="col-md-4"><br>
		<?php
			$output = "<h4><strong>Payment conditions: </strong>" . htmlentities(ucfirst($row["pay_cond"])) . "</h4>";
			$output .= "<h4><strong>Expiration conditions: </strong>" . htmlentities(ucfirst($row["expiration_conditions"])) . "</h4>";
			$output .= "<h4><strong>Currency: </strong>" . htmlentities(strtoupper($row["currency"])) . "</h4>";
			$output .= "<h4><strong>Expiration days: </strong>" . htmlentities($row["exp_days"]) . "</h4>";
			echo $output;
		}
		echo "</div>"; ?>
	</div>
</div>
<script src="../public/javascripts/jquery-2.1.1.min.js"></script>
<script src="../public/javascripts/bootstrap.min.js"></script>
<?php include_once("../includes/footer.php"); ?>