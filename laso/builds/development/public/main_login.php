<?php
define("BASE_DIR","/Applications/XAMPP/htdocs/laso/");
require_once(BASE_DIR."_includes/init.php");
$user=$_POST["u"];
$pass=$_POST["p"];
$user_found = attempt_login($user, $pass);
if($user_found){
	$_SESSION["id_pis"] = $user_found["id"];
	$_SESSION["user_pis"] = $user_found["username"];
	//$ini = $User->supplier_name();
	//$_SESSION["welcome_message"] = "Welcome " . htmlentities(ucfirst($User->supp_name));
	//redirect_to(BASE_DIR."pis/public/index.php");
	$res="true";
} else{
	$res="false";
}
echo $res;
?>
