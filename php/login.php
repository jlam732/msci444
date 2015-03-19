<?php
	$servername = "localhost";
	$username = "jg2lam";
	$password = "Winter2015";
	$dbname = "jg2lam";

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    // use exec() because no results are returned
	    $sql = "SELECT * FROM user WHERE alias='" . $_GET["0"]["value"] . "'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
		    }
		} else {
		    echo "0 results";
		}
		$conn->close();
	} catch(PDOException $e) {
    	echo $sql . "<br>" . $e->getMessage();
    }
	$conn = null;
?>