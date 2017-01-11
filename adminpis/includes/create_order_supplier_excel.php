<?php
require_once("includes.php");
$supp = $_GET["supp"];
$sql = "select c.id, c.person_name, s.name, c.created_date from";
$sql .= " comp_ent c, suppliers s where c.id_supp = s.idsuppliers AND s.name= '{$supp}'";
$sql .= " ORDER BY created_date DESC";
$res_set = exec_query($sql);
$output="<table>
			<tr>
				<th>Order Number</th>
				<th>Supplier</th>
				<th>Responsable</th>
				<th>Date Issued</th>
			</tr>";
	while($row = mysqli_fetch_assoc($res_set)){
		$output .= "<tr><td>" . htmlentities($row["id"]) . "</td>";
		$output .= "<td>" . ucfirst(htmlentities($row["name"])) . "</td>";
		$output .= "<td>" . ucfirst(htmlentities($row["person_name"])) . "</td>";
		$output .= "<td>" . date("jS F, Y", strtotime(htmlentities($row["created_date"]))) . "</td>";	
	}

	echo $output;
	header('Content-Type:application/vnd.ms-excel');
	header('Content-Disposition:attachment; filename="Orders-by-supplier.xls"');
?>