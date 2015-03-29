$(document).ready(function() {
    $.ajax({
        url: '..pages/myreports.php',
        type: 'get',
        success: function(data){
            var tickets=JSON.parse(data);

            $("#techrept").click(function(){
                document.write("what up");
            });
            $("#tickrept").click(function(){

            });
        }
        error: function(error){
            console.log(error);
            $('.alert').text(error.responseText).show();
        }
    })
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
