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
    		url: '../php/login.php',
         	data: values,
         	type: 'post',
         	success: function(output) {
                alert(output);
            },
            error: function(error) {
            	$('.alert').text(error).show();
            }
		});
    });
});