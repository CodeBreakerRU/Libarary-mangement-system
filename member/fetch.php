<?php

include('../connection.php');

$query = '';
$output = array();
$query .= "SELECT * FROM books ";

if(isset($_POST["search"]["value"]))

{
// $query .= 'WHERE bname LIKE "%'.$_POST["search"]["value"].'%" OR author LIKE "%'.$_POST["search"]["value"].'%" OR isbn LIKE "%'.$_POST["search"]["value"].'%" OR category LIKE "%'.$_POST["search"]["value"].'%" OR publisher LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'WHERE bname LIKE "'.$_POST["search"]["value"].'%"';
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();

foreach($result as $row)

{
 $sub_array = array();

 $sub_array[] = $row["id"];
 $sub_array[] = $row["bname"];
 $sub_array[] = $row["author"];
 $sub_array[] = $row["isbn"];
 $sub_array[] = $row["category"];
 $sub_array[] = $row["publisher"];
// $sub_array[] = $row["copies"];
//    $sub_array[] = $row["availablecopies"];

 $sub_array[] = '<button type="button" name="view" id="'.$row["id"].'" class="btn btn-primary btn-xs view">View</button>';

 $data[] = $sub_array;
}

function get_total_all_records($conn)
{
 $statement = $conn->prepare("SELECT * FROM books");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_records($connect),
 "data"    => $data
);
echo json_encode($output);
?>