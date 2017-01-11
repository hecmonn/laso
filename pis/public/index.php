<?php //AUTHOR: HECTOR MONARREZ ARAUJO
$title = "Home";
require_once("../includes/header.php")
?>
<div class="container">
	<?php echo session_message(); ?>
	<h1 align="center">Products Invoice Platform </h1><hr>
	<div class="row">
		<div class="col-md-6">
			<a href="new_entry.php">
				<div class="entry">
					<img src="images/plus-sign.png" height="150" width="150">
				</div></a>
			<h3 class="text-center">New Entry</h3><br>

			<a href="manage_orders.php">
				<div class="orders">
					<img src="images/chart.png" height="150" width="150">
				</div>
			</a>
			<h3 class="text-center">Manage Orders</h3><br>

			<a href="about.php">
				<div class="entry">
					<img src="images/about.png" height="150" width="150">
				</div></a>
			<h3 class="text-center">About</h3>
		</div>

		<div class="col-md-6 pull-right">
		<?php $not = $User->notifications();	?>
		<h3>Notifications</h3><hr>
			<div class="notifications">
				<table class="table table-striped">
					<?php echo $not; ?>
				</table>
			</div>
		</div>
	</div>

<?php require_once ("../includes/footer.php"); ?>
