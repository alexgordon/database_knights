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

/*//GET RSO's
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

    }*/

//GET Public Events
   // $sql = "SELECT E.* FROM events_table E";
    $sql= "SELECT E.*,UNI.uni_name FROM events_table E INNER JOIN rso_table R ON E.rso_id=R.rso_id INNER JOIN universities_table UNI ON R.uni_id = UNI.uni_id";
    $result = $conn->query($sql);
    $resultArray = array();
    $counter = 0;
    $x = 0;
    $y = 1;
    $z = 2;
    $location_pointer = 3;
    $time_pointer = 4;
    $uniName_pointer = 5;

    while($rows = $result->fetch_assoc()) {

        $resultArray[$x][$counter] = $rows['e_name'];
        $resultArray[$y][$counter] = $rows['event_id'];
        $resultArray[$z][$counter] = $rows['privateEvent'];
        $resultArray[$location_pointer][$counter] = $rows['location'];
        $resultArray[$time_pointer][$counter] = $rows['time'];
        $resultArray[$uniName_pointer][$counter] = $rows['uni_name'];
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
<script src="../Assets/Scripts/jquery.dataTables.min.js"></script>
<script src="../Assets/Scripts/initTable.js"></script>
<link rel="stylesheet" href="../Assets/Styles/bootstrap.min.css">
<link rel="stylesheet" href="../Assets/Styles/bootstrap-theme.min.css">
<link rel="stylesheet" href="../Assets/Styles/home_styles.css">
<link rel="stylesheet" href="../Assets/Styles/jquery.dataTables.css">
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
    <div>
        <h3 class="text-center">Private Events</h3>
        <table class="table table-bordered" id="example">
            <thead>
                <tr>
                    <th class='text-center'>Name</th>
                    <th class='text-center'>Location</th>
                    <th class='text-center'>Date</th>
                    <th class='text-center'>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php


                for($i = 0; $i<$counter; $i++) {
                    if($resultArray[$z][$i] == "Private" && $row['uni_name'] == $resultArray[$uniName_pointer][$i]) {
                        $event_day = date("l F j, Y", strtotime($resultArray[$time_pointer][$i]));
                        $event_time = date("g:i A", strtotime($resultArray[$time_pointer][$i]));
                        echo
                            "<tr>
                                <td class='text-center'><a href='../Views/event_detail_page.php?eid=" . $resultArray[$y][$i] . "'> " . $resultArray[$x][$i] . "</a></td>
                                <td class='text-center'>".$resultArray[$location_pointer][$i]."</td>
                                <td class='text-center'>".$event_day."</td>
                                <td class='text-center'>".$event_time."</td>
                            </tr>";
                            //"<h4 class='text-center'><a href='../Views/event_detail_page.php?eid=" . $resultArray[$y][$i] . "'> " . $resultArray[$x][$i] . "</a></h4>";
                    }
                }
                ?>
            </tbody>
        </table>
<!--        <div>
            <?php
/*            for($i = 0; $i<$counter; $i++) {
                if($resultArray[$z][$i] == "Private") {
                    echo
                        "<h4 class='text-center'><a href='../Views/event_detail_page.php?eid=" . $resultArray[$y][$i] . "'> " . $resultArray[$x][$i] . "</a></h4>";
                }
            }
            */?>-->
        </div>
    <hr>

    <div>
        <h3 class="text-center">Public Events</h3>
        <table class="table table-bordered" id="example2">
            <thead>
                <tr>
                    <th class="text-center">Host University</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Location</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i = 0; $i<$counter; $i++) {
                    if($resultArray[$z][$i] == "Public") {
                        $event_day = date("l F j, Y", strtotime($resultArray[$time_pointer][$i]));
                        $event_time = date("g:i A", strtotime($resultArray[$time_pointer][$i]));
                        echo
                            "<tr>
                                <td class='text-center'>".$resultArray[$uniName_pointer][$i]."</td>
                                <td class='text-center'><a href='../Views/event_detail_page.php?eid=" . $resultArray[$y][$i] . "'> " . $resultArray[$x][$i] . "</a></td>
                                <td class='text-center'>".$resultArray[$location_pointer][$i]."</td>
                                <td class='text-center'>".$event_day."</td>
                                <td class='text-center'>".$event_time."</td>
                            </tr>";
                        //"<h4 class='text-center'><a href='../Views/event_detail_page.php?eid=" . $resultArray[$y][$i] . "'> " . $resultArray[$x][$i] . "</a></h4>";
                    }
                }
                ?>
            </tbody>
        </table>
<!--        <div>
            <?php
/*            for($i = 0; $i<$counter; $i++) {
                if($resultArray[$z][$i] == "Public") {
                    echo
                        "<h4 class='text-center'><a href='../Views/event_detail_page.php?eid=" . $resultArray[$y][$i] . "'> " . $resultArray[$x][$i] . "</a></h4>";
                }
            }
            */?>
        </div>-->
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