<?php
        include_once "creds.php";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "";
            session_start();
            $sql = "SELECT t.id, t.type, t.subject, t.description, t.status, t.priority, u.first_name, u.last_name, t.creationDate FROM ticket t INNER JOIN user u "
                     . "ON t.creator = u.id WHERE t.status = 'Open' AND t.technician IS NULL ORDER BY t.id asc";
            $result = $conn->query($sql);
            $tickets = $result->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($tickets);
            //$conn->close();
        } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
?>

