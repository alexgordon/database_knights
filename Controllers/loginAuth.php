<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 3/22/2015
 * Time: 10:22 AM
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sandbox";

$userPass = $_POST["pass"];
$email = $_POST["email"];

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

$sql = "SELECT * FROM usertable U , passwordtable P WHERE U.email='$email' AND P.passcode ='$userPass'AND U.user_id = P.user_id";
$result = $conn->query($sql);
$count = $result->num_rows;
//Success
if($count == 1){

    $row = $result->fetch_array(MYSQL_ASSOC);
    session_start();
    $_SESSION['email']= $email;
    $_SESSION['firstName'] = $row['firstName'];
    $_SESSION['lastName'] = $row['lastName'];
    $_SESSION['user_id'] = $row['user_id'];


    header('Location: ../Views/user_homepage.php');
}

else{
    echo"Wrong Username or Password";
}






?>