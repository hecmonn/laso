<?php  //AUTHOR:HECTOR MONARREZ ARAUJO
$title =  "About";
require_once("../includes/header.php"); 
$supplier_set = $User->supplier_name();
$sql = "SELECT * FROM comp_ent WHERE id_supp =" . $User->supp_id; 
$cont_rows = exec_query($sql);
$rows = mysqli_num_rows($cont_rows);
$sql_pays = "SELECT * FROM pays WHERE id_suppliers=" . $User->supp_id;
$res_pays=exec_query($sql_pays);
?>

<?php 
?>
<div class="container">
	<h2>About Me</h2><hr>
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
			<h4><strong><?php echo "Username: </strong>" . htmlentities($User->user_username); ?></h4>
			<h4><strong><a href="edit_user.php">Change password</a></h4>
		</div>	
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
</body>
<?php require_once("../includes/footer.php"); ?>