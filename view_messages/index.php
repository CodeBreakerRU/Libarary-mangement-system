<?php

require_once "../connection.php";

$query = "SELECT * FROM contact c, members m WHERE c.username = m.username";
$result = mysqli_query($conn, $query);
?>
<?php include_once("../main-menu-admin.html"); ?>
<!DOCTYPE html>
<head>

    <title> View Messages </title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>

</head>
<body>
<br /><br />

<h2 align="center"> View Messages </h2>

<div class="container">
    <div class="row">
        <div id="member" class="col-lg-12">

            <div align="right">
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder=" Search by member ID " >
            </div>
    <br />
            <table class="table table-striped table-bordered"  id="myTable" >
                <thead>
                <tr>
                    <th> Contact ID </th>
                    <th> Username </th>
                    <th> Name </th>
                    <th> Title </th>
                    <th> Email </th>
                    <th> Phone </th>
                    <th> Message </th>
                    <th> </th>

                </tr>
                </thead>
                <tbody>

                <?php
                while($mem = mysqli_fetch_array($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $mem["message_id"]; ?></td>
                        <td><?php echo $mem["username"]; ?></td>
                        <td ><?php echo $mem["name"]; ?></td>
                        <td><?php echo $mem["title"]; ?></td>
                        <td><?php echo $mem["email"]; ?></td>
                        <td><?php echo $mem["phone"]; ?></td>
                        <td><?php echo $mem["message"]; ?></td>

                        <td><input type="button" name="delete_data" value="Delete Message" id="<?php echo $mem["message_id"]; ?>" class="btn btn-danger delete_data" /></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

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
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

</body>

<?php include_once("../main-footer.html"); ?>
</html>
