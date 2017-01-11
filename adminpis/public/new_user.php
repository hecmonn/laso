<?php
$title="New user";
require_once("../includes/header.php");

if(isset($_POST["submit"])){
	$username = mysql_prep($_POST["username"]);
	$password = mysql_prep($_POST["password"]);
	$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
	exec_query("begin;");
	$sql_user ="INSERT INTO users(username, password, type) VALUES ('" . $username . "','" . $hashed_pass . "', '1')";
	$res_us = exec_query($sql_user);

	if($res_us) {
		exec_query("commit;");
		$_SESSION["message"] = "User created succesfully.";
		redirect_to("../public/manage_suppliers.php");
	}else {
		exec_query("rollback;");
		$_SESSION["message"] = "Please enter data again.";
		redirect_to("../public/new_user.php");
	}

} 
?>

<div class="container-fluid">
	<div class="user-form">					
		<a href="manage_suppliers.php">&laquo;Back</a>
		<h2>Create user</h2><hr>
	</div>
	<?php echo session_message(); ?>
	<form action="new_user.php" method="post">			
		<div class="col-md-4">
			<label>Username</label>
			<input type="text" name="username" class="form-control" required><br>
			<label>Password</label>
			<input type="password" name="password" id="password" class="form-control"><br>
			<input type="password" name="passwordconf" id="passwordconf" class="form-control" placeholder="Confrim password" oninput="check(this)"><br>
			<script language='javascript' type='text/javascript'>
				function check(input) {
				    if (input.value != document.getElementById('password').value) {
				        input.setCustomValidity('Passwords does not match.');
				    } else {
				        // input is valid -- reset the error message
				        input.setCustomValidity('');
				   }
				}
				</script>
			<input type="submit" name="submit" value="Create" class="btn btn-success">
	</form>
		</div>
	</div>
</div>
<?php include_once("../includes/footer.php"); ?>