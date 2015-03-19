<?php
	$servername = "localhost";
	$username = "jg2lam";
	$password = "Winter2015";
	$dbname = "jg2lam";

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    $sql = "SELECT * FROM user WHERE alias='" . $_POST["alias"] . "'";
	    $result = $conn->query($sql);
	    $array = $result->fetchAll();
	    if(count($array) == 1) {
	        if($array[0]["password"] == $_POST["password"]) {
		    header('Content-Type: application/json');
		    echo json_encode($array[0]);
		} else {
		    echo "Incorrect password, please change and try again.";
		}
	    } else {
		echo "Username not found, please try another account.";
	    }
	    //$conn->close();
	} catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
?>
