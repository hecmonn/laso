<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO
$title = "Edit Order";
require_once("../includes/header.php");
require_once("../includes/PHPMailer/class.phpmailer.php");
$po_id = $_GET["po_id"];
$sql = "SELECT * FROM comp_ent WHERE id=".$po_id;
$res = exec_query($sql);
while($row = mysqli_fetch_assoc($res)){
	$supp= $row["id_supp"];
	$person_charge = $row["person_name"];
	$date= date("jS F, Y", strtotime($row["created_date"]));
	$rem = $row["remarks"];
	$tot_gen = $row["tot_gen"];
}
$sql_pis_mx = "SELECT * FROM pis_mx WHERE id_comp_ent = {$po_id}";
$res_pis_mx = exec_query($sql_pis_mx);
$brand_sh = "Not set";
$ship_month_sh = "Not set";
while ($row = mysqli_fetch_assoc($res_pis_mx)) {
	//$brand_sh = !empty($row["brand"]) ? $row["brand"] : "Not set";
	//$ship_month_sh = !empty($row["ship_month"]) ? $row["ship_month"] : "Not set";
	$brand_sh = $row["brand"];
	$ship_month_sh = $row["ship_month"];
}

if(isset($_POST["submit"])){
	$ids = orders_existence_mx("pis_mx", $po_id);
	$user_admin = $User->user_id;
	$brand = mysql_prep($_POST["brand"]);
	$ship_month = mysql_prep($_POST["month"]);
	$count = count($_POST["id"]);
	$tot_gen_up =0;
	for($i=0; $i<$count; $i++){
		$id = $_POST["id"][$i];
		$moq = !empty($_POST["moq"][$i]) ? mysql_prep($_POST["moq"][$i]) : null;
		$fob = mysql_prep($_POST["fob_sh"][$i]);
		$price = $moq * $fob;
		$tot_gen_up = $tot_gen_up + $price;
		$liv_id = isset($_POST["liv_ref"][$i]) ? mysql_prep($_POST["liv_ref"][$i]) : "some";
		$sql_pi = "UPDATE pi_entries SET moq = {$moq}, fob_sh = {$fob}, liverpool_ref = '{$liv_id}' WHERE id = {$id} ";	
		$res_pi = exec_query($sql_pi);
		if(!$sql_pi){
			$_SESSION["message"] = "Entry data again.";
			redirect_to("edit_oders.php?po_id=$".$po_id);
		}
	}
	if(in_array($po_id, $ids)){
		$sql_mx = "UPDATE pis_mx SET brand = '{$brand}', ship_month = '{$ship_month}'";
		$sql_mx .= ", id_users = {$user_admin} WHERE id_comp_ent = {$po_id}";
	}
	else{
		$sql_mx = "INSERT INTO pis_mx (brand, ship_month, ";
		$sql_mx .= "id_users, id_comp_ent) VALUES ('{$brand}'";
		$sql_mx .= ", '{$ship_month}', '{$user_admin}', '{$po_id}')";
	}
	$sql_upd_tg = "UPDATE comp_ent SET tot_gen = {$tot_gen_up} WHERE id = {$po_id}";
	exec_query("begin;");
	$res_mx = exec_query($sql_mx);
	$res_upd_tg = exec_query($sql_upd_tg);
	if($res_mx && $res_upd_tg){
		exec_query("commit;");
		$_SESSION["message"]= "Order #" .$po_id." succesfully updated.";
		redirect_to("index.php");
	}
	else {
		exec_query("rollback;");
		$_SESSION["message"] = "Data not updated, please try again.";
		redirect_to("edit_orders.php?po_id=".$po_id);
	}
}

