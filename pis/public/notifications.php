<?php
$title ="Notifications";
require_once("../includes/header.php");
$not = $User->notifications();
?>
	<div class="container">
		<h2>Notifications</h2><hr>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<table class="table table-striped">
					<?php echo $not; ?>
				</table>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>

<?php include_once("../includes/footer.php"); ?>