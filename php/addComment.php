<?php
        include_once "creds.php";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            session_start();
            // our SQL statememts
            $sql = "INSERT INTO activity (ticket_id, name, description) VALUES (?,?,?)";
	    $query = $conn->prepare($sql);
	    $query->execute(array($_POST["ticket_id"],$_POST["name"],$_POST["description"]));
	    $id = $conn->lastInsertID();
        //now get the activity back
        $sql = "SELECT name, description, creationDate FROM activity WHERE id ='" . $id . "'";
        $result = $conn->query($sql);
        $activity = $result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($activity);
        } catch(PDOException $e) {
	    $conn->rollback();
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
?>

