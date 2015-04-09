<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 3/22/2015
 * Time: 10:57 PM
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

    $rso_id = $_GET['rso_id'];

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

//GET RSO
    $sql = "SELECT R.* FROM rso_table R WHERE R.rso_id = '$rso_id'";
    $result = $conn->query($sql);
    $resultArray = array();
    $counter = 0;
    $x = 0;
    $y = 1;
    while($rows = $result->fetch_assoc()) {

        $resultArray[$x] = $rows['name'];
        $resultArray[$y] = $rows['admin'];
        //$counter++;

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

    if($resultArray[$y] == $_SESSION['user_id'])
        echo "<h3 class='text-center'>".$resultArray[$x]." - Admin</h3>";
    else
        echo "<h3 class='text-center'>".$resultArray[$x]."</h3>";
    ?>
    <hr>
    <h3 class="text-center">Current Events</h3>
    <?php
        $sql = "SELECT E.* FROM events_table E WHERE E.rso_id = '$rso_id'";
        $event_result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($event_result)) {
            $eName = $row['name'];
            $eLocation = $row['location'];
            $time = $row['time'];
            $desc = $row['description'];
            $eid = $row['event_id'];
            echo
                "<h4 class='text-center'><a href='event_detail_page.php?eid=$eid'>$eName</a></h4>
                <h5 class='text-center'>$eLocation</h5>
                <div class='text-center'>
                    $time <br>
                    $desc
                </div>
            ";
        }

    ?>

    <?php
        if($resultArray[$y] == $_SESSION['user_id'])
            echo
                "<hr>
                <h3 class='text-center'>Create Event</h3>
                <form action='../Controllers/createRsoEvent.php' method='post'>
                    <div class='col-sm-4 col-sm-offset-4'>
                        <div class='form-group'>
                            <label for='eName' class='control-label'>Event Name</label>
                            <input type='text' name='eName' id='eName' placeholder='Event Name' autofocus class='form-control' required>
                        </div>
                        <div class='form-group'>
                            <label for='location' class='control-label'>Location</label>
                            <input type='text' name='location' id='location' placeholder='Location' autofocus class='form-control' required>
                        </div>
                        <div class='form-group'>
                            <label for='time' class='control-label'>Event Time</label>
                            <input type='datetime-local' name='time' id='time' autofocus class='form-control' required>
                        </div>
                        <div class='form-group'>
                            <label for='description' class='control-label'>Event Description</label>
                            <textarea rows='2' maxlength='250' name='description' id='description' placeholder='Description... (Max 250 characters)' autofocus class='form-control' ></textarea>
                        </div>
                        <div class='form-group'>
                            <label for='description' class='control-label'>Event Type</label>
                            <select name='eType' id='eType' autofocus class='form-control'>
                                <option>RSO Event</option>
                                <option>Private</option>
                                <option>Public</option>
                            </select>
                        </div>
                        <input type='hidden' name='rso' value='$rso_id'>
                        <div class='form-group'>
                            <button type='submit' class='btn btn-block'>
                                Create Event
                            </button>
                        </div>
                    </div>
                </form>
                ";
    ?>

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