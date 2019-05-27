<?php

include "../connection.php";
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}
if ($_SESSION["username"] !== 'admin')
{
    header("location: ../auth/error_page.php");
}

$query = "SELECT * FROM notices";

$result = mysqli_query($conn, $query);
?>
<?php include_once("../main-menu.html"); ?>

<html>
    <head>
        <title> Notices </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>

    </head>

<body>
<div class="container">
    <h3 align="center "> Notices </h3>
    <form action="insert.php" method="post">
        <div class="form-group  col-sm-10">
            <label for="topic"> Topic </label>
            <input type="text" class="form-control" id="topic" placeholder=" Attention " name="topic" required>
        </div>
        <div class="form-group col-sm-10">
            <label for="comment"> Message </label>
            <textarea class="form-control" rows="5" id="content" name="content" required ></textarea>
        </div>
        <div class="form-group  col-sm-10 ">
        <button type="submit" class="btn btn-primary"> Submit </button>
        </div>
    </form>
</div>


<div class="container" id="notice">
    <table  class="table table-bordered" >
        <tr>
            <th >Notice ID</th>
            <th >Topic</th>
            <th >Content</th>

            <th>Delete</th>
        </tr>

        <?php
        while($row = mysqli_fetch_array($result))
        {
            ?>
            <tr>
                <td><?php echo $row["nid"]; ?></td>
                <td><?php echo $row["topic"]; ?></td>
                <td><?php echo $row["content"]; ?></td>

                <td><input type="button" name="delete_data" value="Delete Notice" id="<?php echo $row["nid"]; ?>" class="btn btn-danger delete_data" /></td>

            </tr>
            <?php
        }
        ?>
    </table>
</body>


<script>

    $(document).ready(function() {

        $(document).on('click', '.delete_data', function () {
            var id = $(this).attr('id');

            Dialogify.confirm("<h5 class='text-danger'> <strong > Confirm ?</strong > </h5>",
                {
                    ok: function () {
                        $.ajax({
                            url: "delete.php",
                            method: "POST",
                            data: {id: id},
                            success: function (data) {
                                Dialogify.alert('<h4 class="text-success text-center"> <strong > Notice deleted !!</strong > </h4>');
                            }
                        })
                    },
                    cancel: function () {
                        this.close();
                    }
                });
        });

    });
    </script>
</html>

<?php include_once("../main-footer.html"); ?>
