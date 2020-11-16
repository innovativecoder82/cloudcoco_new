<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');



extract($_POST);
if(isset($submit)){
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	if(($advance_amt>0) or ($advance_repayment>0))
	{
	$query11 = mysqli_query($conn,"INSERT INTO advance_pay_repay (emp_id, advance_amt, payment_date, advance_repayment, repayment_date, date) VALUES('$emp_id','$advance_amt','$payment_date','$advance_repayment','$repayment_date','$date')");
	
	$query1r= mysqli_query($conn,"SELECT * FROM overall_advance_pay_repay where emp_id='$emp_id' ORDER BY `id` DESC");
	$rowsr = mysqli_fetch_assoc($query1r);
		$overall_advance_amt= $rowsr['overall_advance_amt'];		
		$overall_advance_repayment=	$rowsr['overall_advance_repayment'];
		$add_advance_amt=$overall_advance_amt+$advance_amt;
		$sub_advance_amt=$overall_advance_repayment+$advance_repayment;
	$query = mysqli_query($conn,"update overall_advance_pay_repay set overall_advance_amt='$add_advance_amt', overall_advance_repayment='$sub_advance_amt', date='$date' where emp_id='$emp_id'");
	
	echo'<script>alert("Successfully Added..!");window.location.href="add_advance.php";</script>';
	}else
	{
	echo'<script>alert("Please Enter Correctly..!");window.location.href="add_advance.php";</script>';
		
	}
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('add_advance'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
          <div class="row">
              <div class="col-12">
                <form method="post" class="card">
                  <div class="card-header">
                    <h3 class="card-title">Advance Amount</h3>
					 <div class="col-auto ml-auto d-print-none">
				   
                <span class="d-none d-sm-inline">
                  <a href="view_advance.php" class="btn btn-secondary">
                    View
                  </a>
                </span>
                <a href="add_advance.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Create new 
                </a>
                <a href="#" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
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
						<label class="form-label">Employee Name</label>
						<select name="emp_id"  id="select-beast" class="form-control custom-select" required>
						<option value="" selected>Select Employee Name</option>
						<?php $sql = mysqli_query($conn,"SELECT * FROM employee_details order by id asc");
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
					 
					
                    </div>
                  </div>
                  <div class="col-xl-4">
                    <div class="row">
					 <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Advance Payment<span class="form-required">*</span></label>
                            <input type="text" name="advance_amt" class="form-control" autocomplete="off" />
                          </div>
                        </div>
                      </div>
					 <div class="col-md-6 col-xl-12">
                      <div class="mb-3">
						<label class="form-label">Payment Date<span class="form-required">*</span></label>
							  <?php date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	?>
                              <input id="calendar-simple" name="payment_date" type="date" min="<?php echo $date; ?>" class="form-control mb-2" placeholder="Select a date"  />
                        
					   </div>
					</div>
					 
                    </div>
                  </div>
                  <div class="col-xl-4">
                    <div class="row">
					 <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Advance RePayment<span class="form-required">*</span></label>
                            <input type="text" name="advance_repayment" class="form-control" autocomplete="off" />
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6 col-xl-12">
                      <div class="mb-3">
						<label class="form-label">RePayment Date<span class="form-required">*</span></label>
						<?php date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	?>
                              <input id="calendar-simple" name="repayment_date" type="date" min="<?php echo $date; ?>" class="form-control mb-2" placeholder="Select a date"  />
                        
					   </div>
					</div>
					  
					</div>
					</div>
        
          </div>
          </div>
		  <div class="card-footer text-right">
  <div class="d-flex">
    <a href="add_advance.php" class="btn btn-link">Cancel</a>
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