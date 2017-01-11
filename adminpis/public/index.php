<?php //AUTHOR: HECTOR MONARREZ ARAUJO
$title = "Home";
require_once("../includes/header.php")
?>
	<div class="container">
		<div class="welcome">
		</div>	
		<?php echo welcome_message(); ?>
		<?php echo session_message(); ?>
		<h1 align="center">Product Invoice Platform Management </h1><hr>
		<div class="col-md-4">
			<a href="new_request.php">
				<div class="orders">
					<img src="images/request.png" height="150" width="150">
				</div>
			</a>
			<h3 class="text-center">New request</h3>
		</div>
		<div id="orders" class="col-md-4">
			<a href="manage_orders.php">
				<div class="orders">
					<img src="images/chart.png" height="150" width="150">
				</div>
			</a>
			<h3 class="text-center">Manage Orders</h3>
		</div>

		<div class="col-md-4">
			<a href="manage_suppliers.php">
				<div class="entry">
					<img src="images/supplier.png" height="135" width="140">
				</div></a>
			<h3 class="text-center">Manage Suppliers</h3>
		</div>
	</div>

<?php require_once ("../includes/footer.php"); ?>