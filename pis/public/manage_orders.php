<?php //AUTHOR:HECTOR MONARREZ ARAUJO
$title="Manage Orders"; 
require_once("../includes/header.php"); 
 require_once("../includes/Pagination.php"); 
$ini = $User->supplier_name();
$page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1;
$per_page = 10;
$total_count = $User->count_rec();
$Pagination = new Pagination($page, $per_page, $total_count);

?>

<div class="container">
	<h1>Manage Orders</h1><hr>
		<table class = "table table-striped">
			<tr>
				<th>Order Number</th>
				<th>Responsable</th>
				<th>Date Issued</th>
				<th>Options</th>
			</tr>
			<?php 
				$sql = "SELECT * FROM comp_ent WHERE id_supp = " . $User->supp_id;
				$sql .=" ORDER BY created_date DESC";
				$sql .= " LIMIT " . $Pagination->per_page . " OFFSET " . $Pagination->offset();
				$res_set = exec_query($sql);
				while($row = mysqli_fetch_assoc($res_set)){
					$po_id = $row["id"];
					//$output = mysqli_num_rows($res_set);
					$output = "<tr><td>" . htmlentities($row["id"]) . "</td>";
					$output .= "<td>" . htmlentities(ucfirst($row["person_name"])) . "</td>";
					$output .= "<td>" . htmlentities($row["created_date"]) . "</td>";
					$output .= "<div class =\"views\"><td><a href=\"view_orders.php?po_id=$po_id\">View </a>";
					echo $output;
				}
			?>
		</table>
			<div class="pagination pull-right">
				<?php
					if($Pagination->total_pages() > 1){
						if($Pagination->has_prev_page()){
							echo "<a href=\"manage_orders.php?page=";
							echo $Pagination->prev_page();
							echo "\">&laquo; Previous</a>";
						}
						for ($i=1; $i <= $Pagination->total_pages(); $i++){
							if($i==$page){
								echo "<span class=\"selected\">{$i}</span>";
							}
							else{
								echo "<a href=\"manage_orders.php?page={$i}\"> {$i} </a>";
							}
						}
						if($Pagination->has_next_page()){
							echo "<a href=\"manage_orders.php?page=";
							echo $Pagination->next_page();
							echo "\">Next &raquo; </a>";
						}
					}
				?>
			</div>
		</div>	
<?php require_once("../includes/footer.php"); ?>