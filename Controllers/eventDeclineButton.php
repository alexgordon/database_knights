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

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

//Insert members to rso
$sql = "DELETE FROM non_rso_events_table NRE WHERE NRE.nre_id = '$nre_id'";

$conn->query($sql);


//Redirect
header('Location: ../Views/events_applications_page.php');

?>