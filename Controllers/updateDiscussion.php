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
//$dbname = "sandbox";
$dbname = "database_knights";

session_start();
date_default_timezone_set('America/New_York');

$comment = $_POST["comment"];

if(isset($_POST['nre_id'])){
    $event_id = $_POST['nre_id'];
    $eventType = "nre";
}
    else {
        $event_id = $_POST["eid"];
        $eventType = "event";
    }
$rating = $_POST['rating'];
$id = $_SESSION["user_id"];
$commentDate = date('F jS Y h:i:s A');


//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}
if ($eventType == "event") {
    if (isset($_POST['rating'])) {
        $sql = "INSERT INTO reviews_table(user_id,event_id,comments,reviewDate, rating) VALUES ('$id','$event_id','$comment','$commentDate','$rating')";
        $conn->query($sql);

        $sql = "SELECT R.rating FROM reviews_table R WHERE R.rating IS NOT NULL AND event_id = '$event_id'";
        $result = $conn->query($sql);

        $total = 0;
        $count = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $total += $row['rating'];
            $count++;
        }

        $total_rating = $total / $count;

        $sql = "UPDATE events_table E SET E.rating = '$total_rating', E.rating_count = '$count'
            WHERE E.event_id = '$event_id'";
        $conn->query($sql);

    } else {
        $sql = "INSERT INTO reviews_table(user_id,event_id,comments,reviewDate) VALUES ('$id','$event_id','$comment','$commentDate')";
        $conn->query($sql);
    }

    $conn->close();

    header("Location: ../Views/event_detail_page.php?eid=$event_id");
}

else{
    if (isset($_POST['rating'])) {
        $sql = "INSERT INTO reviews_table(user_id,nre_id,comments,reviewDate, rating) VALUES ('$id','$event_id','$comment','$commentDate','$rating')";
        $conn->query($sql);

        $sql = "SELECT R.rating FROM reviews_table R WHERE R.rating IS NOT NULL AND nre_id = '$event_id'";
        $result = $conn->query($sql);

        $total = 0;
        $count = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $total += $row['rating'];
            $count++;
        }

        $total_rating = $total / $count;

        $sql = "UPDATE non_rso_events_table NRE SET NRE.nre_rating = '$total_rating', NRE.nre_rating_count = '$count'
            WHERE NRE.nre_id = '$event_id'";
        $conn->query($sql);

    } else {
        $sql = "INSERT INTO reviews_table(user_id,nre_id,comments,reviewDate) VALUES ('$id','$event_id','$comment','$commentDate')";
        $conn->query($sql);
    }

    $conn->close();

    header("Location: ../Views/nre_detail_page.php?nre_id=$event_id");

}

//echo $commentDate;
?>