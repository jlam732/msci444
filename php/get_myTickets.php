<?php
	include_once "creds.php";
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    $sql = "";
	    echo $_SESSION;
	    if($_SESSION["type"] == 1) {
	    	$sql = "SELECT * FROM ticket WHERE creator ='" . $_SESSION["id"] . "'";
	    } else {
	    	$sql = "SELECT * FROM ticket WHERE technican ='" . $_SESSION["id"] . "'";
	    }
	    $result = $conn->query($sql);
	    $tickets = $result->fetchAll();
	    echo json_encode($tickets);
	    //$conn->close();
	} catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
?>
