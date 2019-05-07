<?php

include "../connection.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $name = $_POST['username'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    $query = "INSERT INTO contact (username, title ,email ,message) VALUES ('$name','$title','$email','$message')";

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