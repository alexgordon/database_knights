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

    $nre_id = $_GET['nre_id'];

//Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }


//GET event details
    $sql = "SELECT NRE.* FROM non_rso_events_table NRE WHERE NRE.nre_id = '$nre_id'";
    $event_result = $conn->query($sql);
    $event_row = $event_result->fetch_assoc();

    $event_uni_id = $event_row['uni_id'];
    $event_user_id = $event_row['nre_user_id'];

//Get User Info
    $sql = "SELECT U.* FROM users_table U WHERE U.user_id = '$event_user_id'";
    $user_result = $conn->query($sql);
    $user_row = $user_result->fetch_assoc();

//GET University
    $sql = "SELECT UNI.uni_name FROM universities_table UNI WHERE UNI.uni_id = '$event_uni_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();


/*    //$rso = $event_row['rso_id'];

//GET RSO name
    $sql = "SELECT R.name FROM rso_table R WHERE R.rso_id = '$rso'";
    $rso_result = $conn->query($sql);
    $rso_row = $rso_result->fetch_assoc();*/

//GET comments
    $sql = "SELECT R.comments, R.reviewDate, R.rating, U.firstName, U.lastName,U.user_id
            FROM reviews_table R, users_table U
            WHERE R.nre_id='$nre_id' AND R.user_id = U.user_id";
    $result = $conn->query($sql);
    $resultArray = array();
    $dateArray = array();
    $counter = 0;
    $comments_index=0;
    $date_index=1;
    $user_index=3;
    $rating_index=4;
    $userId_index = 5;
    while($rows = $result->fetch_assoc()){
        //   $resultArray[$rows['comment']][$counter] = $rows['comment'];
        //   $dateArray[$rows['commentDate']][$counter] = $rows['commentDate'];
        $resultArray[$comments_index][$counter] = $rows['comments'];
        $resultArray[$date_index][$counter] = $rows['reviewDate'];
        $resultArray[$user_index][$counter] = $rows['firstName']." ".$rows['lastName'];
        $resultArray[$rating_index][$counter] = $rows['rating'];
        $resultArray[$userId_index][$counter] = $rows['user_id'];
        $counter++;
    }

}

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>DB Knights</title>
</head>
<body>

<!--Scripts and Styles-->
<script src="../Assets/Scripts/jquery-2.1.3.min.js"></script>
<script src="../Assets/Scripts/bootstrap.min.js"></script>
<link rel="stylesheet" href="../Assets/Styles/bootstrap.min.css">
<link rel="stylesheet" href="../Assets/Styles/bootstrap-theme.min.css">
<link rel="stylesheet" href="../Assets/Styles/home_styles.css">

