<?php  //AUTHOR:HECTOR MONARREZ ARAUJO
$title = "New Entry";
require_once("../includes/header.php"); 
?>
	<div class="container"> 
    	<h2>Proforma Invoice</h2> 
      <?php echo session_message(); ?><hr>
      <div class="form-group">
        <form action="../includes/create_entry.php" name="add_name" id="add_name" class="entry_form" enctype="multipart/form-data" method="post"> 
          <div class="row">
            <div class="col-md-4">
              <label>Person in charge: </label>
              <input type="text" name="person_name" class="form-control" autofocus required>
            </div>          
            <div class="col-md-6">
              <label for ="remarks">Remarks:</label>
              <textarea class="form-control" name="remarks" rows="4" id="remarks"></textarea>
            </div>
          </div><br>
            <div class="table-responsive">  
              <table class="form_ent table table-bordered" id="dynamic_field">
                <tr>
                 	<th>Style</th>
                  	<th>Composition</th>
                  	<th>Color</th>
                  	<th>MOQ</th>
                  	<th>Unit Price</th>
                   <th>Image</th>
                  </tr>  
                  <tr>  
                     <td><input type="text" name="style[]" placeholder="Style" class="form-control style_list" required /></td>
                     <td><input type="text" name="composition[]" placeholder="Composition" class="form-control comp_list" /></td>
                     <td><input type="text" name="color[]" placeholder="Color" class="form-control color_list" /></td>
                     <td><input type="number" name="moq[]" placeholder="MOQ" class="form-control qty_list" min="1" step="1"  required/></td>
                     <td><input type="number" name="fob_sh[]" placeholder="Unit Price" class="form-control fob_sh_list" min=".01" step=".01" required/></td>
                     <input type="hidden" name="MAX_SIZE_VALUE" value="5000000">
                     <td><input id="img" type="file" name="img[]" class="upload"  required/></td>
                     <td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>  
                  </tr>  
                  </table>  <br><br>
                  <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-1">Submit</button>
                     <div class="modal fade" id="modal-1">
                       <div class="modal-dialog">
                         <div class="modal-content">
                           <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h3 class="modal-title">Terms and agreements</h3>
                           </div>
                           <div class="modal-body">
                             <h4>By clicking Accept you agree to the <a href="../includes/show_pdf.php" target="_blank">terms and conditions</a></h4>
                                </div>
                                <div class="modal-footer">
                                  <a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                                  <input type="submit" name="submit" value="Accept" class="btn btn-primary">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>  
               </form>  
    		</div>  
    </div>  
<?php require_once("../includes/footer.php"); ?>
<script src="../public/javascripts/dynamic_rows.js"></script>