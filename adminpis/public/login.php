<?php 
//AUTHOR:HECTOR MONARREZ ARAUJO
require_once("../includes/sessions.php");
require_once("../includes/includes.php");
require_once("../includes/User.php");
?>
<?php
//validations
?>
<?php
$user="";

if(isset($_POST["submit"])){
	if(empty($_POST["user"]) OR empty($_POST["pass"])){
		$_SESSION["message"]="Please fill username and password.";
	} 
	else {
		$user = $_POST["user"];
		$password = $_POST["pass"];
		$user_found = attempt_login($user, $password);
		if($user_found){
			$_SESSION["id_admin"] = $user_found["id"];
			$_SESSION["user_admin"] = $user_found["username"];
			$_SESSION["welcome_message"] = "Welcome " . htmlentities(ucfirst($User->supp_name));
			redirect_to("../public/index.php");
		} else{
			$_SESSION["message"]="Username/password incorrect.";
		}
	}
}
?>

<html>
<head>
	<title>LASO | Log In</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4"><br><br><br>
			<div class="logo-header">
				<img src="images/logo.png" align="middle"> <hr>
			</div>
			<div class="login">
			<?php echo session_message(); ?> <br>
				<form action="login.php" method="post">
					<input type="text" name="user" placeholder="Username" value="<?php echo htmlentities($user); ?>" class="form-control" required><br><br>
					<input type="password" name ="pass" placeholder="Password" class="form-control" required><br><br>
					<input type="submit" name="submit" value="Log In" class="btn btn-lg btn-success">
				</form>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>
<?php require_once("../includes/footer.php"); ?>

