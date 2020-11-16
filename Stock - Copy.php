


<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');




?>
<?php
extract($_POST);
if(isset($_POST['submit_row']))
{
 
 date_default_timezone_set('Asia/Calcutta');
 $date = date('Y-m-d');
 $time = date('h:i sa');
 
 for($i=0;$i<count($quaty_units);$i++)
 {
  if($quaty_units[$i]!="")
  {
	   echo'<script>alert("Successfully Added..!");window.location.href="stock.php?prno='.count($quaty_units).'.&.'.$quaty_units[1].'.&.'.$quaty_units[2].'";</script>';

//$query11 = mysqli_query($conn,"INSERT INTO order_items (raw_material, color, quaty_units, quaty_loads, price_loads, department, date) VALUES('$raw_material[$i]','$color[$i]','$quaty_units[$i]','$quaty_units[$i]','$quaty_loads[$i]','$price_loads[$i]','$department[$i]','$date[$i]')");
	   
  }
 }

}
?>

<!doctype html>
<html lang="en" dir="ltr">

<script type="text/javascript">
function add_row()
{
 $rowno=$("#employee_table tr").length;
 $rowno=$rowno+1;
 $("#employee_table tr:last").after("<tr id='row"+$rowno+"'><td><input type='text' name='name[]' placeholder='Enter Name'></td><td><input type='text' name='age[]' placeholder='Enter Age'></td><td><input type='text' name='job[]' placeholder='Enter Job'></td><td><input type='button' value='DELETE' onclick=delete_row('row"+$rowno+"')></td></tr>");
}
function delete_row(rowno)
{
 $('#'+rowno).remove();
}
</script>
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('dashboard'); ?>
         <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title">
                Dashboard
              </h1>
            </div>
            <div class="row row-cards">
              
   <div class="table-responsive">
  <div class="col-md-12">
<div class="input_fields_wrap">
 <form method="post">

<div class="row">
<div class="col-md-2">
<div class="form-group">
<label for="">Raw Material</label>
<select name="raw_material[]"  id="select-beast" class="form-control custom-select">
<option selected>Select Raw Material</option>
<option value="Hush White" >Hush White</option>
<option value="Hush White" >Hush White</option>
<option value="Hush White" >Hush White</option>
<option value="Hush White" >Hush White</option>
</select>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label for="">Color</label>
<select name="color[]"  id="select-beast1" class="form-control custom-select">
<option selected>Color</option>
<option value="White" >White</option>
<option value="Brown" >Brown</option>
</select>
</div>
</div>
<div class="col-md-1">
<div class="form-group" >
<label for="">Qty in Units</label>
<input name="quaty_units[]" type="text" value="" class="form-control" required="">
</div>
</div>
<div class="col-md-1">
<div class="form-group" >
<label for="">Price Units</label>
<input  name="price_units[]"  type="text" value="" class="form-control" required="">
</div>
</div>
<div class="col-md-1">
<div class="form-group" >
<label for="">Qty Loads</label>
<input name="quaty_loads[]" type="text" value="" class="form-control" required="">
</div>
</div>
<div class="col-md-1">
<div class="form-group" >
<label for="">Price Loads</label>
<input  name="price_loads[]" type="text" value="" class="form-control" required="">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label for="">Department</label>
<select name="department[]"  id="select-beast2" class="form-control custom-select">
<option selected>Department</option>
<option value="Fiber" >Fiber</option>
<option value="Pith Block" >Pith Block</option>
<option value="Yarn" >Yarn</option>
</select>
</div>
</div>

</div>


</div>
</div>
  <div class="card-footer text-right">
  <div class="d-flex">
  <button style="background-color:green;" class="add_field_button btn btn-info active">Add</button>

    <a href="add_employee.php" class="btn btn-link">Cancel</a>
    <button type="submit" name="submit_row" class="btn btn-primary ml-auto">Submit</button>
  </div>
</div>
</form>
        </div>
        </div>
        </div>
        </div>
    
 <?php footertemplate(); ?>
      
    </div>
  </body>
  
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
var max_fields = 15; //maximum input boxes allowed
var wrapper = $(".input_fields_wrap"); //Fields wrapper
var add_button = $(".add_field_button"); //Add button ID
var x = 1; //initlal text box count
$(add_button).click(function(e){ //on add input button click
e.preventDefault();
if(x < max_fields){ //max input box allowed
x++; //text box increment
$(wrapper).append('<div class="row"><div class="col-md-2"><div class="form-group"><label for="">Raw Material</label><select name="raw_material[]"  id="select-beast" class="form-control custom-select"><option selected>Select Raw Material</option><option value="Hush White" >Hush White</option><option value="Hush White" >Hush White</option><option value="Hush White" >Hush White</option><option value="Hush White" >Hush White</option></select></div></div><div class="col-md-2"><div class="form-group"><label for="">Color</label><select name="color[]"  id="select-beast1" class="form-control custom-select"><option selected>Color</option><option value="White" >White</option><option value="Brown" >Brown</option></select></div></div><div class="col-md-1"><div class="form-group" ><label for="">Qty in Units</label><input name="quaty_units[]" type="text" value="" class="form-control" required=""></div></div><div class="col-md-1"><div class="form-group" ><label for="">Price Units</label><input  name="price_units[]"  type="text" value="" class="form-control" required=""></div></div><div class="col-md-1"><div class="form-group" ><label for="">Qty Loads</label><input name="quaty_loads[]" type="text" value="" class="form-control" required=""></div></div><div class="col-md-1"><div class="form-group" ><label for="">Price Loads</label><input  name="price_loads[]" type="text" value="" class="form-control" required=""></div></div><div class="col-md-2"><div class="form-group"><label for="">Department</label><select name="department[]"  id="select-beast2" class="form-control custom-select"><option selected>Department</option><option value="Fiber" >Fiber</option><option value="Pith Block" >Pith Block</option><option value="Yarn" >Yarn</option></select></div></div><div style="height:20%;cursor:pointer;background-color:red;" class="remove_field btn btn-info">Remove</div></div>'); //add input box
}
});
$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault(); $(this).parent('div').remove(); x--;
})
});
</script>
  <script>
                require(['jquery', 'selectize'], function ($, selectize) {
                    $(document).ready(function () {
                        $('#input-tags').selectize({
                            delimiter: ',',
                            persist: false,
                            create: function (input) {
                                return {
                                    value: input,
                                    text: input
                                }
                            }
                        });
                
                        $('#select-beast').selectize({});
                        $('#select-beast1').selectize({});
                        $('#select-beast2').selectize({});
                
                        $('#select-users').selectize({
                            render: {
                                option: function (data, escape) {
                                    return '<div>' +
                                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                        '<span class="title">' + escape(data.text) + '</span>' +
                                        '</div>';
                                },
                                item: function (data, escape) {
                                    return '<div>' +
                                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                        escape(data.text) +
                                        '</div>';
                                }
                            }
                        });
                
                        $('#select-countries').selectize({
                            render: {
                                option: function (data, escape) {
                                    return '<div>' +
                                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                        '<span class="title">' + escape(data.text) + '</span>' +
                                        '</div>';
                                },
                                item: function (data, escape) {
                                    return '<div>' +
                                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                        escape(data.text) +
                                        '</div>';
                                }
                            }
                        });
                    });
                });
              </script>
</html>