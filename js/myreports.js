$(document).ready(function() {
    var flag = false;
    $("#techrept").click(function() {
        var thead = $('#technicianTable thead');
        var tbody = $('#technicianTable tbody');
	thead.empty();
	tbody.empty();
        $.ajax({
            url: '../php/get_myReports.php',
            type: 'get',
            success: function(data){
                var tickets = JSON.parse(data);
                thead.append("<tr><th>Name of Technician</th><th>Number of Closed Tickets</th></tr>");
		tr = "";
                for(var index = 0; index < tickets.length; index++) {
                    var ticket = tickets[index];
                    ticket["first_name"] += " " + ticket["last_name"];
                    delete ticket["last_name"];
                    if(ticket["first_name"] == "null null") { ticket["first_name"] = ""; }
                    tr+='<tr><td>' + ticket["first_name"] + '</td><td>' + ticket["tickets_closed"] + '</td></tr>';
                }
		tbody.append(tr);
		if(!flag) {
			flag = true;
		        $('#technicianTable').DataTable({
                		 responsive: true,
	                });
		}
            },
            error: function(error){
                console.log(error);
                $('.alert').text(error.responseText).show();
            }
        });
    });
});
