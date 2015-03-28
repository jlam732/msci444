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

    $("#addComment").submit(function() {
        //try to serialize the form
        var data = $("#addComment").serializeArray();
        event.preventDefault();
        console.log(data);
        $.ajax({
            type: "POST",
            url: "../php/addComment.php",
            data: data, 
            success: function(activity) {
                //put the comment into the thing
                console.log(activity);
                var comment = $('.comment:last').clone();
                comment = comment.find('.activity-name').html(activity['name']);
                comment = comment.find('.activity-time').html('commented on ' + activity['createdDate']);
                comment = comment.find('.activity-name').html(activity['description']);
                comment.insertAfter('.comment:last');
                // add a new add comment part
            },
            error: function(error) {
                console.log(error);
                $('.alert-danger').text(error.responseText).show();
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });
});
