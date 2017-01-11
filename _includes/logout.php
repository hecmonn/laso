<?php 
require_once("sessions.php");
require_once("includes.php");
	$_SESSION["id_admin"] = null;
	$_SESSION["user_admin"] = null;
	redirect_to("../public/login.php");
?>