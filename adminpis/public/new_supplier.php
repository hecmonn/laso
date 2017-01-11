<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO
$title="New supplier";
require_once("../includes/header.php");
$sql_id="SELECT idsuppliers from suppliers order by idsuppliers desc";
$res_id = exec_query($sql_id);
$row = mysqli_fetch_assoc($res_id);
if(mysqli_num_rows($res_id)==0){
	$next_id =1;
}
else{
	$id= array_shift($row);
	$next_id = $id + 1;
}
?>
<div class="container">
<h3 align="center"><strong>FOREIGN SUPPLIER / IMPORT SERVICE PROVIDER- ADDITION OR UPDATE REQUEST</strong></h3><hr>
<?php echo session_message(); ?>
<form action="../includes/create_supplier.php" method="post" id="supp" name="supp_form">
	<div class="col-md-12">
		<h4><strong>A. Foreign Supplier / Import Service Provider - General Information</strong></h4>
		<hr>
	<div class="col-md-3">
		<h4 for="operation"><strong>1.</strong></h4>
		<input type="radio" name="operation" value="add"> Addition <br>
		<input type="radio" name="operation" value="upd">Update
	</div>
	<div class="col-md-3">
		<h4><strong>2. Supplier code</strong></h4>
		<input type="number" name="code" class="form-control" value="<?php echo $next_id ?>" disabled><br>
		<select name="type" form="supp" class="form-control">
			<option value=null>-</option>
			<option value="society">Society</option>
			<option value="organization">Organization</option>
			<option value="general information">General information</option>
			<option value="payment condition">Payment condition</option>
			<option value="society">Society</option>
			<option value="society">Society</option>
		</select>
	</div>
	<div class="col-md-3">
		<h4 for="soc"><strong>3. Society</strong></h4>
		<select name="soc" form="supp" class="form-control">
			<option value="110">-</option>
			<option value="110">110</option>
			<option value="140">140</option>
			<option value="150">150</option>
			<option value="170">170</option>
			<option value="180">180</option>
			<option value="190">190</option>
		</select>
		<h5 for="contact">Contact</h5>
		<input type="text" name="contact" class="form-control" id="contact">
		<div class="error-contact"></div>
	</div>
	<div class="col-md-3">
		<h4 for="org"><strong>4. Organization</strong></h4>
		<select name="org" form="supp" class="form-control">
			<option value="1000">1000</option>
			<option value="0004">0004</option>
			<option value="0005">0005</option>
			<option value="0006">0006</option>
		</select>
		<h5 for="email">Email</h5>
		<input type="email" name="email" class="form-control">
	</div>
</div>
<div class="col-md-12">
		<h4><strong>5. Supplier information</strong></h4>
	<div class="col-md-6">
		<h5 for="name">Supplier name</h4>
		<input type="text" name="name" class="form-control"><br>
		<script language='javascript' type='text/javascript'>
			function check(input) {
			    if (input.value = "") {
			        input.setCustomValidity('Name cannot be blank.');
			    } else {
			        // input is valid -- reset the error message
			        input.setCustomValidity('');
			   }
			}
		</script>
		<h5 for="address">Address</h5>
		<input type="text" name="address" class="form-control">
		<input type="text" name="address2" class="form-control">
	</div>
	<div class="col-md-6">
		<div class="col-md-12">
			<h5 for="city">City, country</h5>
			<input type="text" name="location" class="form-control">
		</div>
		<div class="col-md-6">
			<h5 for="fis_id">Fiscal ID</h5>
			<input type="number" name="fis_id" class="form-control" required>
		</div>
		<div class="col-md-6">
			<h5 for="zp">Z.P.</h5>
			<input type="text" name="zp" class="form-control" required>
		</div>

		<div class="col-md-5">
			<h5 for="phone">Phone</h5>
			<input type="number" name="phone" class="form-control" required>
		</div>
		<div class="col-md-2">
			<h5 for="ext">EXT.</h5>
			<input type="number" name="ext" class="form-control" required>
		</div>
		<div class="col-md-5">
			<h5 for="fax">Fax</h5>
			<input type="number" name="fax" class="form-control" required>
		</div>
	</div>
