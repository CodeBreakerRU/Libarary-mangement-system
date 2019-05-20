<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
 <head>

<?php include_once("../main-menu.html"); ?>
  <title>Books</title>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     <script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>

 </head>
 <body>
  <div class="container">
   <br />

   <br />
   <div class="panel panel-default">
    <div class="panel-heading">
     <div class="row">
      <div class="col-md-6">
          <h2 class="panel-title"><strong>Books</strong></h2>
      </div>

     </div>
    </div>
    <div class="panel-body">
     <div class="table-responsive" >
      <span id="form_response"></span>
      <table id="user_data" class="table table-bordered table-striped" style="width:100%">
       <thead>
        <tr>

         <td> Book ID </td>
         <td>Name</td>
         <td>Author</td>
         <td>ISBN</td>
         <td>Category</td>
         <td>Publisher</td>

         <td></td>

        </tr>
       </thead>
      </table>      
     </div>
    </div>
   </div>
  </div>
 </body>
 <?php include_once("../main-footer.html"); ?>
</html>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 var dataTable = $('#user_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"fetch.php",
   type:"POST"
  },
  "columnDefs":[
   {
     "targets":[0,1,2,3,4,5],
     "orderable":false,
   },
  ],

 });

 $(document).on('click', '.view', function(){
  var id = $(this).attr('id');
  var options = {
   ajaxPrefix: '',
   ajaxData: {id:id},
   ajaxComplete:function(){
    this.buttons([{
     type: Dialogify.BUTTON_PRIMARY
    }]);
   }
  };
  new Dialogify('fetchOneBook.php', options)
   .title('View Book Details')
   .showModal();
 });
 
});
</script>