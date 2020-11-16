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
	
	$query = mysqli_query($conn,"update daily_expenses set expenses_details='$expenses_details', exp_date='$exp_date', amount='$amount', paid_status='$paid_status', paid_through='$paid_through', account_holder='$account_holder', account_details='$account_details' where id='$id'");

	
	echo'<script>alert("Successfully Updated..!");window.location.href="view_daily_expenses.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('add_daily_expenses'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
          <div class="row">
              <div class="col-12">
                <form method="post" class="card">
                  <div class="card-header">
                    <h3 class="card-title">Daily Expenses</h3>
					 <div class="col-auto ml-auto d-print-none">
				   
                <span class="d-none d-sm-inline">
                  <a href="view_daily_expenses.php" class="btn btn-secondary">
                    View
                  </a>
                </span>
                <a href="add_daily_expenses.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Daily Expenses 
                </a>
                <a href="add_daily_expenses.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
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
					$query1= mysqli_query($conn,"SELECT * FROM daily_expenses where id='$id' ORDER BY `id` DESC");
					$rows = mysqli_fetch_assoc($query1);
					 ?>
                          <label class="form-label">Expenses Details</label>
                          <textarea class="form-control" name="expenses_details" data-toggle="autosize" placeholder="Expenses Details"><?php echo $rows['expenses_details']; ?></textarea>
                        </div>
                      </div> 
					<div class="col-md-6 col-xl-12">
                      <div class="mb-3">
					  <?php 
					  date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	?>
						<label class="form-label">Date<span class="form-required">*</span></label>
                              <input id="calendar-simple" name="exp_date" type="date" min="<?php echo $date; ?>" value="<?php echo $rows['exp_date']; ?>" class="form-control mb-2" placeholder="Select a date" required />
                        
					   </div>
					</div>
				    </div>
                  </div>
                  <div class="col-xl-4">
                    <div class="row">
						<div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Amount<span class="form-required">*</span></label>
                            <input type="text" name="amount" value="<?php echo $rows['amount']; ?>" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
						<div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Paid Status<span class="form-required">*</span></label>
                            <input type="text" name="paid_status" value="<?php echo $rows['paid_status']; ?>" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>					  
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Paid Through Account?<span class="form-required">*</span></label>
                           <select name="paid_through"  id="select-beast"  class="form-control custom-select" required>
						<option value="<?php echo $rows['paid_through']; ?>" selected><?php echo $rows['paid_through']; ?></option>
						<option value="Yes" >Yes</option>
						<option value="No" >No</option>
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
                            <label class="form-label">Account Holder Name<span class="form-required">*</span></label>
                            <input type="text" name="account_holder" value="<?php echo $rows['account_holder']; ?>" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					<div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                          <label class="form-label">Account Details</label>
                          <textarea class="form-control" name="account_details" data-toggle="autosize" placeholder="Account Details"><?php echo $rows['account_details']; ?></textarea>
                        </div>
                      </div>
					    
					</div>
					</div>
        
          </div>
          </div>
		  <div class="card-footer text-right">
  <div class="d-flex">
    <a href="view_daily_expenses.php" class="btn btn-link">Cancel</a>
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