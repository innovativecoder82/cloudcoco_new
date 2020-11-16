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
	
	$query1r= mysqli_query($conn,"SELECT * FROM supplier_details where sup_id='$supplier_id' ORDER BY `id` DESC");
	$rowsr = mysqli_fetch_assoc($query1r);
	$id= $rowsr['id'];	
	$raw_mater= $rowsr['raw_material'];	
	$suplier_advance_amt= $rowsr['suplier_advance_amt'];
	
	$quej= mysqli_query($conn,"SELECT * FROM raw where id='$raw_mater' ORDER BY `id` DESC");
	$rawj = mysqli_fetch_assoc($quej);
	
$tot_raw_price=$price_units+$price_loads;
	if($tot_raw_price>=$suplier_advance_amt)
{
$adv_sub=$tot_raw_price-$suplier_advance_amt;
$repayment=$suplier_advance_amt;
$sub_adv_add=$suplier_advance_amt-$tot_raw_price;

}elseif($suplier_advance_amt>=$tot_raw_price)
{
	//$adv_sub=$suplier_advance_amt-$tot_raw_price;
$repayment=$tot_raw_price;
$sub_adv_add=$suplier_advance_amt-$tot_raw_price;

}
	
	
	
	$query = mysqli_query($conn,"update supplier_details set suplier_advance_amt='$sub_adv_add' where id='$id'");
	
 $query11 = mysqli_query($conn,"INSERT INTO supplier_advance_repayment (sup_id,rawmat_id, advace_repayment, date) VALUES('$supplier_id','$rawmat_id','$repayment','$date')");
 if($adv_sub>0){
 $query11 = mysqli_query($conn,"INSERT INTO raw_material_pending_amt (sup_id, rawmat_id, rawmaterial_pending_amt, date) VALUES('$supplier_id','$rawmat_id','$adv_sub','$date')");
 }
 $query11 = mysqli_query($conn,"INSERT INTO raw_material (rawmat_id, rawmat_id1, raw_material, color, quaty_units, price_units, quaty_loads, price_loads, department, supplier_id, emp_id, dateofdelivery, vechicle_name, vechicle_no, payment_status, payment_mode, payment_details, feedback, date) VALUES('$rawmat_id','$rawmat_id1','$raw_material','$color','$quaty_units','$price_units','$quaty_loads','$price_loads','$department','$supplier_id','$emp_id','$dateofdelivery','$vechicle_name','$vechicle_no','$payment_status','$payment_mode','$payment_details','$feedback','$date')");

$body = '
<table style="font-family: arial, sans-serif;border-collapse: collapse;width:500px;">
<tr><td colspan="2" style="text-align:center;background-color:#f78f1e;color:#ffffff;"><h3 style="text-align:center;background-color:#f78f1e;color:#ffffff;">Ram Material</h3></td></tr>
    <tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Supplier</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$rowsr['sup_name'].'</td>
    </tr>
    <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Raw Material</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$rawj['raw_name'].'</td>
    </tr>
    <tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Color</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$rowsr['color'].'</td>
    </tr>
	<tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Unit Quantity</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$rowsr['quaty_units'].'</td>
    </tr>
	<tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Unit Price</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$rowsr['price_units'].'</td>
    </tr>
	<tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Load Quantity</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$rowsr['quaty_loads'].'</td>
    </tr>
	<tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Load Price</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$rowsr['price_loads'].'</td>
    </tr>
	<tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Department</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$rowsr['department'].'</td>
    </tr>
	
</table>';



$sender = 'demo@gmail.com';
$recipient = 'demo@gmail.com';

$subject = "Raw Material";
$headers = 'From:' . $sender;

mail($recipient, $subject, $body, $headers);
  echo'<script>alert("Successfully Added..!");window.location.href="add_raw_material.php";</script>';


 
   
 	
}
?>

<!doctype html>
<html lang="en" dir="ltr">


