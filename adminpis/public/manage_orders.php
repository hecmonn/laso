<?php //AUTHOR:HECTOR MONARREZ ARAUJO
$title="Manage Orders"; 
require_once("../includes/header.php"); 
require_once("../includes/Pagination.php"); 
$page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1;
$per_page = 10;
$total_count = $User->count_rec();
$Pagination = new Pagination($page, $per_page, $total_count);
$sql = "select c.id, c.person_name, s.name, c.created_date from";
$sql .= " comp_ent c, suppliers s where c.id_supp = s.idsuppliers";
$sql .= " ORDER BY created_date DESC";
$sql .= " LIMIT " . $Pagination->per_page . " OFFSET " . $Pagination->offset();
$res_set = exec_query($sql);
$output="";
while($row = mysqli_fetch_assoc($res_set)){
	$po_id = $row["id"];
	$output .= "<tr><td>" . htmlentities($row["id"]) . "</td>";
	$output .= "<td>" . ucfirst(htmlentities($row["name"])) . "</td>";
	$output .= "<td>" . ucfirst(htmlentities($row["person_name"])) . "</td>";
	$output .= "<td>" . date("jS F, Y", strtotime(htmlentities($row["created_date"]))) . "</td>";
	$output .= "<div class =\"views\"><td><a href=\"view_orders.php?po_id=$po_id\">View </a>";
	$output .= "<a href=\"edit_orders.php?po_id=$po_id\">Edit</a></td></div></tr>";			
}

?>

<div class="container">
	<h2>Manage Orders</h2>
	<?php echo session_message(); ?>
	<div class="dropdown pull-right">
  				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filters
  				<span class="caret"></span></button>
  				<ul class="dropdown-menu">
  					<li><a href="manage_orders.php">All orders</a></li>
  					<li><a href="manage_orders_mx.php">Orders to Mexico</a></li>
  					<li><a href="orders_by_status.php">Orders by status</a></li>
  					<li><a href="date_orders.php">Orders by date</a></li>
  					<li><a href="manage_orders_supplier.php">Orders by supplier</a></li>
  				</ul>
  			</div><br><hr>
	<a href="../includes/create_order_excel.php" class="btn btn-default pull-right">Export Excel </a>
	<div class="row">
		<div class="col-md-3">
			<form action="date_orders.php" name="date" method="get">
				<label for="start">From:</label>
				<input type="date" name="start" class="form-control">
			</div>
			<div class="col-md-3">
				<label for="finish">To: </label>
				<input type="date" name="finish" class="form-control">
			</div>
			<div class="col-md-3"><br>
				<input type="submit" name="submit" value="Go" class="btn btn-success">
			</form>
		</div>
	</div>
			<br>
		<table class = "table table-striped">
			<tr>
				<th>Order Number</th>
				<th>Supplier</th>
				<th>Responsable</th>
				<th>Date Issued</th>
				<th>Options</th>
			</tr>
			<?php 
				echo $output;
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