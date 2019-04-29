<?php
include('../connection.php');

if(isset($_POST["id"]))
{
 $query = "
 DELETE FROM books 
 WHERE id = '".$_POST["id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>