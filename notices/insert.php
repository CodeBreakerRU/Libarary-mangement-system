<?php

include "../connection.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $topic = $_POST['topic'];
    $content = $_POST['content'];


    $query = "INSERT INTO notices (topic, content) VALUES ('$topic', '$content')";

if(mysqli_query($conn, $query))
{
    $mess = "Records added successfully.";
    echo "<script type='text/javascript'>alert('$mess');</script>";
    header("location: index.php");

}
else
{
    echo " error :/ ";
}



?>