<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('add_raw_material'); ?>
         <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title">
                Dashboard
              </h1>
            </div>
            <div class="row row-cards">
              
                  
 <form method="post">
                          
<div class="row">
<div class="col-xl-12">
<div class="row">

					   <div class="col-md-4 col-xl-3">
						
                         <div class="mb-3">
						<label class="form-label">Supplier Name</label>
						 <?php  $sup_id1=$_GET['sup_id'];
							if(isset($sup_id1)){ 
							$sqle = mysqli_query($conn,"SELECT * FROM supplier_details where sup_id='$sup_id1' order by id asc");
												$rowsqqe = mysqli_fetch_assoc($sqle);
												$sup_id=$rowsqqe['sup_id'];
												$sup_name=$rowsqqe['sup_name'];
												$adv_amt=$rowsqqe['suplier_advance_amt'];
							?>
						<select name="supplier_id"  id="select-beast" class="form-control custom-select"   onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);"  required>
						<option value="<?php echo "$sup_id";?>" selected><?php echo "$sup_name";?></option>
						
						<?php $sql = mysqli_query($conn,"SELECT * FROM supplier_details order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$sup_id=$rowsqq['sup_id'];
														$sup_name=$rowsqq['sup_name'];
												?>
													<option value="add_raw_material.php?sup_id=<?php echo "$sup_id";?>"><?php echo "$sup_id - $sup_name";?></option>
													<?php } ?>	
						
						
						</select>
						<?php }else{ ?>
						<select name="supplier_id"  id="select-beast" class="form-control custom-select"   onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);"  required>
						<option value="" selected>Select Supplier</option>
						
						<?php $sql = mysqli_query($conn,"SELECT * FROM supplier_details order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$sup_id=$rowsqq['sup_id'];
														$sup_name=$rowsqq['sup_name'];
												?>
													<option value="add_raw_material.php?sup_id=<?php echo "$sup_id";?>"><?php echo "$sup_id - $sup_name";?></option>
													<?php } ?>	
						
						
						</select>
						<?php } ?>
					    </div>
                      </div>
					  
					    <div class="col-md-4 col-xl-2">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Color<span class="form-required">*</span></label>
                            <select name="color"  id="select-beast1" class="form-control custom-select" required>
<option value="" selected>Color</option>
<option value="White" >White</option>
<option value="Brown" >Brown</option>
</select>
                          </div>
                        </div>
                      </div>
					     <div class="col-md-4 col-xl-1">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Qty<span class="form-required">*</span></label>
                           <input name="quaty_units" type="text"  placeholder='Units' class="form-control" required="">
                          </div>
                        </div>
                      </div>
					   <div class="col-md-4 col-xl-1">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Price<span class="form-required">*</span></label>
                            <input  name="price_units"  type="text" placeholder='Units' class="form-control" required=""></td>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-4 col-xl-1">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Qty <span class="form-required">*</span></label>
                            <input type="text" name="quaty_loads"  placeholder='Loads' class="form-control" autofocus required autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-4 col-xl-1">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Price<span class="form-required">*</span></label>
                            <input type="text" name="price_loads"  placeholder='Loads' class="form-control" autofocus required autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					    <div class="col-md-4 col-xl-3">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Department<span class="form-required">*</span></label>
                            <select name="department"  id="select-beast2" class="form-control custom-select" required>
<option value="" selected>Department</option>
<?php $sql = mysqli_query($conn,"SELECT * FROM department order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$department=$rowsqq['department'];
												?>
													<option value="<?php echo "$department"; ?>"><?php echo "$department";?></option>
													<?php } ?>	
</select>
                          </div>
                        </div>
                      </div>
</div>
</div>
<div class="col-xl-6">
                      <div class="row">
                      <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Select Raw Material<span class="form-required">*</span></label>
                            <select name="raw_material" id="select-beast" class="form-control custom-select" required >
