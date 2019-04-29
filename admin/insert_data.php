
<?php
include('../connection.php');

if(isset($_POST["name"]))
{
    $error = '';
    $success = '';
    $name = '';
    $author= '';
    $isbn =  '';
    $category ='';
    $publisher =  '';
    $copies ='';

    if(empty($_POST["name"]))
    {
        $error .= '<p>Book name is Required</p>';
    }
    else
    {
        $name = $_POST["name"];
    }
    if(empty($_POST["author"]))
    {
        $error .= '<p>Author name is Required</p>';
    }
    else
    {
        $author = $_POST["author"];
    }
    if(empty($_POST["isbn"]))
    {
        $error .= '<p>Isbn no Required</p>';
    }
    else
    {
        $isbn = $_POST["isbn"];
    }
    if(empty($_POST["category"]))
    {
        $error .= '<p>Category is Required</p>';
    }
    else
    {
        $category = $_POST["category"];
    }

    if(empty($_POST["publisher"]))
    {
        $error .= '<p>Publisher name is Required</p>';
    }
    else
    {
        $publisher = $_POST["publisher"];
    }

    if(empty($_POST["copies"]))
    {
        $error .= '<p>Copies no Required</p>';
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
            ':copies'  => $copies
        );

        $query = "
  INSERT INTO books
  (bname, author, isbn, category, publisher, copies) 
  VALUES (:name, :author, :isbn, :category, :publisher, :copies)
  ";

        $statement = $connect->prepare($query);
        $statement->execute($data);
        $success = 'Book Inserted';
    }
    $output = array(
        'success'  => $success,
        'error'   => $error
    );
    echo json_encode($output);
}

?>