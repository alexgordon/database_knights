<?php
/**
 * Created by PhpStorm.
 * User: Danny Finkelstein
 * Date: 4/9/2015
 * Time: 11:30 AM
 */


session_start();

// $_SESSION['privilege_status'] != "admin"

if($_SESSION['user_id'] == null){
    header('Location: ../Views/homepage.html');
}

else{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "database_knights";

    $uni_id = $_SESSION['uni_id'];
    $user_id = $_SESSION['user_id'];

    $event_id = $_GET['eid'];

//Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }

//GET University
    $sql = "SELECT UNI.name FROM universities_table UNI WHERE UNI.uni_id = '$uni_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

//GET event details
    $sql = "SELECT E.* FROM events_table E WHERE E.event_id = '$event_id'";
    $event_result = $conn->query($sql);
    $event_row = $event_result->fetch_assoc();

    $rso = $event_row['rso_id'];

//GET RSO name
    $sql = "SELECT R.name FROM rso_table R WHERE R.rso_id = '$rso'";
    $rso_result = $conn->query($sql);
    $rso_row = $rso_result->fetch_assoc();

//GET comments
    $sql = "SELECT R.comments, R.reviewDate, U.firstName, U.lastName
            FROM reviews_table R, users_table U
            WHERE R.event_id='$event_id' AND R.user_id = U.user_id";
    $result = $conn->query($sql);
    $resultArray = array();
    $dateArray = array();
    $counter = 0;
    $comments_index=0;
    $date_index=1;
    $user_index=3;
    while($rows = $result->fetch_assoc()){
        //   $resultArray[$rows['comment']][$counter] = $rows['comment'];
        //   $dateArray[$rows['commentDate']][$counter] = $rows['commentDate'];
        $resultArray[$comments_index][$counter] = $rows['comments'];
        $resultArray[$date_index][$counter] = $rows['reviewDate'];
        $resultArray[$user_index][$counter] = $rows['firstName']." ".$rows['lastName'];
        $counter++;
    }

}

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<!--Scripts and Styles-->
<script src="../Assets/Scripts/jquery-2.1.3.min.js"></script>
<script src="../Assets/Scripts/bootstrap.min.js"></script>
<link rel="stylesheet" href="../Assets/Styles/bootstrap.min.css">
<link rel="stylesheet" href="../Assets/Styles/bootstrap-theme.min.css">
<link rel="stylesheet" href="../Assets/Styles/home_styles.css">
<!--Scripts and Styles-->

<!--Header-->
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="user_homepage.php" class="navbar-brand">Company Name</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="user_homepage.php">Profile</a>
                </li>
                <li>
                    <a href="../Controllers/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--Header-->

<div class="container-fluid">

    <?php
    echo "<h2 class='text-center'>".$row['name']."</h2>";

    echo "<h3 class='text-center'>".$rso_row['name']." - <b>".$event_row['name']."</b></h3>";

    ?>
    <hr>
    <?php
        $event_day = date("l F j, Y", strtotime($event_row['time']));
        $event_time = date("g:i A", strtotime($event_row['time']));

        $location = $event_row['location'];
        $map_location = str_replace(' ', '+',$location );

        echo "<h3 class='text-center'>$event_day</h3>
              <h4 class='text-center'>$event_time</h4>
              <h3 class='text-center'>".$event_row['location']."</h3>
              <img class='center-block img-responsive' boarder='0' src='https://maps.googleapis.com/maps/api/staticmap?center=".$map_location."&zoom=14&size=400x400&markers=color:blue%7Clabel:S%7C".$map_location."'>
              <div class='text-center'>
              ".$event_row['description']."
              </div>";

    ?>

</div>

<div class="detailBox">
    <div class="titleBox text-center">
        <label>Comment Box</label>
        <button type="button" class="close" aria-hidden="true">&times;</button>
    </div>
    <div class="commentBox">

        <p class="taskDescription">Please write your comments about how you like this event.</p>
    </div>
    <div class="actionBox">
        <ul class="commentList">
            <?php
            //foreach ($resultArray as $row) {
            //  foreach ($row as $comment) {
            for($i=0; $i<$counter; $i++){
                //echo "<p>" . $comment . "</p>";
                echo "<li>".
                    "<div class='commenterImage'>".
                    "<img src='http://cdn.flaticon.com/png/256/24029.png' />".
                    "</div>".
                    "<div class='commentText'>".
                    "<p>".$resultArray[$comments_index][$i]."</p>"."<span class='date sub-text'>".$resultArray[$user_index][$i]." - ".$resultArray[$date_index][$i]."</span>".

                    "</div>".
                    "</li>";
            }

            ?>
        </ul>

        <form method="post" action="../Controllers/updateDiscussion.php" class="form-inline">
            <div class="form-group">
                <input class="form-control" name="comment" type="text" placeholder="Your comments" />
            </div>
            <input type='hidden' name='eid' value='<?php echo $event_id ?>'>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Add</button>
            </div>
        </form>
    </div>
</div>

<!--Footer-->
<footer>
    <div class="container text-center">
        <p class="pull-left">© Company Name</p>
    </div>
</footer>
<!--Footer-->

</body>
</html>