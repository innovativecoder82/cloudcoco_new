<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');

$id=$_GET['id'];

extract($_POST);
if(isset($submit)){
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	
	$query1ks= mysqli_query($conn,"SELECT * FROM sales where id='$id' ORDER BY `id` DESC");
	$rowsks = mysqli_fetch_assoc($query1ks);
	$salid=$rowsks['sal_id'];
	$prod=$rowsks['prod_name'];
	$qual=$rowsks['quality'];
	$pri=$rowsks['price'];
	$paid_amt=$rowsks['paid_amount'];
	
	$query1k= mysqli_query($conn,"SELECT * FROM product where prod_name='$prod' ORDER BY `id` DESC");
 $rowsk = mysqli_fetch_assoc($query1k);
 
 $pr_id=$rowsk['id'];
 $stk=$rowsk['stock'];
 $tot_stk=$stk+$oldtot;
 $fin_tot=$tot_stk-$quantity;
 

		$query = mysqli_query($conn,"update sales set sold_status='$sold_status', buyer_name='$buyer_name', buyer_vehicle_no='$buyer_vehicle_no', payment_mode='$payment_mode', payment_details='$payment_details', paid_amount='$paid_amount', approve_name='$approve_name', comments='$comments', date='$date' where id='$id'");
$query = mysqli_query($conn,"INSERT INTO buyer_paid_details (sal_id,paid_amount, date) VALUES('$sal_id','$paid_amount','$date')");
	
	echo'<script>alert("Successfully Updated..!");window.location.href="view_sales.php";</script>';

	}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('add_sales'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
          <div class="row">
              <div class="col-12">
                <form method="post" class="card">
                  <div class="card-header">
                    <h3 class="card-title">Edit Sales</h3>
					 <div class="col-auto ml-auto d-print-none">
				   
                <span class="d-none d-sm-inline">
                  <a href="view_Sales.php" class="btn btn-secondary">
                    View
                  </a>
                </span>
                <a href="add_sales.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Create new 
                </a>
                <a href="add_sales.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </a>
              </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                     <div class="col-xl-4">
                      <div class="row">
                     <?php
					$query1= mysqli_query($conn,"SELECT * FROM sales where id='$id' ORDER BY `id` DESC");
					$rows = mysqli_fetch_assoc($query1);
					 ?>
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Product<span class="form-required">*</span></label>
                              <select name="prod_name"  id="select-beast" class="form-control custom-select" readonly>
						<option value="<?php echo $rows['prod_name']; ?>" selected><?php echo $rows['prod_name']; ?></option>
						
						</select>
                          </div>
                        </div>
                      </div>
					  <?php  
							if((($rows['quality']=='White Fiber') or ($rows['quality']=='Brown Fiber'))){ ?>
               <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Quality<span class="form-required">*</span></label>
                          
							  <select name="quality"  id="select-beast"  class="form-control custom-select" required readonly>
						<option value="<?php echo $rows['quality'];?>" selected><?php echo $rows['quality'];?></option>
						</select>
					      </div>
                        </div>
                      </div>
						<?php }else{} ?>
					  <div class="col-md-6 col-xl-12">
                      <div class="mb-3">
					  <?php date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	?>
						<label class="form-label">Sale Date<span class="form-required">*</span></label>
                              <input id="calendar-simple" name="sale_date" type="date" value="<?php echo $rows['sale_date']; ?>" class="form-control mb-2" placeholder="Select a date" readonly required />
                        
					   </div>
					</div>
					   <div class="row">
        <div class="col-md-6 col-xl-12">
                      <div class="row">
					  <div class="col-md-6 col-xl-4">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Stock<span class="form-required">*</span></label>
							<?php  $prod=$rows['prod_name'];
							
							$sqlz = mysqli_query($conn,"SELECT * FROM product where prod_name='".$rows['prod_name']."' and quality='".$rows['quality']."' order by id asc");
												$rowsqqz = mysqli_fetch_assoc($sqlz);
												
							?>
                            <input type="text" name="stok" class="form-control" value="<?php echo $rowsqqz['stock']; ?>" autocomplete="off" readonly />
                          </div>
                        </div>
						
						
                      </div>
					  <div class="col-md-6 col-xl-4">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Quantity<span class="form-required">*</span></label>
                            <input type="text" name="quantity" class="form-control" value="<?php echo $rows['quantity']; ?>" autocomplete="off" readonly required/>
                          </div>
                        </div>
						
						
                      </div>
					  	    <div class="col-md-6 col-xl-4">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Weight<span class="form-required">*</span></label>
                            <input type="number" name="weight" id="weight" class="form-control" value="<?php echo $rows['weight']; ?>" readonly oninput="add_number()" autocomplete="off" required/>
                          </div>
                        </div>
						
						
                      </div>
					    <div class="col-md-6 col-xl-4">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Total Weight<span class="form-required">*</span></label>
                            <input type="number" name="total_weight"id="total_weight" class="form-control" value="<?php echo $rows['total_weight']; ?>" oninput="add_number()" autocomplete="off" readonly required/>
                          </div>
                        </div>
						
						
                      </div>
					
					 <div class="col-md-6 col-xl-4">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Price/Quantity<span class="form-required">*</span></label>
                            <input type="text" name="price" class="form-control" value="<?php echo $rows['price']; ?>" autocomplete="off" readonly required/>
                          </div>
                        </div>
                      </div>
                      </div>
                      </div>
                      </div>
					   					  
					 
                    </div>
                  </div>
                  <div class="col-xl-4">
                    <div class="row">
					  
					    <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Sold Status<span class="form-required">*</span></label>
                            <select name="sold_status"  id="select-beast" class="form-control custom-select" required>
						<option value="<?php echo $rows['sold_status']; ?>" ><?php echo $rows['sold_status']; ?></option>
						<option value="Pending" >Pending</option>
						<option value="Done" >Done</option>
						</select>
					       </div>
                        </div>
                      </div>
					    <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Buyer Name<span class="form-required">*</span></label>
                           <select name="buyer_name"  id="select-beast" class="form-control custom-select" required>
						  <?php $sxql = mysqli_query($conn,"SELECT * FROM buyer where buy_id='".$rows['buyer_name']."'order by id asc");
												$rowxsqq = mysqli_fetch_assoc($sxql); ?>
						<option value="<?php echo $rowxsqq['buy_id'];?>" selected><?php echo $rowxsqq['buy_name'];?></option>
						
						</select>
					      </div>
                        </div>
                      </div>
					   <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Buyer Vehicle No.<span class="form-required">*</span></label>
                            <input type="text" name="buyer_vehicle_no" value="<?php echo $rows['buyer_vehicle_no']; ?>" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					    <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Payment Mode<span class="form-required">*</span></label>
							  <select name="payment_mode"  id="select-beast" class="form-control custom-select">
						<option value="<?php echo $rows['payment_mode']; ?>" selected><?php echo $rows['payment_mode']; ?></option>
						<option value="Cash" >Cash</option>
						<option value="Netbanking" >Netbanking</option>
						<option value="Cheque" >Cheque</option>
						</select>
                          </div>
                        </div>
                      </div>
					
                    </div>
                  </div>
                  <div class="col-xl-4">
                    <div class="row">
					
					
					    <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Payment Details<span class="form-required">*</span></label>
                            <input type="text" name="payment_details" value="<?php echo $rows['payment_details']; ?>" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					    <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Paid Amount<span class="form-required">*</span></label>
                            <input type="text" name="paid_amount" value="<?php echo $rows['paid_amount']; ?>" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					      <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Approve Name<span class="form-required">*</span></label>
                            <input type="text" name="approve_name" value="<?php echo $rows['approve_name']; ?>" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					 
					<div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Comments<span class="form-required">*</span></label>
                                 <textarea class="form-control" name="comments" data-toggle="autosize" placeholder="Enter Comments…"><?php echo $rows['comments']; ?></textarea>
                     
                          </div>
                        </div>
                      </div>
					</div>
					</div>
        
          </div>
          </div>
		  <div class="card-footer text-right">
  <div class="d-flex">
    <a href="view_Sales.php" class="btn btn-link">Cancel</a>
    <button type="submit" name="submit" class="btn btn-primary ml-auto">Submit</button>
  </div>
</div>
</form>
          </div>
          </div>
          </div>
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