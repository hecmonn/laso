<?php
require_once("Database.php");
function redirect_to($location){
		header("Location: " . $location);
		exit;
}

function mysql_prep($string){
	global $Database;
	$encoded_string = utf8_encode($string);
	return mysqli_real_escape_string($Database->con, $encoded_string);
}

function exec_query($sql) {
	global $Database;
	$result_set = mysqli_query($Database->con, $sql);
	if(!$result_set){
		die("Query failed " . mysqli_error($Database->con) . $sql);
	}
	return $result_set;
}

function find_all_admins($users_set) {
	$query = "SELECT * FROM USERS ORDER BY username ASC";
	$users_set = confirm_query($query);
	return $users_set;
}

function find_subject_by_id($user_id){
	global $con;
	$safe_user_id = mysqli_real_escape_string($con, $user_id);
	$query = "SELECT * FROM USERS WHERE id_users = {$safe_user_id} LIMIT 1";
	$user_set = mysqli_query($con, $query);

	if ($user =mysqli_fetch_assoc($user_set)) {
		return $user;
	} else {
		return null;
	}
}

function find_username($username) {
	global $Database;
	$safe_username = mysql_prep($username);
	$query = "SELECT * FROM users WHERE username = '". $safe_username ."' and type=2 LIMIT 1";
	$user_set = exec_query($query);
	if ($user = mysqli_fetch_assoc($user_set)) {
		return $user;
	} else {
		return null;
	}
}

function password_check($password, $existing_hash){
	$hash = crypt($password, $existing_hash);
	if($hash === $existing_hash) {
		return true;
	} else {
		return false;
	}
}

function attempt_login($tempt_username, $password){
	$attempting_user=find_username($tempt_username);
	if($attempting_user){
		if(password_verify($password, $attempting_user["password"])){
			return $attempting_user;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function generate_salt($length){
	$unique_string = md5(uniqid(mt_rand(), true));
	$base64_string = base64_encode($unique_string);
	$modified_base64_string = substr('+','.', $base64_string);
	$salt = substr($modified_base64_string, 0, $length);
	return $salt;
}

function password_encrypt($password, $existing_hash){
	$hash_format = "$2y$10$";
	$salt = generate_salt(22);
	$format_salt = $hash_format . $salt;
	$hash = crypt($password, $format_salt);
	return $hash;
}

function validate_existence_user(){
	$sql = "SELECT * FROM users";
	$res = exec_query($sql);
	while($row = mysqli_fetch_assoc($res)){
		$ids[] = $row["username"];
	}
	return $ids;
}

function validate_existence_supp(){
	$sql = "SELECT * FROM suppliers";
	$res = exec_query($sql);
	while($row = mysqli_fetch_assoc($res)){
		$ids[] = $row["idsuppliers"];
	}
	return $ids;
}

function orders_existence($table_name="comp_ent"){
	$sql = "SELECT * FROM {$table_name}";
	$res = exec_query($sql);
	while($row = mysqli_fetch_assoc($res)){
		$ids[] = $row["id"];
	}
	return $ids;
}

function orders_existence_mx($table_name="pis_mx", $po_id){
	$sql = "SELECT * FROM {$table_name} WHERE id_comp_ent = {$po_id}";
	$res = exec_query($sql);
	$ids = [];
	while($row = mysqli_fetch_assoc($res)){
		$ids[] = $row["id_comp_ent"];
	}
	return $ids;
}
function validate_existence(){
	$sql = "SELECT * FROM comp_ent";
	$res = exec_query($sql);
	while($row = mysqli_fetch_assoc($res)){
		$ids[] = $row["id"];
	}
return $ids;
}
?>
