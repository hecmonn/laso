<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO 
require_once("../includes/sessions.php"); 
require_once("../includes/Database.php"); 
require_once("../includes/includes.php"); 
require_once("../includes/Photograph.php"); 
require_once("../includes/User.php"); 
if(isset($_POST['submit'])){
	 $beg = exec_query("begin;");
	 $ini = $User->supplier_name();
	 $person = empty($_POST["person_name"]) ? null : mysql_prep($_POST["person_name"]);
	 $remarks = empty($_POST["remarks"]) ? null : mysql_prep($_POST["remarks"]);
	 $sql = "INSERT INTO comp_ent(person_name, remarks, id_supp) VALUES ('". $person ."',";
	 $sql .= "'". $remarks ."', '". $User->supp_id ."')";
	 $res_comp_ent = exec_query($sql);
     $id_comp_ent = mysqli_insert_id($Database->con);
     $tot_gen = 0;
	 $cont = count($_POST['style']);  
	if($cont > 0){
	    for($i=0; $i<$cont; $i++) {
			$style = empty($_POST["style"][$i]) ? null : mysql_prep($_POST["style"][$i]);
			$composition = empty($_POST["composition"][$i]) ? null : mysql_prep($_POST["composition"][$i]);
			$color = empty($_POST["color"][$i]) ?  null :mysql_prep($_POST["color"][$i]);
			$qty = empty($_POST["moq"][$i]) ? 0 : mysql_prep($_POST["moq"][$i]);
			$fob_sh = empty($_POST["fob_sh"][$i]) ? 0: mysql_prep($_POST["fob_sh"][$i]);
			$tot_prod = $qty * $fob_sh;
	        $tot_gen = $tot_gen + $tot_prod;
	        $cont = count($_FILES['img']['name']);
	        $file = $_FILES['img'];

	        $attached_file = $Photo->attach_file($file, $i);
		       if($attached_file){
		       	$date = strftime('%y%m%d', time());
		      	$photo_name = $style.$date;
				$photo_uploaded = $Photo->save_file($User->supp_id,$photo_name);
				$image_id = $User->supp_id . '/' . $photo_uploaded;
			    $sql_ins = "INSERT INTO pi_entries(style,composition, ";
			   	$sql_ins .= "color,moq,fob_sh, id_comp_ent,photo_path)";
			    $sql_ins .= " VALUES('". $style ."', '". $composition ."', ";
			    $sql_ins .= "'". $color ."', '". $qty ."', '". $fob_sh ."','";
			    $sql_ins .= $id_comp_ent ."','". $image_id ."')"; 
			    $res_pis  = exec_query($sql_ins); 
	        }
				else {
					exec_query("rollback;");
				}
			}

	     $sql = "UPDATE comp_ent SET tot_gen = '". $tot_gen."' WHERE id = '".$id_comp_ent."'";
	     $res_upd = exec_query($sql);

	    if ($res_comp_ent && $res_pis && $res_upd) {
	    	$comm = exec_query("commit;");
			$_SESSION["message"] = "Succesfully updated." ;
			redirect_to("../public/index.php");
		}//cierre if $result
		else {
			$roll = exec_query("rollback;");
			$_SESSION["message"] = "Please entry data again.";
			redirect_to("../public/new_entry.php"); 
		} //cierre else $result
	}//cierre if cont  
}
?>  

<?php if(isset($con)) { mysqli_close($con); } ?>