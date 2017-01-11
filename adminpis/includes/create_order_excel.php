<?php 
require_once("includes.php");
$sql = "select c.id, c.person_name, s.name, c.created_date from";
$sql .= " comp_ent c, suppliers s where c.id_supp = s.idsuppliers";
$sql .= " ORDER BY created_date DESC";
$res_set = exec_query($sql);
$output = "<table><tr><th>ID</th><th>Supplier</th><th>Responsable</th><th>Date Issued</th></tr><table>";
while($row = mysqli_fetch_assoc($res_set)){
	$po_id = $row["id"];
	$output .= "<tr><td>" . ($row["id"]) . "</td>";
	$output .= "<td>" . ucfirst($row["name"]) . "</td>";
	$output .= "<td>" . ucfirst($row["person_name"]) . "</td>";
	$output .= "<td>" . date("jS F, Y", strtotime(htmlentities($row["created_date"]))) . "</td>";	
}
$output .= "</table>";
?>

</table>
<?php 
	header("Content-Type:application/xls");
	header("Content-Disposition:attachment; filename=Orders.xls");
	echo $output;
 ?>