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
	$query = mysqli_query($conn,"INSERT INTO employee_details (emp_id, emp_id1, emp_name, emp_role, department, dateofjoining, wage, emp_status, address, emp_phone, emp_mobile, emp_emailid, comments, emp_password, salary, date) VALUES('$emp_id','$emp_id1','$emp_name','$emp_role','$department','$dateofjoining','$wage','$emp_status','$address','$emp_phone','$emp_mobile','$emp_emailid','$comments','$emp_password1','$salary','$date')");
	$query11 = mysqli_query($conn,"INSERT INTO admin (username, password, firstname, role, created_on) VALUES('$emp_id','$emp_password1','$emp_name','$emp_role','$date')");
	
	$query11 = mysqli_query($conn,"INSERT INTO overall_advance_pay_repay (emp_id, overall_advance_amt, overall_advance_repayment, date) VALUES('$emp_id','','','$date')");
	
	echo'<script>alert("Successfully Added..!");window.location.href="add_employee.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('add_employee'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
          <div class="row">
              <div class="col-12">
                <form method="post" class="card">
                  <div class="card-header">
                    <h3 class="card-title">Employee</h3>
					 <div class="col-auto ml-auto d-print-none">
				   
                <span class="d-none d-sm-inline">
                  <a href="view_employee.php" class="btn btn-secondary">
                    View
                  </a>
                </span>
                <a href="add_employee.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
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
						<?php
					$query1= mysqli_query($conn,"SELECT * FROM employee_details ORDER BY `id` DESC");
					$rows = mysqli_fetch_assoc($query1);
					$emp_id1= $rows['id'];
					$emp_id2=$emp_id1+1;
				  ?>
                          <div class="mb-3">
                            <label class="form-label">Employee Id<span class="form-required">*</span></label>
                            <input type="text" name="emp_id" class="form-control" Value="<?php  printf("EMP%06d", $emp_id2);?>" autocomplete="off"/ readonly>
                            <input type="hidden" name="emp_id1" class="form-control" value="<?php echo $emp_id;?>" autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Employee Name<span class="form-required">*</span></label>
                            <input type="text" name="emp_name" class="form-control" autofocus autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					  <div class="col-md-6 col-xl-12">
						
                         <div class="mb-3">
						<label class="form-label">Employee Role</label>
						<select name="emp_role"  id="select-beast" class="form-control custom-select" required>
						<option value="" selected>Select Employee Role</option>
						<?php $sql = mysqli_query($conn,"SELECT * FROM role order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$emp_role=$rowsqq['emp_role'];
												?>
													<option value="<?php echo "$emp_role";?>"><?php echo $emp_role;?></option>
													<?php } ?>	
						</select>
					    </div>
                      </div>
					   <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                         <div class="mb-3">
						<label class="form-label">Department</label>
						<select name="department"  id="select-beast1" class="form-control custom-select" required>
						<option value="" selected>Select Department</option>
						<?php $sql = mysqli_query($conn,"SELECT * FROM department order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$department=$rowsqq['department'];
												?>
													<option value="<?php echo "$department";?>"><?php echo $department;?></option>
													<?php } ?>
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
						<label class="form-label">Date of Joining<span class="form-required">*</span></label>
						<?php 
					  date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	?>
                              <input id="calendar-simple" name="dateofjoining" type="date" min="<?php echo $date; ?>" value="<?php echo $date; ?>" class="form-control mb-2" placeholder="Select a date" required />
                        
					   </div>
					</div>
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Wage (Rs)<span class="form-required">*</span></label>
                            <input type="text" name="wage" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					    <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Employment Status<span class="form-required">*</span></label>
                           <select name="emp_status" id="select-beast2" class="form-control custom-select" required>
						<option value="" selected>Select Employment Status</option>
						<option value="Active" >Active</option>
						<option value="Inactive" >Inactive</option>
						</select>
                          </div>
                        </div>
                      </div> 
					<div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Address<span class="form-required">*</span></label>
                                 <textarea class="form-control" name="address" data-toggle="autosize" placeholder="Enter Address…"></textarea>
                     
                          </div>
                        </div>
                      </div>	
					<div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                           <label class="form-label">Salary<span class="form-required">*</span></label>
                             <select name="salary" id="select-beast2" class="form-control custom-select" required>
						<option value="" selected>Select</option>
						<option value="Daily wage" >Daily wage</option>
						<option value="Monthly Salary" >Monthly Salary</option>
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
                           <label class="form-label">Phone<span class="form-required">*</span></label>
                            <input type="text" name="emp_phone" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Mobile<span class="form-required">*</span></label>
                            <input type="text" name="emp_mobile" class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Email Id<span class="form-required">*</span></label>
                            <input type="text" name="emp_emailid"  class="form-control" autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl-12">
                       
                        <div class="mb-3">
                          <label class="form-label">Comments</label>
                          <textarea class="form-control" name="comments" data-toggle="autosize" placeholder="Comments…"></textarea>
                        </div>
                      </div>
					     <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Employee Password<span class="form-required">*</span></label>
                            <input type="text" name="emp_password"  class="form-control" autocomplete="off" required/>
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
</html>