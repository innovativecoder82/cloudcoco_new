<?php
error_reporting(0);
include('templates/session.php');
include('templates/export.php');
include('templates/functions.php');
date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');

$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];
if(isset($_GET['id']))
{
	$query2 = mysqli_query($conn,"delete from emp_attendance where id='".$_GET['id']."'");
	echo'<script>alert("Deleted successfully..!");window.location.href="view_emp_attendance.php";</script>';

 
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
                    <h3 class="card-title">View Today Present - <div class="btn-group pull-right">
           
			<div class="control-group">
				<div class="controls" style="color:red;">
				 <form method="post" action="export.php" class="card">
                <button type="submit" name="tody_present" class="btn btn-primary ml-auto">Export</button>
			   </form>
				</div>
			</div>
		             </div></h3>
					  <div class="col-auto ml-auto d-print-none">
				   
                <a href="add_emp_attendance.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Add Attendance 
                </a>
                <a href="add_emp_attendance.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </a>
              </div>
                  </div>
		
	
			  
				  
				  
                  <div class="table-responsive">
                    <table id="basic-datatables" class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
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
		 
									$query2 = mysqli_query($conn,"select * from emp_attendance where dailydate='$date' order by id DESC");
								
									}$inc=1;
					while($rowa = mysqli_fetch_array($query2))
					{
						$em_id=$rowa['emp_id'];
							$sqls = mysqli_query($conn,"SELECT * FROM employee_details where emp_id='$em_id' order by id desc");
							$rowas = mysqli_fetch_array($sqls);
						
				?>
                        <tr>
						
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