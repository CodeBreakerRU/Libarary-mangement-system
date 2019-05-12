
<?php
require_once "../connection.php";
//$query = "SELECT * FROM borrows ORDER BY id DESC";

$query = "SELECT * FROM books b, borrows br, members m WHERE br.bookid = b.id AND m.username = br.memberid";

$result = mysqli_query($conn, $query);
?>
<?php include_once("../main-menu-admin.html"); ?>

<!DOCTYPE html>
<head>
    <title> Borrow Books</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>
</head>
<body>
<br /><br />
<div class="container">

    <h2 align="center"> Borrow Books </h2>
    <div class="table-responsive">
        <div align="right">

            <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add Borrow Books</button>
        </div>
        <br />
        <div id="employee_table">
            <table  class="table table-bordered" >
                <tr>
                    <th >Borrow No</th>
                    <th >Member ID</th>
                    <th >Member Name</th>
                    <th >Book ID</th>
                    <th >Book Name</th>
                    <th > Borrowed Date</th>
                    <th></th>
                </tr>

                <?php
                while($row = mysqli_fetch_array($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $row["brid"]; ?></td>
                        <td><?php echo $row["memberid"]; ?></td>
                        <td ><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["bookid"]; ?></td>
                        <td><?php echo $row["bname"]; ?></td>
                        <td><?php echo $row["borrowed_time"]; ?></td>

                        <td><input type="button" name="delete_data" value="Delete Details" id="<?php echo $row["brid"]; ?>" class="btn btn-danger delete_data" /></td>
                            <!-- btn-xs-->
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
<div id="dataModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Borrow Book Details</h4>
            </div>
            <div class="modal-body" id="employee_detail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">

                    <label>Member ID</label>
                    <input type="text" name="memberId" id="memberId" class="form-control" />
                    <br />

                    <label>Book ID</label>
                    <input type="text" name="bookId" id="bookId" class="form-control"></input>
                    <br />

                    <input type="hidden" name="borrow_id" id="borrow_id" />
                    <input type="submit" name="insert" id="insert" value="insert" class="btn btn-success" />

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#add').click(function(){
            $('#insert').val("Insert");
            $('#insert_form')[0].reset();
        });

        $('#insert_form').on("submit", function(event)
        {
            event.preventDefault();
            if($('#memberId').val() == "")
            {
                alert("Member ID is empty !!");
            }
            else if($('#bookId').val() == '')
            {
                alert("Book ID is empty !!");
            }

            else
            {
                $.ajax(
                    {
                    url:"insert.php",
                    method:"POST",
                    data:$('#insert_form').serialize(),
                    beforeSend:function(){
                        $('#insert').val("Inserting");
                    },
                    success:function(data)
                    {
                        $('#insert_form')[0].reset();
                        $('#add_data_Modal').modal('hide');
                        $('#employee_table').html(data);
                    }
                });
            }
        });


        $(document).on('click', '.delete_data', function()
        {
            var id = $(this).attr('id');

            Dialogify.confirm("<h5 class='text-danger'> <strong > Confirm ?</strong > </h5>",
                {
                    ok:function(){
                        $.ajax({
                            url:"delete.php",
                            method:"POST",
                            data:{id:id},
                            success:function(data)
                            {
                                Dialogify.alert('<h4 class="text-success text-center"> <strong > Record deleted !!</strong > </h4>');
                            }
                        })
                    },
                    cancel:function()
                    {
                        this.close();
                    }
                });
        });
    });



</script>

<?php include_once("../main-footer.html"); ?>