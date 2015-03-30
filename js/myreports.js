$(document).ready(function() {
    $.ajax({
        url: '../php/get_myReports.php',
        type: 'get',
        success: function(data){
            var tickets=JSON.parse(data);
            var dataTable = $('#technicianTable tbody');
            
            $("#techrept").click(function(){
                var thead = ('<thead><tr><th>Name of Technician</th><th>Number of Closed Tickets</th></tr></thead>');
                var tr = '<thead><th><tr>';
                var percent = new Array(tickets.length);
                count=0;
                for (i=0;i<tickets.length;i++)
                {
                    ticket=tickets[i];
                    count+=ticket["tickets_closed"];
                }

                for (i=0;i<tickets.length;i++)
                {
                    ticket=tickets[i];
                    percent[i]=(ticket["tickets_closed"]/count)*100;
                }

                for (i=0;i<tickets.length;i++)
                {
                    var ticket = tickets[i];
                    ticket["first_name"] += " " + ticket["last_name"];
                    delete ticket["last_name"];

                    if(ticket["first_name"] == "null null") { ticket["first_name"] = ""; }

                    tr+='<td>' + ticket["first_name"] + '</td><th><td>' + ticket["tickets_closed"] + '</td></th></tr>';
                }
                tr+='</thead>';

                graph='<dl style="width: 300px">';

                for (i=0;i<tickets.length;i++)
                {
                    var ticket = tickets[i];
                    ticket["first_name"] += " " + ticket["last_name"];
                    delete ticket["last_name"];

                    if(ticket["first_name"] == "null null") { ticket["first_name"] = ""; }
                    
                    graph+='<dt>'+ticket["first_name"]+'</dt><dd><div id="data-one" class="bar" style="width: '+percent[i]+'%">'+percent[i]+'%</div></dd>';
                }
                graph+='</dl>';
                dataTable.append(thead+tr+graph);
                console.log(tickets);
                
                if($(this).attr('data-off')==1) return;
                $(this).attr('data-off', 1);
        //my action
        $(this).mouseout(function(){
         $(this).attr('data-off',0);
     });
        
            });
            $("#tickrept").click(function(){

            });

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



//     $.ajax({
//         url: '../pages/myreports.php',
//         type: 'get',
//         success: function(data){
//             var closedTicket=JSON.parse(data);

//             $("#techrept").click(function(){
//                 console.log("lasjkf");
//                 for(var index = 0; index < tickets.length; index++) {
//                     var ticket = tickets[index];
//                     ticket["first_name"] += " " + ticket["last_name"];
//                     delete ticket["last_name"];
//                     if(ticket["first_name"] == "null null") { ticket["first_name"] = ""; }
//                     var tr = "<tr " + (index % 2 == 0 ? 'class="odd">' : 'class="even">');
//                     for (var key in ticket) {
//                         if (ticket.hasOwnProperty(key)) {
//                             if(key == "id") {
//                                 tr += '<td><button type="button" data-id="' + ticket["id"] + '" class="btn btn-primary editTicket">Edit</button>' + ticket[key] + "</td>";
//                             } else {
//                                 tr += "<td>" + (ticket[key] == null ? "" : ticket[key]) + "</td>";
//                             }
//                         }
//                     }
//                 dataTable.append(tr + "</tr>");
//             }
//             $('#dataTables-example').DataTable({responsive: true,});
//             document.write();
//         });

// $("#tickrept").click(function(){

// });

// },
// error: function(error) {
//     console.log(error);
//     $('.alert').text(error.responseText).show();
// }
// });
