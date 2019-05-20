<?php
/**
 * Created by PhpStorm.
 * User: Rasika
 * Date: 2/25/2019
 * Time: 7:52 PM
 */
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>
<?php include_once("main-menu.html"); ?>

<!DOCTYPE html>

<head>

    <title>My profile</title>

    <link rel="stylesheet" href="css/bootstrap.css">

    <style>

        body
        {
             text-align: center;
        }
        td{

        }
    </style>

</head>
<body>

    <h3>Hello, <strong> <?php echo htmlspecialchars($_SESSION["username"]); ?> </strong> </h3>

</div>

<?php
    include_once "../connection.php";
    $uname =  htmlspecialchars($_SESSION["username"]);
    $result = mysqli_query($conn,"SELECT * FROM members where  username ='$uname'");

    while($row = mysqli_fetch_array($result))
    {
        echo "<h4> Member ID : <strong> " . $row['username'] . " </strong> </h4>";
        echo "<h4> Name : <strong> " . $row['name'] . " </strong> </h4>";
        echo "<h4> Address : <strong> " . $row['address'] . " </strong> </h4>";
        echo "<h4> Phone : <strong> " . $row['phone'] . " </strong> </h4>";
    }

?>
    <div>
</div>

<p>
    <a href="change.php" class="btn btn-default">Change Your Password</a>
    <a href="logout.php" class="btn btn-default">Sign Out of Your Account</a>
</p>
    <div>
        <a href="../admin" class="btn btn-warning"> Administration </a>

    </div>


</body>
</html>

<?php include_once("../main-footer.html"); ?>

