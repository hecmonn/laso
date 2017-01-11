<?php 
$title="Edit user";
require_once("../includes/header.php");
$User->supplier_name();
if(isset($_POST["submit"])){
	$password = mysql_prep($_POST["old_pass"]);
	$new_pass = mysql_prep($_POST["new_pass"]);

	$conf = password_check($password, $User->password);
	if($conf){
		$new_hash = password_encrypt($new_pass);
		$sql_pass = "UPDATE users SET password = '{$new_hash}' WHERE id = {$User->id}";
		$res_pass = exec_query($sql_pass);
		if($res_pass) {
			$_SESSION["message"] = "Password updated succesfully.";
			redirect_to("about.php");
		}
	}
	else{
		$_SESSION["message"]="Wrong password.";
		redirect_to("edit_user.php");
	}
}

?>
<div class="container">
<h2>User</h2><hr>
	<div class="col-md-6">
		<h4><strong><?php echo "Company name: </strong>". htmlentities(ucfirst($User->supp_name)); ?></h4>
		<h4><strong><?php echo "Address: </strong>". htmlentities(ucfirst($User->supp_address)); ?></h4>
		<h4><strong><?php echo "Cellphone: </strong>". htmlentities($User->supp_cell); ?></h4>
		<h4><strong><?php echo "Email: </strong>".  htmlentities($User->supp_email); ?></h4>
		<h4><strong><?php echo "Username: </strong>".  htmlentities($User->user_username); ?></h4>
	</div>
	<div class="col-md-6">
		<h4>Change password</h4><?php echo session_message(); ?><hr>
		<form action="edit_user.php" method="post">
			<label for="old_pass">Password</label>
			<input type="password" name="old_pass" class="form-control" required>
			<label for="new_pass">New password</label>
			<input type="password" name="new_pass" id="new_pass" class="form-control" required><br>
			<input type="password" name="conf_pass" placeholder="Confirm password" oninput="check(this)" class="form-control" required><br>
			<script language='javascript' type='text/javascript'>
				function check(input) {
				    if (input.value != document.getElementById('new_pass').value) {
				        input.setCustomValidity('Passwords does not match.');
				    } else {
				        // input is valid -- reset the error message
				        input.setCustomValidity('');
				   }
				}
			</script>
		<input type="submit" name="submit" value="Confirm" class="btn btn-success pull-right">
		</form>
	</div>
</div>
 <?php include_once("../includes/footer.php"); ?>