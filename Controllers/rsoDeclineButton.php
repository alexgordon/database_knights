<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 4/6/2015
 * Time: 11:12 PM
 */

$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "sandbox";
$dbname = "database_knights";

$rso_id = $_POST['rso_id'];

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

$sql = "DELETE FROM rso_pending WHERE rso_id = '$rso_id'";

$conn->query($sql);

//Redirect
header('Location: ../Views/super_admin_homepage.php');

?>