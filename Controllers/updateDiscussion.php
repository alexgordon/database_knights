<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 3/23/2015
 * Time: 2:10 AM
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sandbox";

session_start();
date_default_timezone_set('America/New_York');

$comment = $_POST["comment"];
$id = $_SESSION["user_id"];
$commentDate = date('F jS Y h:i:s A');

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

$sql = "INSERT INTO commentstable(user_id,comment,commentDate) VALUES ('$id','$comment','$commentDate')";
$conn->query($sql);

$conn->close();

header("Location: ../Views/user_homepage.php");
//echo $commentDate;
?>