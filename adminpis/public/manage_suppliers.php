<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO
$title = "Suppliers";
require_once("../includes/header.php");
require_once("../includes/Pagination.php");
$page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1;
$per_page = 10;
$total_count = $User->count_supp();
$Pagination = new Pagination($page, $per_page, $total_count);
?>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h2>Manage Suppliers</h2><br>
		</div>
		<div class="col-md-6 pull-right">
			<a href="new_supplier.php" class="btn btn-lg btn-warning pull-right">Add Supplier</a>
		</div>
	</div>
		<?php echo session_message(); ?><br>
	<table class="table table-striped">
		<tr>
			<th>Company name</th>
			<th>Contact</th>
			<th>Email</th>
			<th>Options</th>
		</tr>
			<?php 
				$sql = "SELECT * FROM suppliers s, users u WHERE s.idsuppliers = u.id_supp";
				$res = exec_query($sql);
				while($row = mysqli_fetch_assoc($res)){
					$id_supp = $row["idsuppliers"];
					$output = "<td>" . htmlentities($row["name"]) . "</td>";
					$output .= "<td>" . htmlentities($row["contact"]) . "</td>";
					$output .= "<td>" . htmlentities($row["email"]) . "</td>";
					$output .= "<td><a href=\"view_supplier.php?id_supp=$id_supp\"> View</td></tr>";
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
<?php include_once("../includes/footer.php"); ?>