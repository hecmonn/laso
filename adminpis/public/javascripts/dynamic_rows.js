$(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="style[]" placeholder="Style" class="form-control style_list" required/></td><td><input type="text" name="composition[]" placeholder="Composition" class="form-control comp_list" /></td><td><input type="text" name="color[]" placeholder="Color" class="form-control color_list" /></td><td><input type="number" name="moq[]" placeholder="MOQ" class="form-control qty_list" min="1" step="1" required/></td><td><input type="number" name="fob_sh[]" placeholder="Unit Price" class="form-control fob_sh_list" min=".01" step=".01" required/></td><input type="hidden" name="MAX_SIZE_VALUE" value="3000000"><td><input type="file" name="img[]" class=" btn-sm img" required/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });    
});  