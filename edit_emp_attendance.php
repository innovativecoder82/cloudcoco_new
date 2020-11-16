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
	$emp_password1 = encryptIt($emp_password);
	
	$query = mysqli_query($conn,"update emp_attendance set department='$department', daily_wage='$daily_wage', dailydate='$dailydate', working_hours='$working_hours', payment_status='$payment_status', half_day_shift='$half_day_shift', comments='$comments', monthly_salary='$monthly_salary', advance_amt='$advance_amt', advance_repayment='$advance_repayment', additional_hours_wage='$additional_hours_wage', reason_additional_hours='$reason_additional_hours' where id='$id'");

	echo'<script>alert("Successfully Added..!");window.location.href="view_emp_attendance.php";</script>';
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
                    <h3 class="card-title">Edit Employee Attendance</h3>
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
                <a href="view_emp_attendance.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </a>
              </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                     <div class="col-xl-4">
                      <div class="row">
                    <?php
					$query1= mysqli_query($conn,"SELECT * FROM emp_attendance where id='$id' ORDER BY `id` DESC");
					$rows = mysqli_fetch_assoc($query1);
					$em_id=$rows['emp_id'];
					$sqlx = mysqli_query($conn,"SELECT * FROM employee_details where emp_id='$em_id' order by id asc");
					$rowsqqx = mysqli_fetch_assoc($sqlx)
					
					 ?>
					  <div class="col-md-6 col-xl-12">
						
                         <div class="mb-3">
						<label class="form-label">Employee Name</label>
						 <input id="calendar-simple" name="emp_id" type="text" value="<?php echo $rowsqqx['emp_name']; ?>" class="form-control mb-2" placeholder="Select a date" readonly />
						
					    </div>
                      </div>
					 <div class="col-md-6 col-xl-12">
                      <div class="mb-3">
						<label class="form-label">Date <span class="form-required">*</span></label>
						 <?php  date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa'); ?>
                              <input id="calendar-simple" name="dailydate" type="date" min="<?php echo $date; ?>" value="<?php echo $rows['dailydate']; ?>" class="form-control mb-2" placeholder="Select a date" />
                        
					   </div>
					</div>
					 <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                         <div class="mb-3">
						<label class="form-label">Department</label>
						<select name="department"  id="select-beast1" class="form-control custom-select">
						<option value="<?php echo $rows['department']; ?>" selected><?php echo $rows['department']; ?></option>
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
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Working Hours<span class="form-required">*</span></label>
                            <input type="text" name="working_hours" value="<?php echo $rows['working_hours']; ?>" class="form-control" autocomplete="off"/>
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
                           <select name="half_day_shift" id="select-beast2" class="form-control custom-select">
						<option value="<?php echo $rows['half_day_shift']; ?>" selected><?php echo $rows['half_day_shift']; ?></option>
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
                            <input type="text" name="daily_wage" value="<?php echo $rows['daily_wage']; ?>" class="form-control" autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                           <label class="form-label">Monthly Salary<span class="form-required">*</span></label>
                            <input type="text" name="monthly_salary" value="<?php echo $rows['monthly_salary']; ?>" class="form-control" autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="row">
					  <div class="col-md-6 col-xl-12">
					  <div class="row">
					  <div class="col-md-6 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                           <label class="form-label">Advance Amount<span class="form-required">*</span></label>
                            <input type="text" name="advance_amt" value="<?php echo $rows['advance_amt']; ?>" class="form-control" readonly autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6 col-xl-6">
						<div class="mb-3">
                          <div class="mb-3">
                           <label class="form-label">Advance Repayment<span class="form-required">*</span></label>
                            <input type="text" name="advance_repayment" value="<?php echo $rows['advance_repayment']; ?>" readonly class="form-control" autocomplete="off"/>
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
                            <input type="text" name="additional_hours_wage" value="<?php echo $rows['additional_hours_wage']; ?>" class="form-control" autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                           <label class="form-label">Reason for Additional Hours<span class="form-required">*</span></label>
                            <input type="text" name="reason_additional_hours" value="<?php echo $rows['reason_additional_hours']; ?>" class="form-control" autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Payment Status<span class="form-required">*</span></label>
                           <select name="payment_status" id="select-beast2" class="form-control custom-select">
						<option value="<?php echo $rows['payment_status']; ?>" selected><?php echo $rows['payment_status']; ?></option>
						<option value="Paid" >Paid</option>
						<option value="Pending" >Pending</option>
						</select>
                          </div>
                        </div>
                      </div>
					
                      <div class="col-md-6 col-xl-12">
                       
                        <div class="mb-3">
                          <label class="form-label">Comments</label>
                          <textarea class="form-control" name="comments" data-toggle="autosize" placeholder="Comments…"><?php echo $rows['comments']; ?></textarea>
                        </div>
                      </div>
					    
					</div>
					</div>
        
          </div>
          </div>
		  <div class="card-footer text-right">
  <div class="d-flex">
    <a href="view_emp_attendance.php" class="btn btn-link">Cancel</a>
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