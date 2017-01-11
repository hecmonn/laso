<?php
require_once("includes.php");
require_once("Database.php");
//validate existence
$username = mysql_prep($_POST["username"]);
$ids = validate_existence_user();
if(in_array($username, $ids)){
	$_SESSION["message"]="Username already exists. Please choose another one.";
	redirect_to("../public/new_supplier.php");
}
//1. operation addition/update
$soc = mysql_prep($_POST["soc"]);
$org = mysql_prep($_POST["org"]);
$name = mysql_prep($_POST["name"]);
$address1 = mysql_prep($_POST["address"]);
$address2 = mysql_prep($_POST["address2"]);
$address = $address1 . " " . $address2;
$location = mysql_prep($_POST["location"]);
$fis_id = mysql_prep($_POST["fis_id"]);
$zp = mysql_prep($_POST["zp"]);
$phone = mysql_prep($_POST["phone"]);
$ext = mysql_prep($_POST["ext"]);
$fax = mysql_prep($_POST["fax"]);
$pay_con = mysql_prep($_POST["pay_con"]);
$exp_con = mysql_prep($_POST["exp_con"]);
$curr = mysql_prep($_POST["curr"]);
$exp_day = mysql_prep($_POST["exp_day"]);
$ben = mysql_prep($_POST["ben"]);
$bank = mysql_prep($_POST["bank"]);
$bank_acc = mysql_prep($_POST["bank_acc"]);
$bank_code = mysql_prep($_POST["bank_code"]);
$swift = mysql_prep($_POST["swift"]);
$aba = mysql_prep($_POST["aba"]);
$clabe = mysql_prep($_POST["clabe"]);
$bank_key = mysql_prep($_POST["bank_key"]);
$country = mysql_prep($_POST["country"]);
$city = mysql_prep($_POST["city"]);
$branch = mysql_prep($_POST["branch"]);
$iban = mysql_prep($_POST["iban"]);
$email = mysql_prep($_POST["email"]);
$contact =mysql_prep($_POST["contact"]);
$password = mysql_prep($_POST["password"]);

$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
//type 2 suppliers as users
exec_query("begin;");
$sql_user ="INSERT INTO users(username, password,type) VALUES ('{$username}','{$hashed_pass}','2')";
$res_us = exec_query($sql_user);
$id_user = mysqli_insert_id($Database->con);
$sql_supp = "INSERT INTO suppliers(society, organization, name, address, email, contact, telephone, ext, fax,";
$sql_supp .="fiscal_id, zp, id_user) VALUES ('{$soc}','{$org}','{$name}','{$address}','{$email}',";
$sql_supp .= "'{$contact}', '{$phone}','{$ext}','{$fax}','{$fis_id}','{$zp}', '{$id_user}')";
$res_supp = exec_query($sql_supp);

$id_supp = mysqli_insert_id($Database->con);

$sql_pays="INSERT INTO pays(pay_cond, expiration_conditions, currency, exp_days, beneficiary,";
$sql_pays .="aba, bank_name, bank_account, bank_code, swift, clabe, bank_key, bank_city, bank_country,";
$sql_pays .="branch, iban, id_suppliers) VALUES ('{$pay_con}','{$exp_con}','{$curr}','{$exp_day}',";
$sql_pays .="'{$ben}','{$aba}','{$bank}','{$bank_acc}','{$bank_code}','{$swift}','{$clabe}',";
$sql_pays .="'{$bank_key}','{$city}', '{$country}','{$branch}','{$iban}', '{$id_supp}')";
$res_pays = exec_query($sql_pays);
$id_pays = mysqli_insert_id($Database->con);

$sql_update_users ="UPDATE users SET id_supp='{$id_supp}' where id ='{$id_user}'";
$res_update = exec_query($sql_update_users);
$sql_update_idpays = "UPDATE suppliers SET id_pays = {$id_pays} WHERE idsuppliers = {$id_supp}";
$res_update_idpays = exec_query($sql_update_idpays);
if($res_supp && $res_pays && $res_us && $res_update  && $res_update_idpays){
	exec_query("commit;");
	$_SESSION["message"] = "Supplier added succesfully.";
	redirect_to("../public/manage_suppliers.php");
}
else{
	exec_query("rollback;");
	$_SESSION["message"] ="Please add supplier again.";
	redirect_to("../public/new_supplier.php");
}
?>