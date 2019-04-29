<?php
require("../connection.php");

//$db = new mysqli("localhost", "admin", "toor", "labs");

if ($conn->connect_errno)
{
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

$query="SELECT * FROM chat ORDER BY id ASC";

if ($conn->real_query($query))
{
    $res = $conn->use_result();

    while ($row = $res->fetch_assoc())
    {
        $username=$row["username"];
        $text=$row["text"];
        $time=date('d-M-y G:i', strtotime($row["time"]));

        echo "<p>$time | <strong>$username: </strong> $text</p>\n";
    }
}
else
{

    echo "An error occured";
    echo $conn->errno;
}

$conn->close();
?>