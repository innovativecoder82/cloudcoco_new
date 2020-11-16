<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');



extract($_POST);
if(isset($submit)){
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	$emp_password1 = encryptIt($emp_password);
	$query = mysqli_query($conn,"INSERT INTO emp_attendance (emp_id, department, daily_wage, dailydate, working_hours, payment_status, half_day_shift, comments, monthly_salary, advance_amt, advance_repayment, additional_hours_wage, reason_additional_hours, date) VALUES('$emp_id','$department','$daily_wage','$dailydate','$working_hours','$payment_status','$half_day_shift','$comments','$monthly_salary','$advance_amt','$advance_repayment','$additional_hours_wage','$reason_additional_hours','$date')");
	
	$query1r= mysqli_query($conn,"SELECT * FROM overall_advance_pay_repay where emp_id='$emp_id' ORDER BY `id` DESC");
	$rowsr = mysqli_fetch_assoc($query1r);
		$overall_advance_amt= $rowsr['overall_advance_amt'];		
		$overall_advance_repayment=	$rowsr['overall_advance_repayment'];
		$sub_advance_amt=$overall_advance_repayment+$advance_repayment;
	
	$query = mysqli_query($conn,"update overall_advance_pay_repay set overall_advance_repayment='$sub_advance_amt', date='$dailydate' where emp_id='$emp_id'");
	$query11 = mysqli_query($conn,"INSERT INTO advance_pay_repay (emp_id, advance_repayment, repayment_date, date) VALUES('$emp_id','$sub_advance_amt','$dailydate','$dailydate')");
	
	
	echo'<script>alert("Successfully Added..!");window.location.href="add_emp_attendance.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('add_emp_attendance'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
          <div class="row">
              <div class="col-12">
                <form method="post" class="card">
                  <div class="card-header">
                    <h3 class="card-title">Employee Attendance</h3>
					 <div class="col-auto ml-auto d-print-none">
				   
                <span class="d-none d-sm-inline">
                  <a href="view_emp_attendance.php" class="btn btn-secondary">
                    View
                  </a>
                </span>
                <a href="add_emp_attendance.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
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
						<?php
						$emid=$_GET['empid'];
							if(isset($emid)){
						
						$sqln = mysqli_query($conn,"SELECT * FROM employee_details where emp_id='$emid' order by id asc");
												$rowsqqn = mysqli_fetch_assoc($sqln);
												
						?>
						<select name="emp_id"  id="select-beast" class="form-control custom-select" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" required>
						<option value="<?php echo $rowsqqn['emp_id'];?>" selected><?php echo $rowsqqn['emp_name'];?></option>
						<?php $sql = mysqli_query($conn,"SELECT * FROM employee_details order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$emp_id=$rowsqq['emp_id'];
														$emp_name=$rowsqq['emp_name'];
												?>
													<option value="add_emp_attendance.php?empid=<?php echo "$emp_id";?>"><?php echo "$emp_id - $emp_name";?></option>
													<?php } ?>	
						</select>
						<?php }else{ ?>
						<select name="emp_id"  id="select-beast" class="form-control custom-select" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" required>
						<option value="" selected>Select Employee Name</option>
						<?php $sql = mysqli_query($conn,"SELECT * FROM employee_details order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$emp_id=$rowsqq['emp_id'];
														$emp_name=$rowsqq['emp_name'];
												?>
													<option value="add_emp_attendance.php?empid=<?php echo "$emp_id";?>"><?php echo "$emp_id - $emp_name";?></option>
													<?php } ?>	
						</select>
						<?php } ?>
					    </div>
                      </div>
					 <div class="col-md-6 col-xl-12">
                      <div class="mb-3">
						<label class="form-label">Date <span class="form-required">*</span></label>
						 <?php 
					  date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	?>
                              <input id="calendar-simple" name="dailydate" type="date" min="<?php echo $date; ?>" value="<?php echo $date; ?>" class="form-control mb-2" placeholder="Select a date" />
                        
					   </div>
					</div>
					 <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                         <div class="mb-3">
						<label class="form-label">Department</label>
						<select name="department"  id="select-beast1" class="form-control custom-select" required>
						<option value="" selected>Select Department</option>
						<option value="Fiber" >Fiber</option>
						<option value="Pith Block" >Pith Block</option>
						<option value="Yarn" >Yarn</option>
						</select>
						 </div>
                        </div>
                      </div>
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Working Hours<span class="form-required">*</span></label>
                            <input type="text" name="working_hours" class="form-control" autocomplete="off"/>
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
                            <label class="form-label">Half Day Shift<span class="form-required">*</span></label>
                           <select name="half_day_shift" id="select-beast2" class="form-control custom-select" required>
						<option value="" selected>Select Shift</option>
						<option value="Yes" >Yes</option>
						<option value="No" >No</option>
						</select>
                          </div>
                        </div>
                      </div> 
					<div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                           <label class="form-label">Daily Wage<span class="form-required">*</span></label>
                            <input type="text" name="daily_wage" class="form-control" autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                           <label class="form-label">Monthly Salary<span class="form-required">*</span></label>
                            <input type="text" name="monthly_salary" class="form-control" autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="row">
					  <div class="col-md-6 col-xl-12">
					  <div class="row">
					  <div class="col-md-6 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
						  		<?php 
								$empid=$_GET['empid'];
								$sqld = mysqli_query($conn,"SELECT * FROM overall_advance_pay_repay where emp_id='$empid' order by id asc");
												$rowsqqd = mysqli_fetch_assoc($sqld);
													
														$overall_advance_amt=$rowsqqd['overall_advance_amt'];
														$overall_advance_repayment=$rowsqqd['overall_advance_repayment'];
														$tot_adva= $overall_advance_amt-$overall_advance_repayment;
													
												?>
                           <label class="form-label">Advance Amount<span class="form-required">*</span></label>
                            <input type="text" name="advance_amt" class="form-control" value="<?php echo $tot_adva; ?>" readonly autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                           <label class="form-label">Advance Repayment<span class="form-required">*</span></label>
                            <input type="text" name="advance_repayment" class="form-control" autocomplete="off"/>
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
                           <label class="form-label">Additional Hours Wage<span class="form-required">*</span></label>
                            <input type="text" name="additional_hours_wage" class="form-control" autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                           <label class="form-label">Reason for Additional Hours<span class="form-required">*</span></label>
                            <input type="text" name="reason_additional_hours" class="form-control" autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Payment Status<span class="form-required">*</span></label>
                           <select name="payment_status" id="select-beast2" class="form-control custom-select" required>
						<option value="" selected>Select Payment</option>
						<option value="Paid" >Paid</option>
						<option value="Pending" >Pending</option>
						</select>
                          </div>
                        </div>
                      </div>
					
                      <div class="col-md-6 col-xl-12">
                       
                        <div class="mb-3">
                          <label class="form-label">Comments</label>
                          <textarea class="form-control" name="comments" data-toggle="autosize" placeholder="Comments…"></textarea>
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
</html>