$(document).ready(function() {
    $.ajax({
        url: '../php/get_myReports.php',
        type: 'get',
        success: function(data){
            var tickets=JSON.parse(data);
            var dataTable = $('#dataTables-example tbody');
            for (i=0;i<tickets.length;i++)
            {
                var ticket = tickets[index];
                ticket["first_name"] += " " + ticket["last_name"];
                delete ticket["last_name"];

                if(ticket["first_name"] == "null null") { ticket["first_name"] = ""; }
            }
            $("#techrept").click(function(){
                dataTable.append('<div id="page-wrapper">
                    <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">Technician Report</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                    <div class="alert alert-danger" style="display:none;"></div>
                    <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                    <th>Name: </th>' + ticket["first_name"] + '
                    <th>Number of Tickets closed: </th>' + ticket["tickets_closed"] + '
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                    </div>
                    <!-- /.table-responsive -->
                    </div>
                    </div>')
});
            $("#tickrept").click(function(){

            });

            $('#dataTables-example').DataTable({
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
