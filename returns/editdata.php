<?php

include "../connection.php";
$new_tot = '';
if (isset($_GET['brid']));

$query = "SELECT * FROM borrows br, books b WHERE br.brid = '".$_GET["brid"]."'";
$result = mysqli_query($conn, $query);

$return = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {

    $borrowid = $_POST['bid'];
    $returned_time = $_POST['returned_time'];
    $status = $_POST['status'];

//        echo "$returned_time";
//        echo  "$status";
//        echo "$borrowid";

    $query2 = "UPDATE borrows SET returned_time = '$returned_time', status = '$status'  WHERE brid =$borrowid";
    mysqli_query($conn, $query2);


    $bookId = $_POST['bookid'];
    $b_count1 = "SELECT availablecopies FROM books WHERE id = '$bookId'";
    $result = mysqli_query($conn,$b_count1);


    while ($row = mysqli_fetch_array($result)) {

        $b_tot = $row['availablecopies'] + 1;
        $new_tot = "UPDATE books SET availablecopies = '$b_tot' where id = '$bookId'";

    }

    if(mysqli_query($conn, $new_tot))
    {
        header("location: index.php?");
    }



}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title> </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<form method="post" action="editdata.php" role="form">
	<div class="modal-body">

        <div class="form-group">
            <label for="id">Borrow ID</label>
            <input type="text" class="form-control" id="bid" name="bid" value="<?php echo $return['brid'];?>" readonly/>
        </div>

		<div class="form-group">
			<label for="id">Member ID</label>
			<input type="text" class="form-control" id="memberid" name="memberid" value="<?php echo $return['memberid'];?>" disabled/>
		</div>

		<div class="form-group">
			<label for="name"> Book ID </label>
			<input type="text" class="form-control" id="bookid" name="bookid" value="<?php echo $return['bookid'];?>" readonly/>
		</div>

		<div class="form-group">
			<label for="phone"> Book Name </label>
				<input type="text" class="form-control" id="bname" name="bname" value="<?php echo $return['bname'];?>" disabled/>
		</div>

		<div class="form-group">
			<label for="address">Returned Date</label>
			<input type="date" class="form-control" id="returned_time" name="returned_time"  />

		</div>

        <div class="form-group">
        <label for="status"> Status </label>
        <select name="status" id="status" class="form-control" >
            <option value="empty"> </option>
            <option value="BORROWED"> Borrowed </option>
            <option value="RETURNED"> Returned </option>
        </select>
         </div>


		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</form>
</body>
</html>

