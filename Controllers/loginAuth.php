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
//$dbname = "sandbox";
$dbname = "database_knights";

$userPass = $_POST["pass"];
$email = $_POST["email"];

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

$sql = "SELECT * FROM users_table U , passwords_table P WHERE U.email='$email' AND P.password ='$userPass'AND U.user_id = P.user_id";
$result = $conn->query($sql);
$count = $result->num_rows;
//Success
if($count == 1){

    $privilege_sql = "SELECT P.privilege_status FROM users_table U, privileges_table P WHERE U.email = '$email' AND U.user_id = P.user_id";
    $privilege_result = $conn->query($privilege_sql);
    $privilege_row = $privilege_result->fetch_array(MYSQL_ASSOC);

    if($privilege_row['privilege_status'] == "student"){

        $row = $result->fetch_array(MYSQL_ASSOC);
        session_start();
        $_SESSION['email']= $email;
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['lastName'] = $row['lastName'];
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['uni_id'] = $row['uni_id'];
        $_SESSION['privilege_status'] = $privilege_row['privilege_status'];

        header('Location: ../Views/user_homepage.php');
    }

    if($privilege_row['privilege_status'] == "admin"){

        $row = $result->fetch_array(MYSQL_ASSOC);
        session_start();
        $_SESSION['email']= $email;
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['lastName'] = $row['lastName'];
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['uni_id'] = $row['uni_id'];
        $_SESSION['privilege_status'] = $privilege_row['privilege_status'];

        header('Location: ../Views/admin_homepage.php');

    }

    if($privilege_row['privilege_status'] == "super_admin"){

        $row = $result->fetch_array(MYSQL_ASSOC);
        session_start();
        $_SESSION['email']= $email;
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['lastName'] = $row['lastName'];
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['privilege_status'] = $privilege_row['privilege_status'];
        $_SESSION['uni_id'] = $row['uni_id'];

        header('Location: ../Views/super_admin_homepage.php');

    }


}

else{
    echo"Wrong Username or Password";
}






?>