<div id="fb-root"></div>
<script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>

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
            <a href="user_homepage.php" class="navbar-brand">Database Knights</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">RSO<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="../Views/find_rso_page.php">Join RSO</a>
                        </li>
                        <li>
                            <a href="../Views/create_rso_page.php">Create RSO</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Events <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="../Views/find_events_page.php">View Events</a>
                        </li>
                        <li>
                            <a href="../Views/create_events_page.php">Create Events</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="../Views/update_profile_page.php">Profile</a>
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
    <div class="row">
        <?php
        echo "<h2 class='text-center'>".$row['uni_name']."</h2>";

        echo "<h3 class='text-center'>".$event_row['nre_name']."</b></h3>";

        ?>
        <hr>
    </div>
    <div class="row">
        <div class="col-sm-4">
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
                        for($i=0; $i<$counter; $i++) {
                            //echo "<p>" . $comment . "</p>";
                            echo "<li>" .
                                "<div class='commenterImage'>" .
                                "<img src='http://cdn.flaticon.com/png/256/24029.png' />" .
                                "</div>" .
                                "<div class='commentText'>";
                            if ($resultArray[$rating_index][$i] == 5) {
                                echo "<p>&#10029 &#10029 &#10029 &#10029 &#10029</p>";
                            }
                            else if ($resultArray[$rating_index][$i] == 4) {
                                echo "<p>&#10029 &#10029 &#10029 &#10029 &#10025</p>";
                            }
                            else if ($resultArray[$rating_index][$i] == 3) {
                                echo "<p>&#10029 &#10029 &#10029 &#10025 &#10025</p>";
                            }
                            else if ($resultArray[$rating_index][$i] == 2) {
                                echo "<p>&#10029 &#10029 &#10025 &#10025 &#10025</p>";
                            }
                            else if ($resultArray[$rating_index][$i] == 1) {
                                echo "<p>&#10029 &#10025 &#10025 &#10025 &#10025</p>";
                            }

                            echo "<p>". $resultArray[$comments_index][$i] ."</p>";
                            if($resultArray[$userId_index][$i] != $user_id){
                                echo "<span class='date sub-text'><a href='../Views/view_profile_page.php?user_id=".$resultArray[$userId_index][$i]."'>" . $resultArray[$user_index][$i] . "</a> - " . $resultArray[$date_index][$i] . "</span>";
                            }
                            else{
                                echo "<span class='date sub-text'><a href='../Views/update_profile_page.php'>" . $resultArray[$user_index][$i] . "</a> - " . $resultArray[$date_index][$i] . "</span>";
                            }

                            echo "</div>".
                                 "</li>";
                        }

                        ?>
                    </ul>

                    <form method="post" action="../Controllers/updateDiscussion.php" class="form-inline">

                        <div class="form-control-static">
                            <?php
                            if (strtotime($event_row['nre_time']) < time()) {
                                echo "<label for='rating' class='control-label'>Rating</label>
                    <select class='form-control'name='rating'id='rating'>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>";
                            }
                            ?>
                            <input class="form-control" name="comment" type="text" placeholder="Your comments" />
                        </div>
                        <input type='hidden' name='nre_id' value='<?php echo $nre_id ?>'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Add</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <?php
            $event_day = date("l F j, Y", strtotime($event_row['nre_time']));
            $event_time = date("g:i A", strtotime($event_row['nre_time']));

            $location = $event_row['nre_location'];
            $map_location = str_replace(' ', '+',$location );

            echo "
              <h3 class='text-left'>Details</h3><hr>
              <h4 class='text-left'><b>Primary Contact:</b> ".$user_row['firstName']." ".$user_row['lastName']." - <a href='mailto:".$user_row['email']."?Subject=I%20Have%20A%20Question%20About%20".$event_row['nre_name']."'>".$user_row['email']."</a></h4>
              <h4 class='text-left'><b>When: </b>$event_day at $event_time</h4>
              <h4 class='text-left'><b>Location: </b>".$event_row['nre_location']."</h4>
              <h4 class='text-left'><b>Rating: </b>".$event_row['nre_rating']." - From ".$event_row['nre_rating_count']." reviews</h4>
              <div style='height:8px'></div>
              <h4 class='text-left'><b>Description: </b>".$event_row['nre_description']."</h4>
              </div>
              <div class='col-sm-3'>
              <div style='height:46px'></div>
              <h4 class='text-center'><b>Map</b></h4>
              <img class='center-block img-responsive mapBorder' border='0' src='https://maps.googleapis.com/maps/api/staticmap?center=".$map_location."&zoom=14&size=200x200&markers=color:blue%7Clabel:S%7C".$map_location."'>
              <center><div class='fb-share-button' data-href='http://localhost:63342/database_knights/Views/event_detail_page.php?nre_id=$nre_id' data-layout='button_count'></div>
              <div class='g-plus' data-action='share' data-annotation='bubble'></div></center>
              </div>";

            ?>
        </div>
    </div>



</div>


<!--Footer-->
<footer>
    <div class="container text-center">
        <p class="text-center">COT 4710 • University of Central Florida • Dr. Kien Hua</p>
    </div>
</footer>
<!--Footer-->

</body>
</html>