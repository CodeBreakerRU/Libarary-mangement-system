
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
   <p><label>ISBN :&nbsp;</label> <span style="color: green"> '.$row["isbn"].'</>
   <p><label>Name :&nbsp;</label> <span style="color: green"> '.$row["bname"].'</p>
   <p><label>Author :&nbsp;</label> <span style="color: green"> '.$row["author"].'</p>
   <p><label>Category :</label> <span style="color: green"> '.$row["category"].'</p>
   <p><label>No of Available Copies :</label> <span style="color: green"> '.$row["availablecopies"].'</p>

  </div>
  </div><br />
  ';
 }
 echo $output;
}

?>
