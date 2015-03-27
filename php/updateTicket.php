<?php
        include_once "creds.php";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            session_start();
            // our SQL statememts
            $sql = "UPDATE ticket SET type=?, subject=?, description=?, priority=?, status=?, technician=? WHERE id=?";
	    $query = $conn->prepare($sql);
	    $query->execute(array($_POST["type"],$_POST["subject"],$_POST["desc"],$_POST["priority"],$_POST["status"], $_POST["technician"],$_POST["id"]));
	    echo $query->rowCount() ? true : false;
        } catch(PDOException $e) {
	    $conn->rollback();
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
?>

