<?php
include('../connection.php');

if(isset($_POST["name"]))
{
 $error = '';
 $success = '';

 $name = '';
 $author = '';
 $isbn = '';
 $category ='';
 $publisher = '';
 $copies = '';

 if(empty($_POST["name"]))
 {
  $error .= '<p>Name is Required</p>';
 }
 else
 {
  $name = $_POST["name"];
 }


 if(empty($_POST["author"]))
 {
  $error .= '<p>Author is Required</p>';
 }
 else
 {
  $author = $_POST["author"];
 }


 if(empty($_POST["isbn"]))
 {
  $error .= '<p>ISBN is Required</p>';
 }
 else
 {
  $isbn= $_POST["isbn"];
 }


if(empty($_POST["category"]))
 {
  $error .= '<p> Select a category</p>';
 }
 else
 {
  $category = $_POST["category"];
 }


 if(empty($_POST["publisher"]))
 {
  $error .= '<p>Publisher is Required</p>';
 }
 else
 {
  $publisher = $_POST["publisher"];
 }


 if(empty($_POST["copies"]))
 {
  $error .= '<p>No of copies is Required</p>';
 }
 else
 {
  $copies = $_POST["copies"];

 }

 if($error == '')
 {
  $data = array(
   ':name'   => $name,
   ':author'  => $author,
   ':isbn'  => $isbn,
   ':category' => $category,
   ':publisher'   => $publisher,
   ':copies'  => $copies,
   ':id'   => $_POST["id"]
  );

  $query = "

UPDATE books SET bname = :name, author =:author, isbn =:isbn, category = :category, publisher = :publisher, copies = :copies WHERE id = :id

  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
  $success = 'Book Info Updated!!';
 }
 $output = array(
  'success'  => $success,
  'error'   => $error
 );
 echo json_encode($output);
}

?>

