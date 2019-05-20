<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

if ($_SESSION["username"] !== 'admin')
{
    header("location: ../auth/error_page.php");
}
?>

<?php
//    require('conn.php');
//
//    $result = $mysqli->query("SELECT * FROM borrows where status = 'borrowed'");


require_once "../connection.php";

$query = "SELECT * FROM borrows where status = 'borrowed'";
$result = mysqli_query($conn, $query);
?>
<?php include_once("../main-menu-admin.html"); ?>
<!DOCTYPE html>
<head>

    <title> Return books </title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<br /><br />

 <h2 align="center"> Return Books </h2>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                <h4 class="modal-title" id="memberModalLabel">Add Returned Book Detail</h4>

            </div>
            <div class="dash">

            </div>

        </div>
    </div>
</div>
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
                    <th >Borrowed ID </th>
                    <th >Member ID </th>
                    <th >Book ID</th>
                    <th >Borrowed Date</th>
                    <th >Returned Date</th>
                    <th > Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                         while ($mem = mysqli_fetch_assoc($result)):
                            echo '<tr>';
                               echo '<td>'.$mem['brid'].'</td>';
                               echo '<td>'.$mem['memberid'].'</td>';
                               echo '<td>'.$mem['bookid'].'</td>';
                               echo '<td>'.$mem['borrowed_time'].'</td>';
                               echo '<td>'.$mem['returned_time'].'</td>';
                             echo '<td>'.$mem['status'].'</td>';

                             echo '<td>
                                        <a class="btn btn-small btn-primary"
                                           data-toggle="modal"
                                           data-target="#exampleModal"
                                           data-whatever="'.$mem['brid'].' ">Edit</a>
                                     </td>';
                            echo '</tr>';
                         endwhile;
                         /* free result set */
                         $result->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'brid=' + recipient;

            $.ajax({
                type: "GET",
                url: "editdata.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })
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
