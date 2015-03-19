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
         		window.location.href("/pages/index.html");
            },
            error: function(error) {
            	console.log(error);
            	$('.alert').text(error.responseText).show();
            }
		});
    });
});
