
<?php

include('../connection.php');

if(isset($_GET["id"]))
{
 $query = "SELECT * FROM books WHERE id = '".$_GET["id"]."'";

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<div class="row">';
 foreach($result as $row)
 {

  $output .= '
  
  <div class="col-md-9">
   <p><label>ISBN :&nbsp;</label>'.$row["isbn"].'</p>
   <p><label>Name :&nbsp;</label>'.$row["bname"].'</p>
   <p><label>Author :&nbsp;</label>'.$row["author"].'</p>
   <p><label>Category :</label>'.$row["category"].'</p>

  </div>
  </div><br />
  ';
 }
 echo $output;
}

?>
