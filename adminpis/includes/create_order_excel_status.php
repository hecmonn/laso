<?php
require_once("includes.php");
$status = $_GET["s"];
$sql="SELECT s.name,c.id,c.person_name,p.created_date FROM comp_ent c, {$status} p, suppliers s WHERE c.id=p.idcomp_ent AND s.idsuppliers=c.id_supp";
$sql .= " ORDER BY created_date DESC";
$res_set = exec_query($sql);
$output="<table>
			<tr>
				<th>Order Number</th>
				<th>Supplier</th>
				<th>Responsable</th>
				<th>Date</th>
			</tr>";
	while($row = mysqli_fetch_assoc($res_set)){
		$po_id = $row["id"];
		$name =ucfirst($row["name"]);
		$date = date("jS F, Y", strtotime(htmlentities($row["created_date"])));
		$person = ucfirst($row["person_name"]);
		$output .= "<tr><td>".$row["id"]."</td>";
		$output .= "<td>".$name."</td>";
		$output .= "<td>" .$person. "</td>";
		$output .= "<td>".$date."</td>";
	}
	echo $output;
	header('Content-Type:application/vnd.ms-excel');
	header('Content-Disposition:attachment; filename="Orders-by-date.xls"');
?>