<div class="form-group">
 <label>Enter Book Name</label>
 <input type="text" name="name" id="name" class="form-control" />
</div>

<div class="form-group">
 <label>Enter Author</label>
 <input type="text" name="author" id="author" class="form-control" />
</div>

<div class="form-group">
    <label>Enter ISBN No</label>
    <input type="text" name="isbn" id="isbn" class="form-control" />
</div>
<div class="form-group">
 <label>Select Category</label>
 <select name="category" id="category" class="form-control">
     <option value="Arts and Music">Arts and Music</option>
     <option value="Kids">Kids</option>
     <option value="Education">Education</option>
     <option value="Computer and Tech">Computer and Tech</option>
     <option value="History">History</option>
 </select>
</div>

<div class="form-group">
 <label>Enter Publisher</label>
 <input type="text" name="publisher" id="publisher" class="form-control" />
</div>

<div class="form-group">
    <label>Enter No Of Copies</label>
    <input type="text" name="copies" id="copies" class="form-control" />
</div>

<script>
 $(document).ready(function () {

  var name = localStorage.getItem('bname');
  var author = localStorage.getItem('author');
  var isbn = localStorage.getItem('isbn');
  var category = localStorage.getItem('category');
  var publisher = localStorage.getItem('publisher');
  var copies = localStorage.getItem('copies');

  $('#name').val(name);
  $('#author').val(author);
  $('#isbn').val(isbn);
  $('#category').val(category);
  $('#publisher').val(publisher);
  $('#copies').val(copies);


 });
</script>
