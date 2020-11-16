<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');



extract($_POST);
if(isset($submit)){
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
 $query1k= mysqli_query($conn,"SELECT * FROM product where prod_name='$prod_name' and quality='$quality' ORDER BY `id` DESC");
 $rowsk = mysqli_fetch_assoc($query1k);
 $pr_id=$rowsk['id'];
 $stk=$rowsk['stock'];
 $totwgt=$rowsk['total_weight'];
 $tot_stk=$stk-$quantity;
 $tot_stk1=$totwgt-$total_weight;
 
	if($price>=$paid_amount)	
	{		
 if($stk>=$quantity)	
	{
 $query = mysqli_query($conn,"update product set stock='$tot_stk', total_weight='$tot_stk1' where id='$pr_id'");
	
	$query = mysqli_query($conn,"INSERT INTO sales (sal_id, sal_id1, prod_name, quality, sale_date, quantity, weight, total_weight, price, sold_status, buyer_name, buyer_vehicle_no, payment_mode, payment_details, paid_amount, approve_name, comments, date) VALUES('$sal_id','$sal_id1','$prod_name','$quality','$sale_date','$quantity','$weight','$total_weight','$price','$sold_status','$buyer_name','$buyer_vehicle_no','$payment_mode','$payment_details','$paid_amount','$approve_name','$comments','$date')");
	$query = mysqli_query($conn,"INSERT INTO buyer_paid_details (sal_id,paid_amount, date) VALUES('$sal_id','$paid_amount','$date')");
	
	echo'<script>alert("Successfully Added..!");window.location.href="add_sales.php";</script>';
	}	
	else{
	echo'<script>alert("Stock is Less. Please Update..!");window.location.href="add_sales.php";</script>';
		
	}
	}else{
	echo'<script>alert("Paid Amount is high..!");window.location.href="add_sales.php";</script>';
	}
	
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
                    <h3 class="card-title">Sales</h3>
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
                       <div class="col-md-6 col-xl-12">
						<div class="mb-3">
						<?php
					$query1= mysqli_query($conn,"SELECT * FROM sales ORDER BY `id` DESC");
					$rows = mysqli_fetch_assoc($query1);
					$sal_id1= $rows['id'];
					$sal_id2=$sal_id1+1;
				  ?>
                          <div class="mb-3">
                            <label class="form-label">Sale Id<span class="form-required">*</span></label>
                            <input type="text" name="sal_id" class="form-control" Value="<?php  printf("SAL%06d", $sal_id2);?>" autocomplete="off"/ readonly>
                            <input type="hidden" name="sal_id1" class="form-control" value="<?php echo $sal_id2;?>" autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Product<span class="form-required">*</span></label>
                            <?php  $prod=$_GET['prod'];
                            $qua=$_GET['qua'];
							if(isset($prod)){ ?>
							  <select name="prod_name"  id="select-beast" class="form-control custom-select"  onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);"  required>
						<option value="<?php echo "$prod";?>" selected><?php echo "$prod";?></option>
						<?php $sql = mysqli_query($conn,"SELECT * FROM product order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$prod_name=$rowsqq['prod_name'];
												?>
													<option value="add_sales.php?prod=<?php echo "$prod_name";?>"><?php echo $prod_name;?></option>
													<?php } ?>	
						</select>
						<?php }else{ ?>
						  <select name="prod_name"  id="select-beast" class="form-control custom-select"  onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);"  required>
						<option value="" selected>Select Product</option>
						<?php $sql = mysqli_query($conn,"SELECT * FROM product order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$prod_name=$rowsqq['prod_name'];
												?>
													<option value="add_sales.php?prod=<?php echo "$prod_name";?>"><?php echo $prod_name;?></option>
													<?php } ?>	
						</select>
						<?php } ?>
						
                          </div>
                        </div>
                      </div>
					   <?php  
							if((($prod=='White Fiber') or ($prod=='Brown Fiber'))){ ?>
               <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Quality<span class="form-required">*</span></label>
                          
							  <select name="quality"  id="select-beast" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class="form-control custom-select" required>
						<option value="<?php echo "$qua";?>" selected><?php echo "$qua";?></option>
						<option value="add_sales.php?prod=<?php echo "$prod";?>&&qua=TwoPly">TwoPly</option>
						<option value="add_sales.php?prod=<?php echo "$prod";?>&&qua=Export">Export</option>
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
                              <input id="calendar-simple" name="sale_date" type="date" min="<?php echo $date; ?>" value="<?php echo $date; ?>" class="form-control mb-2" placeholder="Select a date" required />
                        
					   </div>
					</div>
					   <div class="row">
        <div class="col-md-6 col-xl-12">
                      <div class="row">
					  <div class="col-md-6 col-xl-4">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Stock<span class="form-required">*</span></label>
							<?php  $prod=$_GET['prod'];
							
							$sqlz = mysqli_query($conn,"SELECT * FROM product where prod_name='$prod' and quality='$qua' order by id asc");
												$rowsqqz = mysqli_fetch_assoc($sqlz);
												
							?>
                            <input type="number" name="stok"id="stok" class="form-control" value="<?php echo $rowsqqz['stock']; ?>" oninput="add_number()" autocomplete="off" readonly />
                          </div>
                        </div>
						
						
                      </div>
					    <div class="col-md-6 col-xl-4">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Quantity<span class="form-required">*</span></label>
                            <input type="number" name="quantity"id="quantity" class="form-control" oninput="add_number()" autocomplete="off" required/>
                          </div>
                        </div>
						
						
                      </div>
					    <div class="col-md-6 col-xl-4">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Weight<span class="form-required">*</span></label>
                            <input type="number" name="weight" id="weight" class="form-control" value="35" readonly oninput="add_number()" autocomplete="off" required/>
                          </div>
                        </div>
						
						
                      </div>
					    <div class="col-md-6 col-xl-4">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Total Weight<span class="form-required">*</span></label>
                            <input type="number" name="total_weight"id="total_weight" class="form-control" oninput="add_number()" autocomplete="off" required/>
                          </div>
                        </div>
						
						
                      </div>
					 <div class="col-md-6 col-xl-4">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Price/Quantity<span class="form-required">*</span></label>
                            <input type="text" name="price" class="form-control" autocomplete="off" required/>
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
                            <label class="form-label">Payment Status<span class="form-required">*</span></label>
                        	  <select name="sold_status"  id="select-beast" class="form-control custom-select" required>
						<option value="Pending" selected>Pending</option>
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
						<option value="" selected>Select Buyer</option>
						<?php $sql = mysqli_query($conn,"SELECT * FROM buyer order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$buyer_id=$rowsqq['buy_id'];
														$buyer_name=$rowsqq['buy_name'];
												?>
													<option value="<?php echo "$buyer_id";?>"><?php echo $buyer_name;?></option>
													<?php } ?>	
						</select>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Buyer Vehicle No.<span class="form-required">*</span></label>
                            <input type="text" name="buyer_vehicle_no" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					    <div class="col-md-6 col-xl-12">
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
					
                    </div>
                  </div>
                  <div class="col-xl-4">
                    <div class="row">
					
					
					    <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Payment Details<span class="form-required">*</span></label>
                            <input type="text" name="payment_details" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					    <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Paid Amount<span class="form-required">*</span></label>
                            <input type="number" name="paid_amount" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					      <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Approve Name<span class="form-required">*</span></label>
                            <input type="text" name="approve_name" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					 
					<div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Comments<span class="form-required">*</span></label>
                                 <textarea class="form-control" name="comments" data-toggle="autosize" placeholder="Enter Comments…"></textarea>
                     
                          </div>
                        </div>
                      </div>
					</div>
					</div>
        
          </div>
          </div>
		  <div class="card-footer text-right">
  <div class="d-flex">
    <a href="add_employee.php" class="btn btn-link">Cancel</a>
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
			  	<script>	  
			  
			  function add_number() {
                   
  var quantity = parseInt(document.getElementById("quantity").value);
  var weight = parseInt(document.getElementById("weight").value);
  var stok = parseInt(document.getElementById("stok").value);
  var result = quantity * weight;
  var resulta = stok - quantity;
 
  document.getElementById("total_weight").value = result;
  
}

</script>
</html>