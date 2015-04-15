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
    $sql = "SELECT R.comments, R.reviewDate From reviews_table R";
    $result = $conn->query($sql);
    $resultArray = array();
    $dateArray = array();
    $counter = 0;
    $x=0;
    $y=1;
    while($rows = $result->fetch_assoc()){
     //   $resultArray[$rows['comment']][$counter] = $rows['comment'];
     //   $dateArray[$rows['commentDate']][$counter] = $rows['commentDate'];
        $resultArray[$x][$counter] = $rows['comments'];
        $resultArray[$y][$counter] = $rows['reviewDate'];
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
            <a href="user_homepage.php" class="navbar-brand">Database Knights</a>
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

<!--<div class="container-fluid">
    <div class="row">
        <h3 class="text-center">Discussion</h3>
    </div>
    <div class="row">
        <?php
/*            foreach ($resultArray as $row) {
                foreach ($row as $comment) {
                    echo "<p>" . $comment . "</p>";
                }
            }
        */?>
    </div>
    <div>
        <form method="post" action="../Controllers/updateDiscussion.php">
            <textarea name="comment" rows="5" class="autogrow"></textarea>
            <input type="submit">
        </form>
    </div>
</div>-->

<!--Disccussion-->
<div class="detailBox">
    <div class="titleBox text-center">
        <label>Comment Box</label>
        <button type="button" class="close" aria-hidden="true">&times;</button>
    </div>
    <div class="commentBox">

        <p class="taskDescription">Please write your comments about how you like this boilerplate website.</p>
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
                        "<p>".$resultArray[$x][$i]."</p>"."<span class='date sub-text'>".$resultArray[$y][$i]."</span>".

                    "</div>".
                "</li>";
                }

            ?>
        </ul>

        <form method="post" action="../Controllers/updateDiscussion.php" class="form-inline">
            <div class="form-group">
                <input class="form-control" name="comment" type="text" placeholder="Your comments" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Add</button>
            </div>
        </form>
    </div>
</div>

<!---->

<!--Footer-->
<footer>
    <div class="container text-center">
        <p class="text-center">COT 4710 • University of Central Florida • Dr. Kien Hua</p>
    </div>
</footer>
<!--Footer-->

</body>
</html>