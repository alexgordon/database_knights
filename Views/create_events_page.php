<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 3/22/2015
 * Time: 10:57 PM
 */


session_start();

if($_SESSION['user_id'] == null || $_SESSION['privilege_status'] != "student"){
    header('Location: ../Views/homepage.html');
}

else{

    $servername = "localhost";
    $username = "root";
    $password = "";
//    $dbname = "sandbox";
    $dbname = "database_knights";

    $uni_id = $_SESSION['uni_id'];
    $user_id = $_SESSION['user_id'];

//Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }

//GET University
    $sql = "SELECT UNI.uni_name FROM universities_table UNI WHERE UNI.uni_id = '$uni_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

//GET RSO's
    $sql = "SELECT R.name, R.rso_id FROM rso_table R, rso_member RM WHERE R.rso_id = RM.rso_id AND RM.user_id = '$user_id'";
    $result = $conn->query($sql);
    $resultArray = array();
    $counter = 0;
    $x = 0;
    $y = 1;
    while($rows = $result->fetch_assoc()) {

        $resultArray[$x][$counter] = $rows['name'];
        $resultArray[$y][$counter] = $rows['rso_id'];
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
                    <a href="#">Profile</a>
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
    echo "<h2 class='text-center'>".$row['uni_name']."</h2>";
    ?>

    <hr>
    <h3 class='text-center'>Create Event</h3>
    <form action='../Controllers/createNonRsoEvent.php' method='post'>
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
                    <option>Private</option>
                    <option>Public</option>
                </select>
            </div>
            <input type="hidden" value='<?php echo $uni_id ?>' name="uni_id">
            <div class='form-group'>
                <button type='submit' class='btn btn-block btn-custom-gold'>
                    Create Event
                </button>
            </div>
        </div>
    </form>

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