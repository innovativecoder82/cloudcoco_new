<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');
$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];
if(isset($_GET['id']))
{
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	
	$query1r= mysqli_query($conn,"SELECT * FROM advance_pay_repay where id='".$_GET['id']."' ORDER BY `id` DESC");
	$rowsr = mysqli_fetch_assoc($query1r);
		$em_id= $rowsr['emp_id'];		
		$advance_amt= $rowsr['advance_amt'];		
		$advance_repayment=	$rowsr['advance_repayment'];
	
	
	$query1r= mysqli_query($conn,"SELECT * FROM overall_advance_pay_repay where emp_id='$em_id' ORDER BY `id` DESC");
	$rowsr = mysqli_fetch_assoc($query1r);
		$overall_advance_amt= $rowsr['overall_advance_amt'];		
		$overall_advance_repayment=	$rowsr['overall_advance_repayment'];
		$add_advance_amt=$overall_advance_amt-$advance_amt;
		$sub_advance_amt=$overall_advance_repayment-$advance_repayment;
	$query = mysqli_query($conn,"update overall_advance_pay_repay set overall_advance_amt='$add_advance_amt', overall_advance_repayment='$sub_advance_amt', date='$date' where emp_id='$em_id'");
	
	$query2 = mysqli_query($conn,"delete from advance_pay_repay where id='".$_GET['id']."'");
	
	
	echo'<script>alert("Deleted successfully..!");window.location.href="view_advance.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('view_advance'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">View Advance</h3>
					  <div class="col-auto ml-auto d-print-none">
				   
                <a href="add_advance.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Add Advance 
                </a>
                <a href="add_advance.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
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
                        <a href="view_advance.php" class="btn btn-link">Reset</a>
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
									$query2 = mysqli_query($conn,"select * from advance_pay_repay where  date BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from advance_pay_repay order by id DESC");
								}
									}
							?>
			  
			  
				  
				  
                  <div class="table-responsive">
                    <table id="basic-datatables" class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
						 
                          <th class="w-1">No.</th>
                          <th>Employee Name</th>
                          <th>Advance Amount</th>
                          <th>Payment Date</th>
						  <th>Advance Repayment</th>
                          <th>Repayment Date</th>
                          <th>Date</th>
                          <th>Action</th>
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
									$query2 = mysqli_query($conn,"select * from advance_pay_repay where  date BETWEEN '$from_date' AND '$to_date' order by id asc");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from advance_pay_repay order by id asc");
								}
									}
									$inc=1;
					while($rowa = mysqli_fetch_array($query2))
					{
							$empid=$rowa['emp_id'];
							$sqlm = mysqli_query($conn,"SELECT * FROM employee_details where emp_id='$empid' order by id desc");
							$rowam = mysqli_fetch_array($sqlm);
				?>
                        <tr>
						  
                          <td><span class="text-muted"><?php echo $inc; ?></span></td>
                          <td>
                            <?php echo $rowam['emp_name']; ?>
                          </td>
                          <td>
                            <?php echo $rowa['advance_amt']; ?>
                          </td>
                          <td>
                            <?php 
							if($rowa['payment_date']>0)
							{
							echo $rowa['payment_date']; }else{}?>
                          </td>
                          <td>
                             <?php echo $rowa['advance_repayment']; ?>
                          </td>
                          <td><?php 
						  if($rowa['repayment_date']>0)
							{
						  echo $rowa['repayment_date'];}else{} ?></td>
						   <td>
                            <?php echo $rowa['date']; ?>
                          </td>
                          <td class="text-right">
                            <a href="view_advance.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Delete</a>
                          </td>
						 
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