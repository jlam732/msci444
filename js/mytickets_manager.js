$(document).ready(function() {
    $.ajax({
        url: '../php/get_myTickets.php',
        type: 'get',
        success: function(data) {
        //put the tickets dynamically in the table using foreach
            var tickets = JSON.parse(data);
            console.log(tickets);
            var dataTable = $('#dataTables-example tbody');
            for(var index = 0; index < tickets.length; index++) {
                var ticket = tickets[index];
                ticket["first_name"] += " " + ticket["last_name"];
                delete ticket["last_name"];
                if(ticket["first_name"] == "null null") { ticket["first_name"] = ""; }
                ticket["tech_first"] += " " + ticket["tech_last"];
                delete ticket["tech_last"];
                if(ticket["tech_first"] == "null null") { ticket["tech_first"] = ""; }
                var tr = "<tr " + (index % 2 == 0 ? 'class="odd">' : 'class="even">');
                for (var key in ticket) {
                    if (ticket.hasOwnProperty(key)) {
                        if(key == "id") {
                            tr += '<td><button type="button" data-id="' + ticket["id"] + '" class="btn btn-primary editTicket">Edit</button>' + ticket[key] + "</td>";
                        } else {
                            tr += "<td>" + (ticket[key] == null ? "" : ticket[key]) + "</td>";
                        }
                    }
                }
                //make the button
                dataTable.append(tr + "</tr>");
            }
            $('#dataTables-example').DataTable({
              responsive: true,
              "columnDefs": [
                    {
                        "targets": [ 1 ],
                        "searchable": false
                    }
                ]
            });

            $('.editTicket').click(function() {
                var ticket_id = $(this).data("id");
                window.location.href = "ticket_client.php?id=" + ticket_id;
            });
        },
        error: function(error) {
            console.log(error);
            $('.alert').text(error.responseText).show();
        }
    });
});
