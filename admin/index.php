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

<!DOCTYPE html>
 <head>

<?php include_once("../main-menu-admin.html"); ?>
  <title>Manage Books</title>

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
          <h2 class="panel-title"><strong>Book Details</strong></h2>
      </div>
      <div class="col-md-6" align="right">
       <button type="button" name="add_data" id="add_data" class="btn btn-success btn-xs">Insert a new Book</button>
      </div>
     </div>
    </div>
    <div class="panel-body">
     <div class="table-responsive" >
      <span id="form_response"></span>
      <table id="user_data" class="table table-bordered table-striped" style="width:100%">
       <thead>
        <tr>
         <td>Name</td>
         <td>Author</td>
         <td>ISBN</td>
         <td>Category</td>

         <td>Publisher</td>

         <td>Copies</td>
         <td>Available copies</td>

            <td></td>
            <td></td><td></td>

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
 
 var dataTable = $('#user_data').DataTable(

  {
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"fetch.php",
   type:"POST"
  },

  "columnDefs":[
   {
    "targets":[0,1,2,3,4,5,6,7,8,9],
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
 
 $('#add_data').click(function(){
  var options = {
   ajaxPrefix:''
  };


  new Dialogify('add_data_form.php', options)
   .title('Add New Book Data')
   .buttons([
    {
     text:'Close',
     click:function(e){
      this.close();
     }
    },
    {
     text:'Insert',
     type:Dialogify.BUTTON_PRIMARY,
     click:function(e)
     {
      var form_data = new FormData();
      form_data.append('name', $('#name').val());
      form_data.append('author', $('#author').val());
      form_data.append('isbn', $('#isbn').val());
      form_data.append('category', $('#category').val());
      form_data.append('publisher', $('#publisher').val());
      form_data.append('copies', $('#copies').val());

      $.ajax({
       method:"POST",
       url:'insert_data.php',
       data:form_data,
       dataType:'json',
       contentType:false,
       cache:false,
       processData:false,
       success:function(data)
       {
        if(data.error != '')
        {
         $('#form_response').html('<div class="alert alert-danger">'+data.error+'</div>');
        }
        else
        {
         $('#form_response').html('<div class="alert alert-success">'+data.success+'</div>');
         dataTable.ajax.reload();
        }
       }
      });
     }
    }
   ]).showModal();
 });



 $(document).on('click', '.update', function(){
  var id = $(this).attr('id');
  $.ajax({
   url:"fetch_single_data.php",
   method:"POST",
   data:{id:id},
   dataType:'json',
   success:function(data)
   {
    localStorage.setItem('name', data[0].name);
    localStorage.setItem('author', data[0].author);
    localStorage.setItem('isbn', data[0].isbn);
    localStorage.setItem('category', data[0].category);
    localStorage.setItem('publisher', data[0].publisher);
    localStorage.setItem('copies', data[0].copies);
    localStorage.setItem('availablecopies', data[0].availablecopies);


    var options = {
     ajaxPrefix:''
    };



    new Dialogify('edit_data_form.php', options)
     .title('Edit Book Data')
     .buttons([
      {
       text:'Close',
       click:function(e){
        this.close();
       }
      },
      {
       text:'Edit',
       type:Dialogify.BUTTON_PRIMARY,
       click:function(e)
       {
        
        var form_data = new FormData();
       
        form_data.append('name', $('#name').val());
        form_data.append('author', $('#author').val());
        form_data.append('isbn', $('#isbn').val());
        form_data.append('category', $('#category').val());
        form_data.append('publisher', $('#publisher').val());
        form_data.append('copies', $('#copies').val());
        form_data.append('id', data[0].id);

        $.ajax(
         {
         method:"POST",
         url:'update_data.php',
         data:form_data,
         dataType:'json',
         contentType:false,
         cache:false,
         processData:false,
         success:function(data)
         {
          if(data.error != '')
          {
           $('#form_response').html('<div class="alert alert-danger">'+data.error+'</div>');
          }
          else
          {
           $('#form_response').html('<div class="alert alert-success">'+data.success+'</div>');
           dataTable.ajax.reload();
          }
         }
        });
       }
      }
     ]).showModal();
   }
  })
 });



 $(document).on('click', '.delete', function()
 {
  var id = $(this).attr('id');

  Dialogify.confirm("<h3 class='text-danger'> <strong > Confirm ?</strong > </h3>",
      {

   ok:function(){
    $.ajax({
     url:"deleteBooks.php",
     method:"POST",
     data:{id:id},
     success:function(data)
     {
      Dialogify.alert('<h3 class="text-success text-center"> <strong >Book has been deleted !!</strong > </h3>');
      dataTable.ajax.reload();
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