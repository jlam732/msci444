$(document).ready(function() {
    $("#techrept").click(function() {
        $.ajax({
            url: '../php/get_myReports.php',
            type: 'get',
            success: function(data){
                var tickets = JSON.parse(data);
                var thead = $('#technicianTable thead');
                var tbody = $('#technicianTable tbody');
                thead.append("<tr><th>Name of Technician</th><th>Number of Closed Tickets</th></tr>");
                for(var index = 0; index < tickets.length; index++) {
                    var ticket = tickets[index];
                    ticket["first_name"] += " " + ticket["last_name"];
                    delete ticket["last_name"];
                    if(ticket["first_name"] == "null null") { ticket["first_name"] = ""; }
                    tr+='<tr><td>' + ticket["first_name"] + '</td><td>' + ticket["tickets_closed"] + '</td></tr>';
                }
                $('#technicianTable').DataTable({
                 responsive: true,
                });
            },
            error: function(error){
                console.log(error);
                $('.alert').text(error.responseText).show();
            }
        });
    });
});
