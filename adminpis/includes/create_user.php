<?php
require_once("sessions.php");
require_once("includes.php");
require_once("Database.php");
?>

<?php 
if($_POST["submit"]){
	$username = mysql_prep($_POST["username"]);
	$password = mysql_prep($_POST["password"]);
	$hashed_pass = password_hash($password);
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

} else {
	$_SESSION["message"] = "Please submit data.";
	redirect_to("../public/new_user.php");
}
?>

<html>
<head>
	<title></title>
</head>
<body>
	<div class="col-md-4">
		<h4>Supplier information</h4><hr>
		<label>Company name</label>
		<input type="text" name="suppname" class="form-control" required title="Field required."><br>
		<label>Address</label>
		<input type="text" name="suppadd" class="form-control" required><br>
		<label>Contact person</label>
		<input type="text" name="suppcont" class="form-control" required><br>
		<label>Email</label>
		<input type="email" name="suppemail" class="form-control" required><br>
		<label>Telephone</label>
		<input type="tel" name="supptel" class="form-control" required><br>
	</div>
</body>
</html>