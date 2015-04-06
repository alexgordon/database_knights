<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 4/6/2015
 * Time: 12:32 AM
 */


$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "sandbox";
$dbname = "database_knights";

$rName = $_POST['rName'];
$admin = $_POST['admin'];
$mem2 = $_POST['mem2'];
$mem3 = $_POST['mem3'];
$mem4 = $_POST['mem4'];
$mem5 = $_POST['mem5'];
$uni_id = $_POST['uni_id'];


//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

//Create RSO
$sql = "INSERT INTO rso_table(uni_id,name,admin)
        VALUES ('$uni_id','$rName',(SELECT U.user_id FROM users_table U WHERE U.email = '$admin'))";

$conn->query($sql);

$sql = "INSERT INTO rso_pending(rso_id,admin,mem2,mem3,mem4,mem5)
        VALUES ((SELECT R.rso_id FROM rso_table R WHERE R.admin = (SELECT U.user_id FROM users_table U WHERE U.email = '$admin') AND R.uni_id = '$uni_id' AND R.name = '$rName'),
        (SELECT U.user_id FROM users_table U WHERE U.email = '$admin'),
        (SELECT U.user_id FROM users_table U WHERE U.email = '$mem2'),
        (SELECT U.user_id FROM users_table U WHERE U.email = '$mem3'),
        (SELECT U.user_id FROM users_table U WHERE U.email = '$mem4'),
        (SELECT U.user_id FROM users_table U WHERE U.email = '$mem5'))";

$conn->query($sql);

$conn->close();

//Redirect
header('Location: ../Views/user_homepage.php');

?>