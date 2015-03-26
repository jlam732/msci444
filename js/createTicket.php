<?php
        include_once "creds.php";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo var_dump($_POST);
            $sql = "";
            session_start();
            
            $conn->beginTransaction();
            // our SQL statememts
            // $sql = sprintf("INSERT INTO ticket (type, subject, description, creator, status, priority)
            //                 VALUES ('%s', '%s', '%s', %u, %s, %u)", $_POST[""])
            // $conn->exec(
            // VALUES ('John', 'Doe', 'john@example.com')");
            // //add the post 
            // $result = $conn->query($sql);
            // $tickets = $result->fetchAll(PDO::FETCH_ASSOC);
            // echo json_encode($tickets);
            //$conn->close();
        } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
?>

