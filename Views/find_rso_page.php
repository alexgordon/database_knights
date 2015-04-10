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
    $sql = "SELECT UNI.name FROM universities_table UNI WHERE UNI.uni_id = '$uni_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

//GET RSO's
    $sql = "SELECT DISTINCT R.name, R.rso_id FROM rso_table R, rso_member RM WHERE R.rso_id = RM.rso_id AND R.uni_id = '$uni_id'";
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

//GET User's RSO's
    $sql = "SELECT RM.rso_id FROM rso_member RM WHERE RM.user_id = '$user_id'";
    $result = $conn->query($sql);
    $userRSOArray = array();
    $user_counter = 0;
    while($user_rows = $result->fetch_assoc()){

        $userRSOArray[$user_counter] = $user_rows['rso_id'];
        $user_counter++;
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
            <ul class="nav navbar-nav">
                <li>
                    <a href="../Views/find_rso_page.php">Join RSO</a>
                </li>
                <li>
                    <a href="../Views/find_events_page.php">Events</a>
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
    echo "<h2 class='text-center'>".$row['name']."</h2>";
    ?>
    <!--       <div class="row">
               <h4 class="text-center">Please add to the <a href="../Views/forum.php">discussion</a>
               </h4>
           </div>-->
    <hr>
    <div class="row">
        <h3 class="text-center">Join an RSO</h3>
        <div>
            <?php
            for($i = 0; $i<$counter; $i++) {
                $resultCounter = 0;

                for($j = 0; $j < $user_counter; $j++){
                    if($resultArray[$y][$i] == $userRSOArray[$j]){
                        $resultCounter++;
                    }
                }

                if($resultCounter == 0) {
                    echo
                        "<h4 class='text-center'><a href='../Views/user_rso_page.php?rso_id=" . $resultArray[$y][$i] . "'> " . $resultArray[$x][$i] . "</a></h4>";
                }
            }
            ?>
        </div>
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