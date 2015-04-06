<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 4/5/2015
 * Time: 7:49 PM
 */

$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "sandbox";
$dbname = "database_knights";

$universityName = $_POST['uName'];
$location = $_POST['location'];
$description = $_POST['description'];


//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

$sql = "INSERT INTO universities_table(name,location,description)
        VALUES ('$universityName','$location','$description')";

$conn->query($sql);

$conn->close();

//Redirect
header('Location: ../Views/super_admin_homepage.php');

?>