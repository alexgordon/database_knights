<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 4/6/2015
 * Time: 10:50 PM
 */

$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "sandbox";
$dbname = "database_knights";

$privateEvent = $_POST['privateEvent'];
$nre_id = $_POST['nre_id'];

$privateEvent = substr($privateEvent,0,-8);

echo $nre_id;

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

//Delete Event
$sql = "DELETE FROM non_rso_events_table WHERE nre_id = '$nre_id'";

$conn->query($sql);


//Redirect
header('Location: ../Views/events_applications_page.php');

?>