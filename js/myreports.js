$(document).ready(function() {
    $.ajax({
        url: '../php/myreports.php',
        type: 'get',
        success: function(data){
            var closedTicket = JSON.parse(data);

            $("#techrept").click(function(){
                console.log("lasjkf");
                echo closedTicket;
            });

            $("#tickrept").click(function(){

            });

        },
        error: function(error) {
            console.log(error);
            $('.alert').text(error.responseText).show();
        }
    });
});