if(isset($_POST["submit_email"])){
	$id_comp = $po_id;
	
	//SMTP Mail sender
	$mail = new PHPMailer(); // defaults to using php "mail()"
	$mail->IsSendmail(); // telling the class to use SendMail transport
	//$mail->AddReplyTo("name@yourdomain.com","First Last");
	$mail->SetFrom('notifications@lasovp.com', 'LASO Notifications');
	$mail->IsHTML(true);
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Host       = "mail.lasovp.com"; // sets the SMTP server
	$mail->Port       = 26;                    // set the SMTP port for the GMAIL server
	$mail->Username   = "notifications@lasovp.com"; // SMTP account username
	$mail->Password   = "qRxZVnw9,+l{B&l";
	//$mail->AddReplyTo("name@yourdomain.com","First Last");
	$address = $_POST["to_email"]; 
	$mail->AddAddress($address);
	$mail->Subject = isset($_POST["subject_email"]) ? $_POST["subject_email"] : "New Product Invoice"; 
	$mail->AltBody = "You have a new notification! " . $message_user; // optional, comment out and test
	$message_user = isset($_POST["message_email"]) ? $_POST["message_email"] : "";


	$message = "
	<html>
	<head>
		<title>LASO | Notification</title>
		<style>
			.cont h1{
				text-align:center;
				font-family: Arial;
			}
			.cont p{
				text-align:center;
				font-family: Arial;
				font-size: 21px;
			}
		</style>
	</head>
	<body>
		<img src=\"images/logo.png\" widht=\"40\" height=\"80\"> 
		<div class=\"cont\">
			<h1>You have a new notification!</h1>
			<p>{$message_user}</p>
		</div>
	</body>
	</html>
		";
	$mail->MsgHTML($message);
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	if(!$mail->Send()) {
		$_SESSION["message"] = "Email was not send. " . $mail->ErrorInfo;
		redirect_to("edit_orders.php?po_id=$po_id");
	} else {
		$_SESSION["message"] = "Email sent.";
		redirect_to("manage_orders.php");
	}
	
}
?>
<div class="container">
			<?php echo session_message(); ?>
	<div class="row">
		<div class="col-md-6">
			<h4><strong><?php echo "PO Number: </strong>#". $po_id; ?></h4>
			<h4><strong><?php echo "Person in charge: </strong>" . htmlentities($person_charge); ?></h3>
			<h4><strong><?php echo "Date Issued: </strong>" . htmlentities($date); ?></h3>
			<h4><strong><?php echo "Brand: </strong>" . htmlentities($brand_sh); ?></h3>
			<h4><strong><?php echo "Ship month: </strong>" . htmlentities($ship_month_sh); ?></h3><br>
		</div><div class="col-md-6">
	<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-1">Email order</button>
	<div class="modal fade" id="modal-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Send email</h3>
				</div>
				<div class="modal-body">
					<form action="edit_orders.php?po_id= <?php echo $po_id ?>" method="post">
						<input type="email" name="to_email" placeholder="To" class="form-control" required><br>
						<input type="text" name="subject_email" placeholder="Subject" class="form-control"><br>
						<textarea col=4 rows=3 name="message_email" placeholder="Message" class="form-control"></textarea><br>
					
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
					<input type="submit" name="submit_email" value="Send" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
		<div class="col-md-3">
		<form name="edit" action ="edit_orders.php?po_id= <?php echo $po_id ?>" method="post">
			<label for="brand">Brand</label>
			<select name="brand" class="form-control">
				<option>Pique Nique</option>
				<option>Mon Caramel</option>
				<option>That's It</option>
			</select>
		<label for="month">Ship month</label>
		<select name="month" class="form-control">
			<option>January</option>
			<option>February</option>
			<option>March</option>
			<option>April</option>
			<option>May</option>
			<option>June</option>
			<option>July</option>
			<option>August</option>
			<option>September</option>
			<option>October</option>
			<option>November</option>
			<option>December</option>
		</select><br>
		</div>
		
	
	</div>
		<table class="table table-striped">
			<tr>
				<th>Photo</th>
				<th>Style</th>
				<th>Liverpool style</th>
				<th>Composition</th>
				<th>Color</th>
				<th>MOQ</th>
				<th>Unit Price</th>
			</tr>
			<?php
			$table ="";
			$sql =  "SELECT * FROM pi_entries WHERE id_comp_ent=".$po_id;
			$res_set = exec_query($sql);
			while($row = mysqli_fetch_assoc($res_set)){
				//add image not found
				$id_pi = $row["id"];
				$output = "<tr><input type=\"hidden\" name=\"id[]\" value=\"".$row["id"]."\">";
				$output .= "<td><img src=\"../../uploads/" . $row["photo_path"]."\" width=\"100\" height=\"100\"></td>";
				$output .= "<td><input type=\"text\" name = style[] class=\"form-control style_list\" value=\"".htmlentities($row["style"])."\" disabled></td>";
				$output .= "<td><input type=\"text\" name=liv_ref[] value=\"".htmlentities($row["liverpool_ref"])."\" class=\"form-control syle_list\" required></td>";
				$output .= "<td><input type=\"text\" class=\"form-control comp_list\" value=\"".htmlentities($row["composition"])."\" disabled></td>";
				$output .= "<td><input type=\"text\" class=\"form-control style_list\" value=\"".htmlentities($row["color"])."\" disabled></td>";
				$output .= "<td><input type=\"number\" name = moq[] class=\"form-control style_list\" value=\"".htmlentities($row["moq"])."\" min=\"1\" required></td>";
				$output .= "<td><input type=\"number\" name = fob_sh[] class=\"form-control style_list\" value=\"". htmlentities(sprintf('%01.2f',$row["fob_sh"]))."\" min=\".01\" step=\".01\" required></td></tr>";
				$table .= $output;
				}
			echo $table;
			?>
		</table>
		<input type="submit" for="edit" name="submit" value="Edit" class="btn btn-info pull-right">
	</form>
	<a href="manage_orders.php">
		<button class="btn btn-danger pull-right bttn-edit" style="margin-right:10px;">Cancel</button>
	</a>
	
</div>
<?php require_once("../includes/footer.php"); ?>