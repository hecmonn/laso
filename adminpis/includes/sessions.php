<?php 
session_start();

function session_message() {
	if(isset($_SESSION["message"])){
		$output = "<div class=\"errors\">";
		$output .= htmlentities($_SESSION["message"]);
		$output .= "</div>";

		$_SESSION["message"] = null;
		return $output;
	}
}

function welcome_message(){
	if(isset($_SESSION["welcome_message"])){
		$output = "<div class=\"welcome\">";
		$output .= htmlentities($_SESSION["welcome_message"]);
		$output .= "</div>";

		$_SESSION["welcome_message"] = null;
		return $output;
	}
}

?>