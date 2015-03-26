<?php
        include_once "creds.php";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            session_start();
            // our SQL statememts
            $sql = "INSERT INTO ticket (type, subject, description, creator, status, priority) VALUES (?,?,?,?,?,?)";
	    $query = $conn->prepare($sql);
	    $query->execute(array($_POST["type"],$_POST["subject"],$_POST["desc"],$_SESSION["id"],"Open",$_POST["priority"]));
	    echo $conn->lastInsertID();
        } catch(PDOException $e) {
	    $conn->rollback();
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
?>

