<?php
/**
 * Created by PhpStorm.
 * User: IM22
 * Date: 17-Apr-19
 * Time: 23:04
 */

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "../../connection.php";
$uname =  htmlspecialchars($_SESSION["username"]);
$output = array();

$query = "SELECT * from borrows br, members m , books b WHERE br.bookid = b.id AND br.memberid = m.username AND m.username = '$uname'";

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
?>