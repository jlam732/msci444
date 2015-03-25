$(document).ready(function() {
    $.ajax({
        url: '../php/get_myTickets.php',
        type: 'get',
        success: function(data) {
            alert(data);
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