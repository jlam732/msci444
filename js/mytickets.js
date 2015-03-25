$(document).ready(function() {
    $.ajax({
        url: '../php/get_myTickets.php',
        type: 'get',
        success: function(tickets) {
            //put the tickets dynamically in the table using foreach
            var dataTable = $('#dataTables-example tbody');
            $.each(tickets, function(index, ticket) {
                var tr = "<tr " + (index % 2 == 0 ? 'class="odd">' : 'class="even">');
                for (var key in ticket) {
                    if (ticket.hasOwnProperty(key)) {
                        tr.append("<td>" + ticket[key] + "</td>");
                    }
                }
                dataTable.append(tr + "</tr>");
            });
        },
        error: function(error) {
            console.log(error);
            $('.alert').text(error.responseText).show();
        }
    });
    $('#dataTables-example').DataTable({
            responsive: true
    });
});