<?php
require_once("includes.php");
$from_date = $_GET["from_date"]; 
$to_date = $_GET["to_date"];
$sql = "select c.id, c.person_name, s.name, c.created_date from";
$sql .= " comp_ent c, suppliers s where c.id_supp = s.idsuppliers AND c.created_date between '{$from_date}' and '{$to_date}'";
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