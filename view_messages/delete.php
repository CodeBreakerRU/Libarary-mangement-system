<?php
/**
 * Created by PhpStorm.
 * User: Rasika
 * Date: 4/20/2019
 * Time: 11:03 PM
 */

include('../connection.php');

if(isset($_POST["id"]))
{
    $query = "
 DELETE FROM contact 
 WHERE message_id = '".$_POST["id"]."'
 ";
    $statement = $connect->prepare($query);
    $statement->execute();
}

?>