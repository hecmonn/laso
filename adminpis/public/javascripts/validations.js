document.form_supp.contact.onblur = function(){
	var cont = document.myform.field1.value;
	if(cont ="") {
		document.getElementById('cont-error').innerHTML = "Contact cannot be blank";
		document.getElementById('contact').css("border","1px solid red");
	}
}

function check(input) {
			    if (input.value != document.getElementById('password').value) {
			        input.setCustomValidity('Passwords does not match.');
			    } else {
			        // input is valid -- reset the error message
			        input.setCustomValidity('');
			   }
			}