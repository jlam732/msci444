<?php
        include_once "creds.php";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            session_start();
            
            // our SQL statememts
            $sql = "INSERT INTO ticket (type, subject, description, creator, status, priority) VALUES (:type, :subject, :description, :creator, :status, :priority)";
	    $query = $conn->prepare($sql);
	    $query->execute(array(':type'=> $_POST["type"], ':subject'=>$_POST["subject"], ':description'=>$_POST["desc"], ':creator'=>$_SESSION["id"], ':status': $_POST["status"], ':priority': $_POST["priority"]));
	    $insert_id = $query->lastInsertId();
	    echo $insert_id;
        } catch(PDOException $e) {
	    $conn->rollback();
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
?>

