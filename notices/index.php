<?php

include "../connection.php";
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

if ($_SESSION["username"] !== 'admin')
{
    header("location: ../auth/error_page.php");
}
?>
<?php include_once("../main-menu.html"); ?>

<html>
    <head>
        <title> Notices </title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    </head>

<body>

<div class="container">
    <h3 align="center "> Notices </h3>

    <form action="insert.php" method="post">

        <div class="form-group  col-sm-10">
            <label for="topic"> Topic </label>
            <input type="text" class="form-control" id="topic" placeholder=" Attention " name="topic" required>
        </div>

        <div class="form-group col-sm-10">
            <label for="comment"> Message </label>
            <textarea class="form-control" rows="5" id="content" name="content" required ></textarea>
        </div>

        <div class="form-group  col-sm-10 ">
        <button type="submit" class="btn btn-primary"> Submit </button>
        </div>

    </form>

</div>

</body>


</html>

<?php include_once("../main-footer.html"); ?>
