<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 3/20/2015
 * Time: 1:33 AM
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_knights";

$firstName = $_POST["fName"];
$lastName = $_POST["lName"];
$email = $_POST["email"];
$user_id = $_POST['user_id'];



//Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }

    //Update User
    $sql = "UPDATE users_table SET firstName = '$firstName', lastName = '$lastName', email = '$email' WHERE user_id = '$user_id'";

    $conn->query($sql);

    $conn->close();

    session_start();
    $_SESSION['email']= $email;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;



    //Redirect
    header('Location: ../Views/update_profile_page.php');


?>