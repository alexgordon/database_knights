<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 4/7/2015
 * Time: 1:05 AM
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_knights";

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$eName = $_POST['eName'];
$eLocation = $_POST['location'];
$eType = $_POST['eType'];
$rso_id = $_POST['rso'];
$description = $_POST['description'];
$time = $_POST['time'];

$sql = "INSERT INTO events_table(name, time, location, description, rso_id, privateEvent)
        VALUES ('$eName', '$time' ,'$eLocation', '$description' ,'$rso_id', '$eType')";

$conn->query($sql);

$conn->close();

//Redirect
header('Location: ../Views/user_rso_page.php?rso_id='.$rso_id);

?>