<!DOCTYPE html>
<head>
    <?php include_once("../main-menu-admin.html"); ?>

    <title> </title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>


</head>
<body>
<div class="container">
    <br /><br />
    <h4 align="center"> Return Book Details </h4>
    <br />

    <input type="text" id="myInput" onkeyup="myFunction()" placeholder=" Search by member ID " >

    <br />
    <table class="table table-bordered table-striped" id="myTable">
        <thead>
        <tr>
            <th >ID</th>
            <th >MEMBER ID</th>
            <th > BOOK ID</th>
            <th >BORROWED DATE</th>
            <th >RETURNED DATE</th>
            <th >STATUS</th>
        </tr>
        </thead>
        <tbody id="employee_data">
        </tbody>
    </table>
</body>
</html>



<script type="text/javascript" language="javascript" >
    $(document).ready(function(){
        function fetch_employee_data()
        {
            $.ajax({
                url:"fetch.php",
                method:"POST",
                dataType:"json",
                success:function(data)
                {
                    for(var count=0; count<data.length; count++)
                    {
                        var html_data = '<tr><td>'+data[count].brid+'</td>';
                        html_data += '<td data-name="memberid" class="memberid" data-type="text" data-pk="'+data[count].id+'">'+data[count].memberid+'</td>';
                        html_data += '<td data-name="bookid" class="bookid" data-type="select" data-pk="'+data[count].id+'">'+data[count].bookid+'</td>';
                        html_data += '<td data-name="borrowed_time" class="borrowed_time" data-type="text" data-pk="'+data[count].id+'">'+data[count].borrowed_time+'</td>';
                        html_data += '<td data-name="returned_time" class="returned_time" data-type="date" data-pk="'+data[count].brid+'">'+data[count].returned_time+'</td>';
                        html_data += '<td data-name="status" class="status" data-type="select" data-pk="'+data[count].brid+'">'+data[count].status+'</td></tr>';
                        $('#employee_data').append(html_data);
                    }
                }
            })
        }
        fetch_employee_data();


        $('#employee_data').editable({
            container: 'body',
            selector: 'td.status',
            url: "update.php",
            title: 'STATUS',
            type: "POST",
            dataType: 'json',
            source: [{value: "BORROWED", text: "BORROWED"}, {value: "RETURNED", text: "RETURNED"}],
            validate: function(value){
                if($.trim(value) == '')
                {
                    return ' Return Status Cannot be empty !!';
                }
            }
        });

        $('#employee_data').editable({
            container: 'body',
            selector: 'td.returned_time',
            url: "update.php",
            title: 'Returned Date',
            type: "POST",
            dataType: 'json',
            validate: function(value){
                if($.trim(value) == '')
                {
                    return ' Date cannot be empty !!';
                }
            }
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

<?php include_once("../main-footer.html"); ?>