<?php
	include_once "creds.php";
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    $sql = "";
        session_start();
	    if($_SESSION["type"] == 1) {
	    	$sql = "SELECT t.*, u.first_name, u.last_name FROM ticket t INNER JOIN user u "
	    		 . "ON t.creator = u.id "
	    		 . "WHERE creator ='" . $_SESSION["id"] . "'";
	    } else {
	    	$sql = "SELECT t.*, u.first_name, u.last_name FROM ticket t INNER JOIN user u "
	    		 . "ON t.creator = u.id "
	    		 . "WHERE technician ='" . $_SESSION["id"] . "'";
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
