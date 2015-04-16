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
//$rso_id = ;
$description = $_POST['description'];
$time = $_POST['time'];
$uni_id = $_POST['uni_id'];
$user_id = $_POST['user_id'];

$eType .= "_pending";

//echo $eName.$eLocation.$eType.$description.$time.$rso_id;


$sql = "INSERT INTO non_rso_events_table(nre_name, nre_time, nre_location, nre_description, uni_id, nre_privateEvent,nre_user_id)
        VALUES ('$eName', '$time' ,'$eLocation', '$description' ,'$uni_id', '$eType','$user_id')";

$conn->query($sql);

$conn->close();

//Redirect
header('Location: ../Views/create_non_rso_success_page.php');

?>