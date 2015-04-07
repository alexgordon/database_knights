<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 3/22/2015
 * Time: 10:57 PM
 */


session_start();

if($_SESSION['user_id'] == null){
    header('Location: ../Views/homepage.html');
}

else{
    $servername = "localhost";
    $username = "root";
    $password = "";
//    $dbname = "sandbox";
    $dbname = "database_knights";

//Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }

//GET comments
    $sql = "SELECT * From universities_table";
    $result = $conn->query($sql);
    $resultArray = array();
    $dateArray = array();
    $counter = 0;
    $x=0;
    $y=1;
    $two = 2;
    $three = 3;
    while($rows = $result->fetch_assoc()){
        //   $resultArray[$rows['comment']][$counter] = $rows['comment'];
        //   $dateArray[$rows['commentDate']][$counter] = $rows['commentDate'];
        $resultArray[$x][$counter] = $rows['name'];
        $resultArray[$y][$counter] = $rows['location'];
        $resultArray[$two][$counter] = $rows['description'];
        $resultArray[$three][$counter] = $rows['num_students'];
        $counter++;
    }

//GET RSO's
    $sql = "SELECT R.*, U.email FROM rso_table R INNER JOIN users_table U ON R.admin=U.user_id Inner Join rso_pending RP ON R.rso_id = RP.rso_id";
    $result = $conn->query($sql);
    $rsoArray = array();
    $rsoCounter = 0;
    while($rows = $result->fetch_assoc()){

        $rsoArray[$x][$rsoCounter] = $rows['name'];
        $rsoArray[$y][$rsoCounter] = $rows['email'];
        $rsoArray[$two][$rsoCounter] = $rows['rso_id'];
        $rsoCounter++;
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
            <a href="super_admin_homepage.php" class="navbar-brand">Compnay Name</a>
        </div>
        <div class="navbar-collapse collapse">
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
<!--    --><?php
/*    echo "<h3 class='text-center'>Welcome Super Admin " . $_SESSION["firstName"] . " " . $_SESSION["lastName"]."</h3>";
    */?>
    <div class="row">
        <h3 class="text-center">Current Universities</h3>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <th class="text-center">University</th>
                <th class="text-center">Location</th>
                <th class="text-center">Description</th>
                <th class="text-center">Number of Students</th>
            </tr>
            <?php
                for($i=0; $i<$counter; $i++) {
                    echo
                        "<tr>
                            <td class='text-center'>".$resultArray[$x][$i]."</td>
                            <td class='text-center'>".$resultArray[$y][$i]."</td>
                            <td class='text-center'>".$resultArray[$two][$i]."</td>
                            <td class='text-center'>".$resultArray[$three][$i]."</td>
                        </tr>";
                    }
            ?>
        </table>
    </div>
    <div class="row">
        <h3 class="text-center">Add New University</h3>
        <form action="../Controllers/createUniversity.php" method="post">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="form-group">
                    <label for="uName" class="control-label">University Name</label>
                    <input type="text" name="uName" id="uName" placeholder="University Name" autofocus class="form-control">
                </div>
                <div class="form-group">
                    <label for="location" class="control-label">Location</label>
                    <input type="text" name="location" id="location" placeholder="Location" autofocus class="form-control">
                </div>
                <div class="form-group">
                    <label for="description" class="control-label">Description</label>
                    <textarea type="comment" name="description" id="description" placeholder="Description" autofocus class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block">
                        Create University
                    </button>
                </div>
            </div>
        </form>
    </div>
    <hr class="row">
    <div class="row">
        <h3 class="text-center">RSO Applications</h3>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <th class='text-center'>RSO</th>
                <th class='text-center'>Admin</th>
                <th class='text-center'>Accept Application</th>
                <th class='text-center'>Decline Application</th>
            </tr>
            <?php
                //Add rows with data from database
                for($i=0; $i < $rsoCounter; $i++){
                    echo
                        "<tr>
                            <td class='text-center'>".$rsoArray[$x][$i]."</td>
                            <td class='text-center'>".$rsoArray[$y][$i]."</td>
                            <td><form action='../Controllers/rsoAcceptButton.php' method='post'>
                                    <button class='btn btn-block' type='submit'> Accept </button>
                                    <input name='rso_id' type='hidden' value='".$rsoArray[$two][$i]."'>
                                </form>
                            </td>
                            <td><form action='../Controllers/rsoDeclineButton.php' method='post'>
                                    <button class='btn btn-block' type='submit'> Decline </button>
                                    <input name='rso_id' type='hidden' value='".$rsoArray[$two][$i]."'>
                                </form>
                            </td>
                        </tr>";
                }
            ?>
        </table>
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