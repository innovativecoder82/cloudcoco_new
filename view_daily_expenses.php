<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');
$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];

if(isset($_GET['id']))
{
	$query2 = mysqli_query($conn,"delete from daily_expenses where id='".$_GET['id']."'");
	echo'<script>alert("Deleted successfully..!");window.location.href="view_daily_expenses.php";</script>';
}

if(isset($_GET['status']))
{
$query = mysqli_query($conn,"update daily_expenses set status='Approve' where id='".$_GET['status']."'");
echo'<script>alert("Successfully Updated..!");window.location.href="view_daily_expenses.php";</script>';
}

if(isset($_GET['status1']))
{
$query = mysqli_query($conn,"update daily_expenses set status='Pending' where id='".$_GET['status1']."'");
echo'<script>alert("Successfully Updated..!");window.location.href="view_daily_expenses.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('view_daily_expenses'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">View Daily Expenses</h3>
					  <div class="col-auto ml-auto d-print-none">
				   
                <a href="add_daily_expenses.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Daily Expenses 
                </a>
                <a href="add_daily_expenses.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
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
                        <a href="view_daily_expenses.php" class="btn btn-link">Reset</a>
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
									$query2 = mysqli_query($conn,"select * from daily_expenses where  exp_date BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from daily_expenses order by id DESC");
								}
									}
							?>
			  
			  
				  
				  
                  <div class="table-responsive">
                    <table id="basic-datatables" class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
						  <th>Action</th>
						  <th>Status</th>
                          <th class="w-1">No.</th>
                          <th>Expenses Details</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Paid Status</th>
                          <th>Paid Through</th>
                          <th>Acount Holder</th>
                          <th>Account Details</th>
                          
                          
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
									$query2 = mysqli_query($conn,"select * from daily_expenses where  exp_date BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from daily_expenses order by id DESC");
								}
									}$inc=1;
					while($rowa = mysqli_fetch_array($query2))
					{
							
							
				?>
                        <tr>
						  <td class="text-right">
                            <a href="edit_daily_expenses.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="view_daily_expenses.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Delete</a>
                          </td>
                          <td><span class="text-muted">
						<?php
							if($rowa['status']=='Pending')
							{ ?>
						<a href="view_daily_expenses.php?status=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm"><?php echo $rowa['status'];?></a>
							<?php }elseif($rowa['status']=='Approve'){ ?>
						<a href="view_daily_expenses.php?status1=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm"><?php echo $rowa['status'];?></a>
							<?php } ?>	
						</span></td>
                          <td><span class="text-muted"><?php echo $inc; ?></span></td>
                          <td><?php echo $rowa['expenses_details']; ?></td>
                          <td>
                            <?php echo $rowa['exp_date']; ?>
                          </td>
                          <td>
                            <?php echo $rowa['amount']; ?>
                          </td>
                          <td>
                             <?php echo $rowa['paid_status']; ?>
                          </td>
                          <td><?php echo $rowa['paid_through']; ?></td>
                          <td><?php echo $rowa['account_holder']; ?></td>
                          <td><?php echo $rowa['account_details']; ?></td>
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