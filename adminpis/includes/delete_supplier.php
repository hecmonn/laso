<?php 
require_once("includes.php");
$id_supp = $_GET["id_supp"];
exec_query("begin;");
$sql = "DELETE FROM users where id= {$id_supp}";
$res_us = exec_query($sql);
$sql_supp = "DELETE FROM suppliers where idsuppliers = {$id_supp}";
$res_supp = exec_query($sql_supp);
if($res_us && $res_supp){
	exec_query("commit;");
	$_SESSION["message"] = "Supplier #{$id_supp} deleted succesfully.";
	redirect_to("../public/manage_suppliers.php");
}
else{
	exec_query("rollback;");
	$_SESSION["Please try again."];
	$redirect_to("view_supplier.php?id_supp=".$id_supp);
}
?>