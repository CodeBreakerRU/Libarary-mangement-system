<?php
/**
 * Created by PhpStorm.
 * User: Rasika
 * Date: 4/11/2019
 * Time: 11:03 PM
 */

include_once "../connection.php";

$query = " UPDATE borrows SET ".$_POST["name"]." = '".$_POST["value"]."' WHERE brid = '".$_POST["pk"]."'";
mysqli_query($conn, $query);


//$b_count1 = "SELECT availablecopies FROM books WHERE id = '$bookId'";
//
//$result = mysqli_query($conn,$b_count1);
//while ($row = mysqli_fetch_array($result)) {
//
//    $b_tot = $row['availablecopies'] + 1;
//    $new_tot = "UPDATE books SET availablecopies = '$b_tot' where id = '$bookId'";
//
//}
//
//if(mysqli_query($conn, $new_tot))
//{
//    echo " Inserted ";
//}
?>