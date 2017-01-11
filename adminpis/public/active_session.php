<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO
$title="Active user";
require_once("../includes/header.php");
$id = $User->user_id;
$user = $User->user_username;
 ?>
<div class="container">
	<h2>Active User</h2><hr>
	<strong>ID: </strong><h4><?php echo $id ?> </h4><br>
	<strong>User: </strong> <h4><?php echo $user ?></h4><br>
</div>

<?php require_once("../includes/footer.php"); ?>