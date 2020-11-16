<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');


$id=$_GET['id'];

?>
<?php
extract($_POST);
if(isset($_POST['submit_row']))
{
 
 date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	
	$query1ks= mysqli_query($conn,"SELECT * FROM daily_production where id='$id' ORDER BY `id` DESC");
	$rowsks = mysqli_fetch_assoc($query1ks);
	$prod=$rowsks['product'];
	$qual=$rowsks['quality'];
	$oldtot=$rowsks['total_load'];
	$oldwgt=$rowsks['weight'];
	$oldtotwgt=$rowsks['total_weight'];
	
	$query1k= mysqli_query($conn,"SELECT * FROM product where prod_name='$prod' and quality='$qual' ORDER BY `id` DESC");
 $rowsk = mysqli_fetch_assoc($query1k);
 
 $pr_id=$rowsk['id'];
 $stk=$rowsk['stock'];
 $totwgtnew=$rowsk['total_weight'];
 $ovtotwgtnew=$totwgtnew-$oldtotwgt;
 $fin_ovtotwgtnew=$ovtotwgtnew+$total_weight;
 $tot_stk=$stk-$oldtot;
 $fin_tot=$tot_stk+$total_load;
 
 if(($fin_tot>0)or($fin_ovtotwgtnew>0))
 {
 $query = mysqli_query($conn,"update product set stock='$fin_tot', weight='$weight' , total_weight='$fin_ovtotwgtnew' where id='$pr_id'");

	
	$query = mysqli_query($conn,"update daily_production set product='$product', total_load='$total_load', weight='$weight', total_weight='$total_weight', dailydate='$dailydate' where id='$id'");

 echo'<script>alert("Successfully Updated..!");window.location.href="daily_production.php";</script>';
 }else{ 
  echo'<script>alert("Stock is less..!");window.location.href="daily_production.php";</script>';

 }
 	  
}
?>

<!doctype html>
<html lang="en" dir="ltr">


<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('add_daily_production'); ?>
         <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title">
                Edit Daily Production
              </h1>
            </div>
            <div class="row row-cards">
              
                  
 <form method="post">
                          
<div class="row">
<div class="col-xl-12">
<div class="row">
  					  <?php
					$query1= mysqli_query($conn,"SELECT * FROM daily_production where id='$id' ORDER BY `id` DESC");
					$rows = mysqli_fetch_assoc($query1);
					 ?>
                        <div class="col-md-4 col-xl-4">
					     <div class="mb-3">
                            <label class="form-label">Product<span class="form-required">*</span></label>
                            <select name="product" id="select-beast1" class="form-control custom-select" required>
<option value="<?php echo $rows['product']; ?>" selected><?php echo $rows['product']; ?></option>

</select>
                          </div>
                      </div>
					   <?php  
							if(($rows['product']=='White Fiber') or ($rows['product']=='Brown Fiber')){ ?>
              
					  <div class="col-md-4 col-xl-4">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Quality<span class="form-required">*</span></label>
                     <select name="quality" id="select-beast1" class="form-control custom-select" >
						<option value="<?php echo $rows['quality']; ?>" selected><?php echo $rows['quality']; ?></option>

					  </select>							
					</div>
                        </div>
							</div><?php }else{} ?>
					  <div class="col-md-4 col-xl-4">
                      <div class="mb-3">
					  <?php  date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa'); ?>
						<label class="form-label">Daily Date<span class="form-required">*</span></label>
                              <input id="calendar-simple" name="dailydate" type="date"  value="<?php echo $rows['dailydate']; ?>" class="form-control mb-2" placeholder="Select a date" />
                        
					   </div>
					</div>
					   <div class="col-md-4 col-xl-2">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">No of Bales/Load<span class="form-required">*</span></label>
                            <input  name="total_load" id="total_load"  type="number" placeholder='Load' value="<?php echo $rows['total_load']; ?>" oninput="add_number()" class="form-control" ></td>
                          </div>
                        </div>
                      </div>
					      <div class="col-md-4 col-xl-2">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Weight<span class="form-required">*</span></label>
                            <input  name="weight" id="weight"  type="number" placeholder='Weight' class="form-control" readonly value="<?php echo $rows['weight']; ?>" oninput="add_number()" ></td>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-4 col-xl-2">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Total Weight<span class="form-required">*</span></label>
                            <input  name="total_weight" id="total_weight"  type="number" placeholder='Total Weight' class="form-control" value="<?php echo $rows['total_weight']; ?>"  ></td>
                          </div>
                        </div>
                      </div>
					
					    
</div>
</div>
						
</div>		
</div>		
</table>				
  <div class="card-footer text-right">
  <div class="d-flex">
  
     <a href="view_production.php" class="btn btn-link">Cancel</a>
    <button type="submit" name="submit_row" class="btn btn-primary ml-auto">Submit</button>
  </div>
</div>
   </form>

        </div>
        </div>
        </div>
    
 <?php footertemplate(); ?>
      
    </div>
  </body>
  
  
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
			  <script>	  
			  
			  function add_number() {
                   
  var total_load = parseInt(document.getElementById("total_load").value);
  var weight = parseInt(document.getElementById("weight").value);
  var result = total_load * weight;

  document.getElementById("total_weight").value = result;
  
}

</script>
			  
</html>