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

$rso_id = $_POST['rso_id'];
$user_id = $_POST['user_id'];

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

//Insert members to rso
$sql = "INSERT INTO rso_member(user_id,rso_id)
        VALUES ('$user_id','$rso_id')";

$conn->query($sql);


//Redirect
header('Location: ../Views/user_homepage.php');

?>