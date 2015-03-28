<?php
        include_once "creds.php";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "";
            session_start();
            if($_SESSION["type"] == 1) {
                $sql = "SELECT t.id, t.type, t.subject, t.description, t.status, t.priority, u.first_name, u.last_name, t.creationDate FROM ticket t LEFT JOIN user u "
                         . "ON t.technician = u.id "
                         . "WHERE creator ='" . $_SESSION["id"] . "' ORDER BY t.id asc";
            } else if($_SESSION["type"] == 2) {
                $sql = "SELECT t.id, t.type, t.subject, t.description, t.status, t.priority, u.first_name, u.last_name, t.creationDate FROM ticket t INNER JOIN user u "
                         . "ON t.creator = u.id "
                         . "WHERE technician ='" . $_SESSION["id"] . "' ORDER BY t.id asc";
            } else if($_SESSION["type"] == 3) {
                $sql = "SELECT t.id, t.type, t.subject, t.description, t.status, t.priority, u.first_name, u.last_name, u2.first_name as tech_first, u2.last_name as tech_last, t.creationDate " 
                     . "FROM ticket t INNER JOIN user u ON t.creator = u.id INNER JOIN user u2 ON t.technician = u2.id ORDER BY t.id asc";
            }
            $result = $conn->query($sql);
            $tickets = $result->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($tickets);
            //$conn->close();
        } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
?>

