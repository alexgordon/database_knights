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

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

//Insert members to rso
$sql = "INSERT INTO rso_member(user_id,rso_id)
        VALUES ((SELECT RP.admin FROM rso_pending RP WHERE RP.rso_id = '$rso_id'),'$rso_id')";

$conn->query($sql);

$sql = "INSERT INTO rso_member(user_id,rso_id)
        VALUES ((SELECT RP.mem2 FROM rso_pending RP WHERE RP.rso_id = '$rso_id'),'$rso_id')";

$conn->query($sql);

$sql = "INSERT INTO rso_member(user_id,rso_id)
        VALUES ((SELECT RP.mem3 FROM rso_pending RP WHERE RP.rso_id = '$rso_id'),'$rso_id')";

$conn->query($sql);

$sql = "INSERT INTO rso_member(user_id,rso_id)
        VALUES ((SELECT RP.mem4 FROM rso_pending RP WHERE RP.rso_id = '$rso_id'),'$rso_id')";

$conn->query($sql);

$sql = "INSERT INTO rso_member(user_id,rso_id)
        VALUES ((SELECT RP.mem5 FROM rso_pending RP WHERE RP.rso_id = '$rso_id'),'$rso_id')";

$conn->query($sql);

$sql = "DELETE FROM rso_pending WHERE rso_id = '$rso_id'";

$conn->query($sql);

//Redirect
header('Location: ../Views/super_admin_homepage.php');

?>