<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO
$title="Orders to Mexico";
require_once("../includes/header.php"); 
require_once("../includes/Pagination.php"); 
$page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1;
$per_page = 10;
$total_count = $User->count_rec();
$Pagination = new Pagination($page, $per_page, $total_count); ?>
<div class="container">
	<h2>Mange orders (Mexico)</h2>
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
				<input type="submit" name="submit" value="Go" class="btn btn-success"><br>
			</form>
		</div>
	</div>
	<table class = "table table-striped">
		<tr>
			<th>Order Number</th>
			<th>Ship month</th>
			<th>Supplier</th>
			<th>User</th>
			<th>Date Issued</th>
			<th>Options</th>
		</tr>
		<?php 
		$sql = "select c.id, m.ship_month, m.created_date, u.username, s.name from pis_mx m, ";
		$sql .= "comp_ent c, users u, suppliers s where s.idsuppliers = c.id_supp";
		$sql .= " and u.id = m.id_users and c.id = m.id_comp_ent and u.type = 1";
		$res = exec_query($sql);
		$output="";
		while($row = mysqli_fetch_assoc($res)){
			$po_id = $row["id"];
			$output.="<tr><td>".$row["id"]."</td>";
			$output.="<td>".$row["ship_month"]."</td>";
			$output.="<td>".$row["name"]."</td>";
			$output.="<td>".$row["username"]."</td>";
			$output.="<td>".$row["created_date"]."</td>";
			$output.="<td><a href=\"view_orders.php?po_id=$po_id\"> View</a>";
		}
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
<?php include_once("../includes/footer.php"); ?>