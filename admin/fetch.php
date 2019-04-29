<?php

include('../connection.php');
$query = '';
$output = array();
$query .= "SELECT * FROM books ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE bname LIKE "%'.$_POST["search"]["value"].'%" OR author LIKE "%'.$_POST["search"]["value"].'%" OR isbn LIKE "%'.$_POST["search"]["value"].'%" OR category LIKE "%'.$_POST["search"]["value"].'%" OR publisher LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row["bname"];
 $sub_array[] = $row["author"];
 $sub_array[] = $row["isbn"];
 $sub_array[] = $row["category"];
 $sub_array[] = $row["publisher"];
 $sub_array[] = $row["copies"];
    $sub_array[] = $row["availablecopies"];
 $sub_array[] = '<button type="button" name="view" id="'.$row["id"].'" class="btn btn-primary btn-xs view">View</button>';
 $sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button>';
 $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
 $data[] = $sub_array;
}

function get_total_all_records($connect)
{
 $statement = $connect->prepare("SELECT * FROM books");
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