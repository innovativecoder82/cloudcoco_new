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
	
	
	$quem= mysqli_query($conn,"SELECT * FROM supplier_details where sup_id='$supplier_id' ORDER BY `id` DESC");
	$rowsr = mysqli_fetch_assoc($quem);
	$ids= $quem['id'];	
	$rawmat_ids= $quem['rawmat_id'];	
	$raw_maters= $quem['raw_material'];	
	$suplier_advance_amts= $quem['suplier_advance_amt'];
	$price_unitss= $quem['price_units'];
	$price_loadss= $quem['price_loads'];
	
	
	$tot_raw_prices=$price_unitss+$price_loadss;
	if($tot_raw_prices>=$suplier_advance_amts)
{
$adv_sub=$tot_raw_price-$suplier_advance_amts;
$repayment=$suplier_advance_amts;
$sub_adv_adds=$suplier_advance_amts+$tot_raw_prices;

}elseif($suplier_advance_amt>=$tot_raw_price)
{
	//$adv_sub=$suplier_advance_amt-$tot_raw_price;
$repayment=$tot_raw_prices;
$sub_adv_adds=$suplier_advance_amts+$tot_raw_prices;
}
	$query = mysqli_query($conn,"update supplier_details set suplier_advance_amt='$sub_adv_adds' where id='$ids'");
		$query2 = mysqli_query($conn,"delete from supplier_advance_repayment where rawmat_id='$rawmat_ids'");

  if($adv_sub>0){
	$query2 = mysqli_query($conn,"delete from raw_material_pending_amt where rawmat_id='$rawmat_ids'");

 }

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
 
	
$query = mysqli_query($conn,"update raw_material set raw_material='$raw_material', color='$color', quaty_units='$quaty_units', price_units='$price_units', quaty_loads='$quaty_loads', price_loads='$price_loads', department='$department', supplier_id='$supplier_id', emp_id='$emp_id', dateofdelivery='$dateofdelivery', vechicle_name='$vechicle_name', vechicle_no='$vechicle_no', payment_mode='$payment_mode', payment_details='$payment_details', feedback='$feedback' where rawmat_id='$rawmat_id'");

	
	
	
	
 echo'<script>alert("Successfully Updated..!");window.location.href="view_raw_material.php";</script>';


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
						<?php $sqld = mysqli_query($conn,"SELECT * FROM raw_material where id='$id' order by id asc");
												$rowsqqd = mysqli_fetch_assoc($sqld);
												$ra_id=$rowsqqd['raw_material'];
								$sqls = mysqli_query($conn,"SELECT * FROM raw where id='$ra_id' order by id desc");
								$rowas = mysqli_fetch_array($sqls);
												?>
												
                          <div class="mb-3">
                            <label class="form-label">Select Raw Material<span class="form-required">*</span></label>
                            <select name="raw_material" id="select-beast" class="form-control custom-select" required >
<option value="<?php echo $rowas['id']; ?>" selected><?php echo $rowas['raw_name']; ?></option>
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
					    <div class="col-md-4 col-xl-2">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Color<span class="form-required">*</span></label>
                            <select name="color"  id="select-beast1" class="form-control custom-select" required>
<option value="<?php echo $rowsqqd['color']; ?>" selected><?php echo $rowsqqd['color']; ?></option>
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
                           <input name="quaty_units" type="text"  placeholder='Units' value="<?php echo $rowsqqd['quaty_units']; ?>" class="form-control" required="">
                          </div>
                        </div>
                      </div>
					   <div class="col-md-4 col-xl-1">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Price<span class="form-required">*</span></label>
                            <input  name="price_units"  type="text" placeholder='Units' value="<?php echo $rowsqqd['price_units']; ?>" class="form-control" required=""></td>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-4 col-xl-1">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Qty <span class="form-required">*</span></label>
                            <input type="text" name="quaty_loads"  placeholder='Loads' value="<?php echo $rowsqqd['quaty_loads']; ?>" class="form-control" autofocus required autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-4 col-xl-1">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Price<span class="form-required">*</span></label>
                            <input type="text" name="price_loads"  placeholder='Loads' value="<?php echo $rowsqqd['price_loads']; ?>" class="form-control" autofocus required autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					    <div class="col-md-4 col-xl-3">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Department<span class="form-required">*</span></label>
                            <select name="department"  id="select-beast2" class="form-control custom-select" required>