<option value="" selected>Select Raw Material</option>
<?php $sql = mysqli_query($conn,"SELECT * FROM raw order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$id=$rowsqq['id'];
														$raw_name=$rowsqq['raw_name'];
												?>
													<option value="<?php echo "$id"; ?>"><?php echo "$raw_name";?></option>
													<?php } ?>	
</select>
                          </div>
                        </div>
                      </div>
                     <div class="col-md-4 col-xl-6">
						
                         <div class="mb-3">
						<label class="form-label">Purchase Manager Name</label>
						<select name="emp_id"  id="select-beast" class="form-control custom-select" required>
						<option value="" selected>Select Employee Role</option>
						<?php $sql = mysqli_query($conn,"SELECT * FROM employee_details where emp_role='Purchase Manager' order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$emp_id=$rowsqq['emp_id'];
														$emp_name=$rowsqq['emp_name'];
												?>
													<option value="<?php echo "$emp_id";?>"><?php echo "$emp_id - $emp_name";?></option>
													<?php } ?>	
					
						</select>
					    </div>
                      </div>
					  <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
						  
                            <label class="form-label">Advance Amount<span class="form-required">*</span></label>
                            <input type="text" name="sup_adv_amt" class="form-control" value="<?php echo $adv_amt; ?>" autofocus autocomplete="off" readonly />
                          </div>
                        </div>
                      </div>
					   <div class="col-md-4 col-xl-6">
                      <div class="mb-3">
						<label class="form-label">Date of Delivery<span class="form-required">*</span></label>
						<?php 
					  date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	?>
                              <input id="calendar-simple" name="dateofdelivery" type="date" min="<?php echo $date; ?>" class="form-control mb-2" placeholder="Select a date" />
                        
					   </div>
					</div>
					
</div>						
</div>	
<div class="col-xl-6">
                      <div class="row">
                    
                      <?php
					$query1= mysqli_query($conn,"SELECT * FROM raw_material ORDER BY `id` DESC");
					$rows = mysqli_fetch_assoc($query1);
					$rawmat_id1= $rows['id'];
					$rawmat_id2=$rawmat_id1+1;
				  ?>
				      <input type="hidden" name="rawmat_id" class="form-control" Value="<?php  printf("Raw%06d", $rawmat_id2);?>" autocomplete="off"/ readonly>
                            <input type="hidden" name="rawmat_id1" class="form-control" value="<?php echo $rawmat_id2;?>" autocomplete="off"/>
                       
					   <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Vechicle Name<span class="form-required">*</span></label>
                            <input type="text" name="vechicle_name" class="form-control" autofocus autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Vechicle No.<span class="form-required">*</span></label>
                            <input type="text" name="vechicle_no" class="form-control" autofocus autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Payment Status<span class="form-required">*</span></label>
                            <select name="payment_status"  id="select-beast" class="form-control custom-select" required>
						<option value="" selected>Select Payment Status</option>
						<option value="Paid" >Paid</option>
						<option value="Pending" >Pending</option>
						</select>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Payment Mode<span class="form-required">*</span></label>
                         <select name="payment_mode"  id="select-beast" class="form-control custom-select" required>
						<option value="" selected>Select Payment Mode</option>
						<option value="Cash" >Cash</option>
						<option value="Netbanking" >Netbanking</option>
						<option value="Cheque" >Cheque</option>
						</select>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Payment Details<span class="form-required">*</span></label>
                        <input type="text" name="payment_details" class="form-control" autofocus autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Feedback About the Loads<span class="form-required">*</span></label>
                              <textarea class="form-control" name="feedback" data-toggle="autosize" placeholder="Comments…"></textarea>
                      </div>
                        </div>
                      </div>
</div>						
</div>						
</div>		
</table>				
  <div class="card-footer text-right">
  <div class="d-flex">
  
     <a href="add_employee.php" class="btn btn-link">Cancel</a>
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
</html>