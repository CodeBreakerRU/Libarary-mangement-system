<?php
/**
 * Created by PhpStorm.
 * User: Rasika
 * Date: 4/11/2019
 * Time: 11:02 PM
 */

include_once  "../connection.php";

$query = "SELECT * FROM borrows where status ='borrowed' ORDER BY memberid ASC";
$result = mysqli_query($conn, $query);
$output = array();
while($row = mysqli_fetch_assoc($result))
{
    $output[] = $row;
}
echo json_encode($output);
?>