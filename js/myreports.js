$(document).ready(function() {
    var flag = false;
    $("#techrept").click(function() {
           var asset = $($('#basicReports').children()[0]).clone();
           asset.find("small").html("Report 7");
           $('#advancedReports .fancybox').removeClass('blueBorder');
           $('#basicReports').css("height", "217px").append(asset);
  //       var thead = $('#technicianTable thead');
  //       var tbody = $('#technicianTable tbody');
	 //    thead.empty();
	 //    tbody.empty();
  //       $.ajax({
  //           url: '../php/get_myReports.php',
  //           type: 'get',
  //           success: function(data){
  //               var tickets = JSON.parse(data);
  //               thead.append("<tr><th>Name of Technician</th><th>Number of Closed Tickets</th></tr>");
		// tr = "";
  //               for(var index = 0; index < tickets.closedTicket.length; index++) {
  //                   var ticket = tickets.closedTicket[index];
  //                   ticket["first_name"] += " " + ticket["last_name"];
  //                   delete ticket["last_name"];
  //                   if(ticket["first_name"] == "null null") { ticket["first_name"] = ""; }
  //                   tr+='<tr><td>' + ticket["first_name"] + '</td><td>' + ticket["tickets_closed"] + '</td></tr>';
  //               }
		// tbody.append(tr);
		// if(!flag) {
		// 	flag = true;
		//         $('#technicianTable').DataTable({
  //               		 responsive: true,
	 //                });
		// }
  //           },
  //           error: function(error){
  //               console.log(error);
  //               $('.alert').text(error.responseText).show();
  //           }
  //       });
        
    });

    $("#tickrept").click(function(){
    //     var thead = $('#technicianTable thead');
    //     var tbody = $('#technicianTable tbody');
    // thead.empty();
    // tbody.empty();
    // $.ajax({
    //         url: '../php/get_myReports.php',
    //         type: 'get',
    //         success: function(data){
    //             var dates = JSON.parse(data);                
    //             console.log(dates.ticketDate[1]);
    //             thead.append("<tr><th>Date</th><th>Number of Tickets Created</th></tr>");
    //     tr = "";
    //             for(var index = 0; index < dates.ticketDate.length; index++) {
    //                 var date = dates.ticketDate[index];
                    
    //                 tr+='<tr><td>' + date["Date(creationDate)"] + '</td><td>' + date["count(id)"] + '</td></tr>';
    //             }
    //     tbody.append(tr);
    //     if(!flag) {
    //         flag = true;
    //             $('#technicianTable').DataTable({
    //                      responsive: true,
    //                 });
    //     }
    //         },
    //         error: function(error){
    //             console.log(error);
    //             $('.alert').text(error.responseText).show();
    //         }
    //     });
    });

    $(".fancybox").click(function(event) {
        event.preventDefault();
        $(this).toggleClass("blueBorder");
    });
});
