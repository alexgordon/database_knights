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
//$dbname = "sandbox";
$dbname = "database_knights";

$firstName = $_POST["fName"];
$lastName = $_POST["lName"];
$email = $_POST["email"];
$newUserPass = $_POST["pass"];
$newUserConfPass = $_POST["confPass"];
$default_privilege_status = "student";

$error_message = "";
$string_exp = "/^[A-Za-z0-9 .'-]+$/";

if($newUserPass != $newUserConfPass){
    die("Password does not match, Please try again");
}

else {


//Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }

    //Insert New User
    $sql = "INSERT INTO users_table(firstName,lastName,email)
    VALUES ('$firstName','$lastName','$email')";

    $conn->query($sql);

    //Insert password for that user
    $sql = "INSERT INTO passwords_table(user_id,password)
    VALUES ((SELECT U.user_id FROM users_table U WHERE U.email = '$email') ,'$newUserPass')";

    $conn->query($sql);

    //Create Privileges for that user
    $sql = "INSERT INTO privileges_table(user_id,privilege_status)
    VALUES ((SELECT U.user_id FROM users_table U WHERE U.email = '$email'),'$default_privilege_status')";

    $conn->query($sql);

    $conn->close();
    }

    //Redirect
    header('Location: ../Views/login_page.html');
?>