</div>
<div class="col-md-12"><br>
	<div class="col-md-3">
	<h4><strong>B. Payment condition</strong></h4><hr>
		<input type="radio" name="pay_con" value="wire transfer" checked>WIRE TRANSFER<br>
		<input type="radio" name="pay_con" value="letter of credit">LETTER OF CREDIT<br>
		<input type="radio" name="pay_con" value="international factoring">INTERNATIONAL FACTORING<br>
	</div>
	<div class="col-md-3">
	<h4><strong>B1. Expiration condition</strong></h4><hr>
		<input type="radio" name="exp_con" value="ship" checked>Shipment date<br>
		<input type="radio" name="exp_con" value="invoice">Invoice date<br>
	</div>
	<div class="col-md-6">
		<h4 for="curr"><strong>B3. Currency</strong></h4><hr>
		<select form="supp" name="curr" class="form-control">
			<option value="cad">CAD- Canadian Dollar</option>
			<option value="chf">CHF- Swiss Franc</option>
			<option value="eur">EUR- Euro</option>
			<option value="gbp">GBP- Pound</option>
			<option value="mxn">MXN- Mexican Peso</option>
			<option value="usd">USD- US Dollar</option>
			<option value="other_curr">Other</option>
		</select>
	</div>
</div>

<div class="col-md-12"><br>
	<h4><strong>B2. Expiration days</strong></h4><hr>
	<div class="col-md-4">
		<input type="radio" name="exp_day" value="0" checked>AT SIGHT <br>
		<input type="radio" name="exp_day" value="15">15 <br>
		<input type="radio" name="exp_day" value="30">30 
	</div>
	<div class="col-md-4">
		<input type="radio" name="exp_day" value="45">45 <br>
		<input type="radio" name="exp_day" value="60">60 <br>
		<input type="radio" name="exp_day" value="15">75 
	</div>
	<div class="col-md-4">
		<input type="radio" name="exp_day" value="15">90 <br>
		<input type="radio" name="exp_day" value="15">120 <br>
		<input type="radio" name="exp_day" value="15">180 
	</div>
</div>

<div class="col-md-12"><br>
	<h4><strong>C. Bank information</strong></h4><hr>
	<div class="col-md-4">
		<h5 for="ben">Beneficiary</h5>
		<input type="text" name="ben" class="form-control">
		<h5 for="bank">Correspondent bank</h5>
		<input type="text" name="bank" class="form-control">
		<h5 for="bank_acc">Bank account</h5>
		<input type="number" name="bank_acc" class="form-control">
		<h5 for="bank_code">Bank code</h5>
		<input type="number" name="bank_code" class="form-control">
	</div>
	<div class="col-md-4">
		<h5 for="aba">ABA</h5>
		<input type="text" name="aba" class="form-control">
		<h5 for="swift">Swift</h5>
		<input type="text" name="swift" class="form-control">
		<h5 for="clabe">Clabe</h5>
		<input type="text" name="clabe" class="form-control">
		<h5 for="bank_key">Bank key</h5>
		<input type="text" name="bank_key" class="form-control">
	</div>
	<div class="col-md-4">
		<h5 for="country">Country</h5>
		<input type="text" name="country" class="form-control">
		<h5 for="city">City</h5>
		<input type="text" name="city" class="form-control">
		<h5 for="branch">Branch</h5>
		<input type="text" name="branch" class="form-control">
		<h5 for="iban">Iban</h5>
		<input type="text" name="iban" class="form-control"><br>
	</div>
	<div class="col-md-4">
		<h4><strong>User</strong></h4><hr>
		<h5 for ="username">Username</h5>
		<input type="text" name="username" class="form-control" required><br>
		<h5 for ="password">Password</h5>
		<input type="password" name="password" id="password" class="form-control"><br>
		<input type="password" name="passwordconf" id="passwordconf" class="form-control" placeholder="Confrim password" oninput="check(this)" required><br>
		<script language='javascript' type='text/javascript'>
			function check(input) {
			    if (input.value != document.getElementById('password').value) {
			        input.setCustomValidity('Passwords does not match.');
			    } else {
			        // input is valid -- reset the error message
			        input.setCustomValidity('');
			   }
			}
		</script>
	</div>
</div>

<input type="submit" name="submit" value="Create" class="btn btn-lg btn-success pull-right">
</form>
</div>
<?php require_once("../includes/footer.php"); ?>