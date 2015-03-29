<?php
    //get the current ticket being edited, all the activities for that ticket
    //also, if it's a technician or manager, get the list of technicians to populate a dropdown
    session_start();
    include_once "../php/creds.php";
    $closedTicket = [];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //get the ticket info
        $sql = "SELECT user.first_name, user.last_name, COUNT(ticket.id) as tickets_closed FROM ticket left join user " 
             . "on user.id = ticket.technician WHERE user.type=2 AND ticket.status='Closed' GROUP BY ticket.technician";
        $result = $conn->query($sql);
        $closedTicket = $result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($closedTicket);
        //$conn->close();
    } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
?>