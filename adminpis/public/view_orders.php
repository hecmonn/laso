<?php //AUTHOR: HECTOR E. MONARREZ A.
$title="View Order"; 
require_once("../includes/header.php"); 
require_once("../includes/Photograph.php");
$po_id =$_GET["po_id"];
$ids = orders_existence();
if(!in_array($po_id, $ids)){
	redirect_to("error.php");
}
$res_acc="";
$accept_pis= [];
$sql = "SELECT * FROM comp_ent WHERE id = " . $po_id;
$res = exec_query($sql);
	while($row = mysqli_fetch_assoc($res)){
		$person_charge = $row["person_name"];
		$date=  $row["created_date"] ;
		$rem = $row["remarks"];
		$tot_gen = $row["tot_gen"];
		$id_supp = $row["id_supp"];
	}
$sql_supp = "SELECT * FROM suppliers WHERE idsuppliers = {$id_supp}";
$res_supp = exec_query($sql_supp);
while($row_supp = mysqli_fetch_assoc($res_supp)){
	$name = $row_supp["name"];
	$address = $row_supp["address"];
	$telephone = $row_supp["telephone"];
	$email = $row_supp["email"];
	$contact = $row_supp["contact"];
}
$sql_pays="SELECT * FROM pays WHERE id_suppliers={$id_supp}";
$res_pays=exec_query($sql_pays);
while ($row=mysqli_fetch_assoc($res_pays)) {
	$pay_cond=htmlentities(ucfirst($row["pay_cond"]));
	$expiration_conditions=htmlentities(ucfirst($row["expiration_conditions"]));
	$exp_days=htmlentities($row["exp_days"]);
}
if(isset($_POST["submit"])){
	exec_query("begin;");
	$sql = "INSERT INTO pi_accepted(idcomp_ent) VALUES (". $po_id . ")";
	$res_acc = exec_query($sql);
	if($res_acc) {
		exec_query("commit;");
		$_SESSION["message"] = "Succesfully accepted order # ".$po_id;
		redirect_to("manage_orders.php");
	}
}
if(isset($_POST["submit_dec"])){
	exec_query("begin;");
	$sql_dec = "INSERT INTO pi_declined(idcomp_ent) VALUES (". $po_id . ")";
	$res_dec = exec_query($sql_dec);
	if($res_dec) {
		exec_query("commit;");
		$_SESSION["message"] = "Succesfully declined order # ".$po_id;
		redirect_to("manage_orders.php");
	}
}
?>
<div class="container">
	<div class="title">
		<h1>Order Details</h1>
		<div class="row">
			<div class="col-md-6">
				<a href="manage_orders.php">&laquo;Back</a>
			</div>
			<div class="dropdown pull-right">
    			<button class="btn btn-primary dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Configuration
    				<span class="caret"></span></button>
    				<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
    				<li role="presentation">
						<a role="menuitem" tabindex="-1" href="../includes/create_order_pdf.php?id_supp=<?php echo $id_supp."&"; ?>po_id=<?php echo $po_id?>" target="_blank">Export PDF <span class="glyphicon" style="0"></span></a>
					</li>
					<li role="presentation" class="divider"></li>
						<form action"view_orders.php?po_id<?php echo $po_id?>" method="post">
				<?php 
				$accept_pis = $User->order_status("pi_accepted");
				$declined_pis=$User->order_status("pi_declined");
				if(!in_array($po_id, $accept_pis)&&!in_array($po_id, $declined_pis)){ ?>
      				<li role="presentation">
      					<a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#modal-1">Accept</a>
      				</li>
      			<?php }
      			if (!in_array($po_id, $declined_pis)) { ?>
      				<li>
      					<a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#modal-2">Decline <span class="remove" aria-hidden="true"></span></a>
      				</li>
      			<?php } ?>
      				</ul>
			</div> <!-- cierre dropdown-->
			<?php
      			if(in_array($po_id, $accept_pis)){
      				$status = "<br><input type=\"submit\" value=\"Accepted\" class=\"btn btn-lg btn-success\" disabled>";
      			}
      			if(in_array($po_id, $declined_pis)){
      				$status = "<br><input type=\"submit\" value=\"Declined\" class=\"btn btn-lg btn-danger\" disabled>";
      			}
      			if(!in_array($po_id, $declined_pis)&&!in_array($po_id, $accept_pis)){
      				$status = "<br><input type=\"submit\" value=\"Pending\" class=\"btn btn-lg btn-default\" disabled>";
      			}
      			echo $status;
      			?>
			<!-- starts modal -->
			<div class="modal fade" id="modal-1">	
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3 class="modal-title">Order confirmation</h3>
						</div>
						<div class="modal-body">
							<h4>Are you sure you want to accept this order?</a></h4>
						</div>
						<div class="modal-footer">
							<a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
								<input type="submit" name="submit" value="Confirm" class="btn btn-info">
						</div>
					</div>
				</div>
			</div><!-- ends modal -->
			<!-- starts modal -->
			<div class="modal fade" id="modal-2">	
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3 class="modal-title">Order confirmation</h3>
						</div>
						<div class="modal-body">
							<h4>Are you sure you want to decline this order?</a></h4>
						</div>
						<div class="modal-footer">
							<a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
								<input type="submit" name="submit_dec" value="Confirm" class="btn btn-info">
								</form>
						</div>
					</div>
				</div>
			</div><!-- ends modal -->
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<h4><strong><?php echo "PO Number: </strong>#". $po_id; ?></h4>
			<h4><strong><?php echo "Person in charge: </strong>" . htmlentities(ucfirst($person_charge)); ?></h3>
			<h4><strong><?php echo "Date Issued: </strong>" . htmlentities(date("jS F, Y H:i", strtotime($date))); ?></h3><br>
		</div>
		<div class="col-md-6">
			<h4><strong><?php echo "Company name: </strong>". htmlentities(ucfirst($name)); ?></h4>
			<h4><strong><?php echo "Address: </strong>". htmlentities(ucfirst($address)); ?></h4>
			<h4><strong><?php echo "Cellphone: </strong>". htmlentities($telephone); ?></h4>
			<h4><strong><?php echo "Email: </strong>".  htmlentities($email); ?></h4>
		</div>
	</div>
	<table class = "table table-striped">
		<tr>
			<th>Photo</th>
			<th>Style</th>
			<th>Composition</th>
			<th>Color</th>
			<th>MOQ</th>
			<th>FOB</th>
		</tr>
		<?php
			$table_detail = $User->show_order_detail($po_id);
			echo $table_detail;
		?>
	</table>
	<div class="col-md-6">
		<div class="remarks"><h4><strong><?php echo "Remarks: </strong><br>". $rem; ?></h4></div>
	</div>
	<div class="col-md-6">
		<h4><strong><?php echo "Grand Total: </strong><br>". "$" . number_format($tot_gen,2,'.',',') . " USD" ; ?></h4>
	</div>
	<div class="col-md-6"><hr>
		<h3>Conditions</h3>
		<h4><strong><?php echo "Payment conditions: </strong>". $pay_cond; ?></h4>
		<h4><strong><?php echo "Expiration conditions: </strong>" . $expiration_conditions; ?></h3>
		<h4><strong><?php echo "Expiration days</strong>: " . $exp_days; ?></h3><br>
	</div>
</div>
<?php include_once("../includes/footer.php"); ?>