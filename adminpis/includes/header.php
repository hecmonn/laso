<?php //AUTHOR: HECTOR MONARREZ ARAUJO
require_once("sessions.php");
require_once("includes.php");
require_once("Database.php");
require_once("User.php");
if(!isset($_SESSION["id_admin"])){
	redirect_to("../public/login.php");
}
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LASO | <?php  if(isset($title)) { echo $title; } else { echo "";} ?></title>
	<link rel="stylesheet" type="text/css" href="../public/stylesheets/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="../public/stylesheets/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../public/stylesheets/style.css">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<a class="logo" href="../public/index.php"><img src="../public/images/logo.png" widht="40" height="80"></a>
		</div>
		<div class="col-md-7" role="navigation">
			<nav class="navbar navbar-light bg-faded">
				<ul class="nav navbar-nav">

					<li class="nav-item active">
						<a class="nav-link" href="../public/index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../public/new_request.php">Request</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../public/manage_orders.php" id="dropdown">Orders</a>
					<li class="nav-item">
						<a class="nav-link" href="../public/manage_suppliers.php">Suppliers</a>
					</li>
				</ul>
			</nav>

	    </div>
			<a class="logout pull-right" href="../includes/logout.php">Log Out</a>
	    </div>
	</div>
</div>
