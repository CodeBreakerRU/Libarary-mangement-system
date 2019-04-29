
<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require("../connection.php");

//$db = new mysqli("localhost", "admin", "toor", "labs");
if ($conn->connect_errno) {

    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

$username=substr($_SESSION["username"], 0, 32);

$text=substr($_GET["text"], 0, 128);

$nameEscaped = htmlentities(mysqli_real_escape_string($conn,$username));
$textEscaped = htmlentities(mysqli_real_escape_string($conn, $text));

$query="INSERT INTO chat (username, text) VALUES ('$nameEscaped', '$textEscaped')";

if ($conn->real_query($query))
{
    echo " :) ";
}
else
{
    echo " error :/ ";
    echo $db->errno;
}

$db->close();
?>
