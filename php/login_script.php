<?php
	include_once "creds.php";

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
		    session_start();
		    $_SESSION["id"] = $array[0]["id"];
		    $_SESSION["alias"] = $array[0]["alias"];
		    $_SESSION["first_name"] = $array[0]["first_name"];
		    $_SESSION["last_name"] = $array[0]["last_name"];
		    $_SESSION["type"] = $array[0]["type"];
		    $_SESSION["email"] = $array[0]["email"];
		    $_SESSION["phone_num"] = $array[0]["phone_num"];
		    switch($_SESSION["type"]) {
		    	case 1: //client
		    		echo json_encode("mytickets.php");
		    		break;
		    	case 2: //technician
		    		echo json_encode("mytickets_technician.php");
		    		break;
		    	case 3: //manager
		    		echo json_encode("mytickets_manager.php");
		    		break;
		    	default:
		    		echo json_encode("index.html");
		    }
		} else {
		    echo "Incorrect password, please change and try again.";
		}
	    } else {
		echo "Username not found, please try another account.";
	    }
	    //$conn->close();
	} catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	} catch(Exception $e) {
		echo $e->getMessage();
	}
	$conn = null;
?>
