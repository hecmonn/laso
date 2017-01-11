<?php //AUTHOR: HECTOR MONARREZ ARAUJO


//require_once("/Applications/XAMPP/htdocs/laso/_includes/init.php");
//pc_main path
require_once("/xampp\htdocs\laso\_includes\init.php");
require_once("User.php");

if(!isset($_SESSION["id_pis"])){
	redirect_to("../public/login.php");
}
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LASO | <?php  if(isset($title)) { echo $title; } else { echo "";} ?></title>
	<link rel="stylesheet" type="text/css" href="../public/stylesheets/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../public/stylesheets/style.css">
</head>
<body>
	<div class="container-fluid">
		<div class="col-md-6">
			<a href="../public/index.php">
				<img src="../public/images/logo.png" widht="40" height="80">
			</a>
		</div>
		<div class="col-md-6">
			<div class="logout"> <a href="notifications.php" class ="not">NOTIFICATIONS</a>
			<a href="../includes/logout.php" class="pull-right">Log Out</a></div>
		</div>
	</div>
