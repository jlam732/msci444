$(document).ready(function() {
    $("form").submit(function() {
        //try to serialize the form
        var data = $("#createTicket").serializeArray();
        
        //maybe do some error checking
        
        //hack to change priority to a number
        data[3].value = data[3].value.slice(0,1);

        console.log(data);
        
        $.ajax({
            type: "POST",
            url: "../php/createTicket.php",
            data: data, 
            success: function(ticket) {
                //say some nice message, give the ID of the ticket
                alert(ticket);
            },
            error: function(error) {
                console.log(error);
                $('.alert-danger').text(error.responseText).show();
            }
        });

        return false; // avoid to execute the actual submit of the form.
    });
});
