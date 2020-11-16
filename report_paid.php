<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');
$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];
if(isset($_GET['id']))
{
	$query2 = mysqli_query($conn,"delete from emp_attendance where id='".$_GET['id']."'");
	echo'<script>alert("Deleted successfully..!");window.location.href="view_emp_attendance.php";</script>';
}
 
if(isset($_GET['id1'])){
	$id1=$_GET['id1'];
		$query2a = mysqli_query($conn,"select * from emp_attendance where id='$id1' order by id DESC");
		$rowaa = mysqli_fetch_array($query2a);
		$eid=$rowaa['emp_id'];
		$sqlsa = mysqli_query($conn,"SELECT * FROM employee_details where emp_id='$eid' order by id desc");
		$rowasa = mysqli_fetch_array($sqlsa);
		
   $emp_name = $rowasa['emp_name']; 
   $subject = $rowasa['emp_name']; 
   $emp_id = $rowaa['emp_id']; 
   $department = $rowaa['department']; 
   $daily_wage = $rowaa['daily_wage']; 
   $dailydate = $rowaa['dailydate']; 
   $working_hours = $rowaa['working_hours']; 
   $payment_status = $rowaa['payment_status']; 
   $half_day_shift = $rowaa['half_day_shift']; 
   $monthly_salary = $rowaa['monthly_salary']; 
   $advance_amt = $rowaa['advance_amt']; 
   $advance_repayment = $rowaa['advance_repayment']; 
   $additional_hours_wage = $rowaa['additional_hours_wage']; 
   $reason_additional_hours = $rowaa['reason_additional_hours']; 
   $comments = $rowaa['comments']; 
   

$body = '
<table style="font-family: arial, sans-serif;border-collapse: collapse;width:500px;">
<tr><td colspan="2" style="text-align:center;background-color:#f78f1e;color:#ffffff;"><h3 style="text-align:center;background-color:#f78f1e;color:#ffffff;">Enquiry Details</h3></td></tr>
    <tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Employee Name</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$emp_name.'</td>
    </tr>
    <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Employee Id</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$emp_id.'</td>
    </tr>
    <tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Department</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$department.'</td>
    </tr>
    <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Daily Wage</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$daily_wage.'</td>
    </tr>
	   <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Date</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$dailydate.'</td>
    </tr>
	   <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Working Hours</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$working_hours.'</td>
    </tr>
	   <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Payment Status</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$payment_status.'</td>
    </tr>
	   <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Shift</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$half_day_shift.'</td>
    </tr>
	   <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Monthly Salary</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$monthly_salary.'</td>
    </tr>
	   <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Advance Amount</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$advance_amt.'</td>
    </tr>
	   <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Advance Repayment</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$advance_repayment.'</td>
    </tr>
	   <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Additional Hours Wage</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$additional_hours_wage.'</td>
    </tr>
	   <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Reason Additional Hours</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$reason_additional_hours.'</td>
    </tr>
    <tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Comments</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$comments.'</td>
    </tr>
</table>';
//Simple Mail Connection
  $email_to       = 'keerthikiot@gmail.com'; 
  $email_from     = 'keerthikiot@gmail.com';
  $from_username  = $emp_name;
  //$email_reply_to = ADMIN_EMAIL;
 //$headers .= "Reply-To: ". strip_tags($email_to) . "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
 
   mail($email_to, $subject, $body, $headers);
   
echo'<script>alert("Successfully Mail Sent..!");window.location.href="view_emp_attendance.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('view_emp_attendance'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">View Attendance</h3>
					  <div class="col-auto ml-auto d-print-none">
				   
                <a href="add_emp_attendance.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Create new 
                </a>
                <a href="add_emp_attendance.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </a>
              </div>
                  </div>
				   <div class="card">
                 <div class="card-header">
         <form role="form" method="post">
						
				  <div class="row">
                     <div class="col-xl-4">
					 				
                      <div class="row">
                     <div class="col-md-6 col-xl-12">
                      <div class="mb-3">
						<label class="form-label">From date<span class="form-required">*</span></label>
                              <input id="calendar-simple" name="from_date" type="date"  class="form-control mb-2" placeholder="Select a date" required />
                        
					   </div>
					</div> 
              </div>
              </div>
			      <div class="col-xl-4">
                      <div class="row">
                     <div class="col-md-6 col-xl-12">
                      <div class="mb-3">
						<label class="form-label">To date<span class="form-required">*</span></label>
                              <input id="calendar-simple" name="to_date" type="date"  class="form-control mb-2" placeholder="Select a date" required />
                        
					   </div>
					</div> 
              </div>
              </div>
			      <div class="col-xl-4">
                      <div class="row">
                     <div class="col-md-6 col-xl-12">
                      <div class="mb-3">
						<label class="form-label">Action<span class="form-required"></span></label>
                               <button type="submit" name="submit" class="btn btn-primary ml-auto">Submit</button>
                        <a href="view_emp_attendance.php" class="btn btn-link">Reset</a>
					   </div>
					</div> 
              </div>
              </div>
			  
              </div>
			 
		</form>
              </div>
			  
              </div>
			  <?php 
if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
									{					
		 if (isset($_POST['submit'])) {
									$from_date=$_POST['from_date'];
									$to_date=$_POST['to_date'];
									
									if(($from_date!='')AND($to_date!=''))
									{
									$query2 = mysqli_query($conn,"select * from emp_attendance where  dailydate BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from emp_attendance order by id DESC");
								}
									}
							?>
			  
			  
				  
				  
                  <div class="table-responsive">
                    <table id="basic-datatables" class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
						  <th>Action</th>
                          <th class="w-1">No.</th>
                          <th>Employee Name</th>
                          <th>Department</th>
                          <th>Daily Wage</th>
                          <th>Date</th>
                          <th>Working Hours</th>
                          <th>Payment Status</th>
                          <th>Shift</th>
                          <th>Monthly Salary</th>
                          <th>Advance Amount</th>
                          <th>Advance Repayment</th>
                          <th>Additional Hours Wage</th>
                          <th>Reason Additional Hours</th>
                          <th>Comments</th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  
											  <?php 
if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
									{					
		 if (isset($_POST['submit'])) {
									$from_date=$_POST['from_date'];
									$to_date=$_POST['to_date'];
									
									if(($from_date!='')AND($to_date!=''))
									{
									$query2 = mysqli_query($conn,"select * from emp_attendance where  dailydate BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from emp_attendance order by id DESC");
								}
									}$inc=1;
					while($rowa = mysqli_fetch_array($query2))
					{
						$em_id=$rowa['emp_id'];
							$sqls = mysqli_query($conn,"SELECT * FROM employee_details where emp_id='$em_id' order by id desc");
							$rowas = mysqli_fetch_array($sqls);
						
				?>
                        <tr>
						 <td class="text-right">
                            <a href="view_emp_attendance.php?id1=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Mail</a>
                            <a href="edit_emp_attendance.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="view_emp_attendance.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Delete</a>
                           
                          </td>
                          <td><span class="text-muted"><?php echo $inc; ?></span></td>
                          <td><?php echo $rowas['emp_name']; ?></td>
                          <td>
                            <?php echo $rowa['department']; ?>
                          </td>
                          <td>
                            <?php echo $rowa['daily_wage']; ?>
                          </td>
                          <td>
                            <?php echo $rowa['dailydate']; ?>
                          </td>
                          <td>
                             <?php echo $rowa['working_hours']; ?>
                          </td>
                          <td><?php echo $rowa['payment_status']; ?></td>
                          <td><?php echo $rowa['half_day_shift']; ?></td>
                          <td><?php echo $rowa['monthly_salary']; ?></td>
                          <td><?php echo $rowa['advance_amt']; ?></td>
                          <td><?php echo $rowa['advance_repayment']; ?></td>
                          <td><?php echo $rowa['additional_hours_wage']; ?></td>
                          <td><?php echo $rowa['reason_additional_hours']; ?></td>
                          <td><?php echo $rowa['comments']; ?></td>
                         
                         
                        </tr>
                        <?php $inc++;  }?>
                      </tbody>
                    </table>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
     
        </div>
      </div>
	   <?php footertemplate(); ?>
     
    </div>
  </body>
</html>