<option value="<?php echo $rowsqqd['department']; ?>" selected><?php echo $rowsqqd['department']; ?></option>
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
						<label class="form-label">Supplier Name</label>
						<?php 
						$supplier_idq=$rowsqqd['supplier_id'];
						$sqlz = mysqli_query($conn,"SELECT * FROM supplier_details where sup_id='$supplier_idq' order by id asc");
												$rowsqqz = mysqli_fetch_assoc($sqlz);
						?> 
						<select name="supplier_id"  id="select-beast" class="form-control custom-select" required>
						<option value="<?php echo $rowsqqz['sup_id']; ?>" selected><?php echo $rowsqqz['sup_name']; ?></option>
						<?php $sql = mysqli_query($conn,"SELECT * FROM supplier_details order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$sup_id=$rowsqq['sup_id'];
														$sup_name=$rowsqq['sup_name'];
												?>
													<option value="<?php echo "$sup_id";?>"><?php echo "$sup_id - $sup_name";?></option>
													<?php } ?>	
						
						
						</select>
					    </div>
                      </div>
					   <div class="col-md-4 col-xl-6">
						
                         <div class="mb-3">
						<label class="form-label">Purchase Manager Name</label>
						<?php 
						$emp_ids=$rowsqqd['emp_id'];
						$sqlza = mysqli_query($conn,"SELECT * FROM employee_details where emp_id='$emp_ids' order by id asc");
												$rowsqqza = mysqli_fetch_assoc($sqlza);
						?> 
						<select name="emp_id"  id="select-beast" class="form-control custom-select" required>
						<option value="<?php echo $rowsqqza['emp_id']; ?>" selected><?php echo $rowsqqza['emp_name']; ?></option>
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
						<label class="form-label">Date of Delivery<span class="form-required">*</span></label>
						<?php date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	?>
                              <input id="calendar-simple" name="dateofdelivery" type="date"  min="<?php echo $date; ?>" value="<?php echo $rowsqqd['dateofdelivery']; ?>" class="form-control mb-2" placeholder="Select a date" />
                        
					   </div>
					</div>
</div>						
</div>	
<div class="col-xl-6">
                      <div class="row">
                 
					   <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Vechicle Name<span class="form-required">*</span></label>
                            <input type="text" name="vechicle_name" value="<?php echo $rowsqqd['vechicle_name']; ?>" class="form-control" autofocus autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Vechicle No.<span class="form-required">*</span></label>
                            <input type="text" name="vechicle_no" value="<?php echo $rowsqqd['vechicle_no']; ?>" class="form-control" autofocus autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Payment Status<span class="form-required">*</span></label>
                            <select name="payment_status"  id="select-beast" class="form-control custom-select">
						<option value="<?php echo $rowsqqd['payment_status']; ?>" selected><?php echo $rowsqqd['payment_status']; ?></option>
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
                         <select name="payment_mode"  id="select-beast" class="form-control custom-select">
						<option value="<?php echo $rowsqqd['payment_mode']; ?>" selected><?php echo $rowsqqd['payment_mode']; ?></option>
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
                        <input type="text" name="payment_details" value="<?php echo $rowsqqd['payment_details']; ?>" class="form-control" autofocus autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-4 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Feedback About the Loads<span class="form-required">*</span></label>
                              <textarea class="form-control" name="feedback" data-toggle="autosize" placeholder="Comments…"><?php echo $rowsqqd['feedback']; ?></textarea>
                      </div>
                        </div>
                      </div>
</div>						
</div>						
</div>		
</table>				
  <div class="card-footer text-right">
  <div class="d-flex">
  
     <a href="view_raw_material.php" class="btn btn-link">Cancel</a>
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