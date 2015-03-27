$(document).ready(function() {
    $("#createTicket").submit(function() {
        //try to serialize the form
        var data = $("#createTicket").serializeArray();
        event.preventDefault();
        //maybe do some error checking
        if(data.length == 0) {
            console.log("something wrong with data");
            return false;
        }
        for(var i = 0; i < data.length; i++) {
            if(data[i].name === "priority") {
                data[i].value = data[i].value.slice(0,1);
            }
        }
        console.log(data);
        $.ajax({
            type: "POST",
            url: "../php/updateTicket.php",
            data: data, 
            success: function(status) {
                //say some nice message, give the ID of the ticket
                if(status) {
                    alert("Success! Your ticket was updated");
                } else {
                    alert("No changes were made to the ticket");
                }
            },
            error: function(error) {
                console.log(error);
                $('.alert-danger').text(error.responseText).show();
            }
        });

        return false; // avoid to execute the actual submit of the form.
    });
});
