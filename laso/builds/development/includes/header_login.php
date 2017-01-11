<?php
define("BASE_DIR","/Applications/XAMPP/htdocs/laso/");
require_once(BASE_DIR."_includes/init.php");

if(isset($_POST["submit"])){
	$user = $_POST["username"];
	$password = $_POST["password"];
	$user_found = attempt_login($user, $password);
	if($user_found){
		$_SESSION["id_pis"] = $user_found["id"];
		$_SESSION["user_pis"] = $user_found["username"];
		//$ini = $User->supplier_name();
		//$_SESSION["welcome_message"] = "Welcome " . htmlentities(ucfirst($User->supp_name));
		redirect_to("/laso/pis/public/index.php");
	} else{
		$_SESSION["message"]="Username/password incorrect." . $user_found;
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php if(isset($title)) echo $title ." | "; ?>Liverpool</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css" media="screen" title="no title">
    </head>
    <body>
        <header>
            <div class="top-nav">
                <div class="left-top-nav">
                    <a href="liverpool.php"><div class="logo-liverpool">
                    </div></a>
                </div>
                <div class="options-menu">
                    <ul>
                        <span class="login">
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Log in</a></li>
                        </span>
                        <span class="lan">
                            <li><a <?php if(isset($title)) if($title==="Legal") echo "class=\"active-legal\""; ?> href="legal.php">Legal Terms</a></li>
                        </span>
                    </ul>
                </div>
            </div>
            <nav class="top-nav-menu">
                <div class="main-nav">
                    <ul>
                        <li class="dropdown <?php if(isset($title)) if($title==="About") echo "active-item"; ?>">
                            <a class="ddc-trigger ">About Liverpool
                            <ul class="dropdown-content"><br>
                                <li><a href="about.php">Profile, Mission and Values</a></li><br><br>
                                <li><a href="presence.php">Geographical presence</a></li><br><br>
                            </ul></a>
                        </li>
                        <li <?php if(isset($title)) if($title==="Investors") echo "class=\"active-item\""; ?>><a href="investors.php">Investors</a></li>
                        <li <?php if(isset($title)) if($title==="Laso") echo "class=\"active-item\""; ?>><a href="laso.php">LASO</a></li>
                    </ul>
                </div>
            </nav>
        </header>
