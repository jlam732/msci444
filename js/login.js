$(document).ready(function() {
    $("#submitButton").on("click", function() {
    	var errorFlag = false;
    	$('.alert').hide();
    	var values = $('form').serializeArray();
    	$.each(values, function(index) {
    		if(values[index]["value"] === "") {
    			$('.alert').text(values[index]["name"] + " is invalid").show();
    			errorFlag = true;
    		}
    	});
    	if(errorFlag) {
    		return;
    	}
    	$.ajax({
    		url: '../php/login_script.php',
         	data: values,
         	type: 'post',
         	success: function(user) {
         		var cookie = "id=" + user["id"] + ";"
         				   + "username=" + user["alias"] + ";"
         				   + "first_name=" + user["first_name"] + ";"
         				   + "last_name=" + user["last_name"] + ";"
         				   + "first_name=" + user["first_name"] + ";"
         				   + "phone_num=" + user["phone_num"] + ";"
         				   + "type=" + user["type"] + ";"
         		document.cookie=cookie;
            },
            error: function(error) {
            	console.log(error);
            	$('.alert').text(error.responseText).show();
            }
		});
    });
});
