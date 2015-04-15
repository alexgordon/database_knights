<?php
/**
 * Created by PhpStorm.
 * User: alexgordon
 * Date: 4/5/2015
 * Time: 11:21 PM
 */
$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "sandbox";
$dbname = "database_knights";

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

$sql = "SELECT U.uni_name FROM universities_table U";

//GET Universities
$result = $conn->query($sql);
$resultArray = array();
$counter = 0;

while($rows = $result->fetch_assoc()){
    //   $resultArray[$rows['comment']][$counter] = $rows['comment'];
    //   $dateArray[$rows['commentDate']][$counter] = $rows['commentDate'];
    $resultArray[$counter] = $rows['uni_name'];
    $counter++;
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
            <a href="homepage.html" class="navbar-brand">Database Knights</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="login_page.html">Login</a>
                </li>
                <li>
                    <a href="createAccount_page.php">Create Account</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--Header-->

<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h3 class="text-center">Create Account</h3>
            </div>
        </div>

        <form action="../Controllers/createUser.php" method="post">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="form-group">
                    <label for="fName" class="control-label">First Name</label>
                    <input type="text" name="fName" id="fName" placeholder="First Name" autofocus class="form-control">
                </div>
                <div class="form-group">
                    <label for="lName" class="control-label">Last Name</label>
                    <input type="text" name="lName" id="lName" placeholder="Last Name" autofocus class="form-control">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" autofocus class="form-control">
                </div>
                <div class="form-group">
                    <label for="pass" class="control-label">Password</label>
                    <input type="password" name="pass" id="pass" placeholder="Password" autofocus class="form-control">
                </div>
                <div class="form-group">
                    <label for="confPass" class="control-label">Confirm Password</label>
                    <input type="password" name="confPass" id="confPass" placeholder="Confirm Password" autofocus class="form-control">
                </div>
                <div class="form-group">
                    <label for="uName" class="control-label">University</label>
                    <select name="uName" id="uName" autofocus class="form-control">
                        <?php
                        for($i = 0; $i < $counter; $i++) {
                            echo
                                "<option>" . $resultArray[$i] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block">
                        Create Account
                    </button>
                </div>
            </div>
        </form>
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