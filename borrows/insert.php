
<?php

require_once "../connection.php";

if(!empty($_POST))
{
    $b_tot = '';
    $output = '';
    $message = '';
    $memberId = mysqli_real_escape_string($conn, $_POST["memberId"]);
    $bookId = mysqli_real_escape_string($conn, $_POST["bookId"]);

        $query = "
           INSERT INTO borrows(memberid, bookid, returned_time, status)
           VALUES('$memberId', '$bookId', 'null', 'BORROWED');
           ";

        $b_count1 = "SELECT availablecopies FROM books WHERE id = '$bookId'";


    $result = mysqli_query($conn,$b_count1);
    while ($row = mysqli_fetch_array($result)) {

        $b_tot = $row['availablecopies'] - 1;
       $new_tot = "UPDATE books SET availablecopies = '$b_tot' where id = '$bookId'";

    }

    if(mysqli_query($conn, $new_tot))
    {
        echo " Inserted ";
    }

    if(mysqli_query($conn, $query))
    {
        echo " Successful !!";
    }

    echo $output;
}
?>