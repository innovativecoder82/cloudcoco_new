<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');
$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];
if(isset($_GET['id']))
{
	$query2 = mysqli_query($conn,"delete from raw_material where id='".$_GET['id']."'");
	echo'<script>alert("Deleted successfully..!");window.location.href="view_raw_material.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('view_raw_material'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">View Raw Material</h3>
					  <div class="col-auto ml-auto d-print-none">
				   
                <a href="add_raw_material.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Create new 
                </a>
                <a href="add_raw_material.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
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
                        <a href="view_raw_material.php" class="btn btn-link">Reset</a>
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
									$query2 = mysqli_query($conn,"select * from raw_material where  dateofdelivery BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from raw_material order by id DESC");
								}
									}
							?>
			  
			  
                  <div class="table-responsive">
                    <table id="basic-datatables" class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
						<th>Action</th>
                          <th class="w-1">No.</th>
                          <th>Material Name</th>
                          <th>color</th>
                          <th>Quantity in units</th>
                          <th>Price of Units</th>
                          <th>Quantity in Loads</th>
                          <th>Price of Loads</th>
                          <th>Department</th>
                          <th>Supplier Name</th>
                          <th>Employee Name</th>
                          <th>Date of Delivery</th>
                          <th>Vechicle Name</th>
                          <th>Vechicle No.</th>
                          <th>Payment Status</th>
                          <th>Payment Mode</th>
                          <th>Payment Details</th>
                          <th>Feedback </th>
                          <th>Date </th>
                          
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
									$query2 = mysqli_query($conn,"select * from raw_material where  dateofdelivery BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from raw_material order by id DESC");
								}
									}
						$inc=1;
					while($rowa = mysqli_fetch_array($query2))
					{
							$raw_material=$rowa['raw_material'];
							$supplier_id=$rowa['supplier_id'];
							$emp_id=$rowa['emp_id'];
							$sqls = mysqli_query($conn,"SELECT * FROM raw where id='$raw_material' order by id desc");
							$rowas = mysqli_fetch_array($sqls);
							$sqlsa = mysqli_query($conn,"SELECT * FROM employee_details where emp_id='$emp_id' order by id desc");
							$rowasa = mysqli_fetch_array($sqlsa);
							$sqlsaa = mysqli_query($conn,"SELECT * FROM supplier_details where sup_id='$supplier_id' order by id desc");
							$rowasaa = mysqli_fetch_array($sqlsaa);
						
				?>
                        <tr>
						  <td class="text-right">
							<!--- <a href="edit_raw_material.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Edit</a> --->
							<a href="view_raw_material.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Delete</a>
                          </td>
                          <td><span class="text-muted"><?php echo $inc; ?></span></td>
                          <td><?php echo $rowas['raw_name']; ?></td>
                          <td><?php echo $rowa['color']; ?></td>
                          <td><?php echo $rowa['quaty_units']; ?></td>
                          <td><?php echo $rowa['price_units']; ?></td>
                          <td><?php echo $rowa['quaty_loads']; ?></td>
                          <td><?php echo $rowa['price_loads']; ?></td>
                          <td><?php echo $rowa['department']; ?></td>
                          <td><?php echo $rowasaa['sup_name']; ?></td>
                          <td><?php echo $rowasa['emp_name']; ?></td>
                          <td><?php echo $rowa['dateofdelivery']; ?></td>
                          <td><?php echo $rowa['vechicle_name']; ?></td>
                          <td><?php echo $rowa['vechicle_no']; ?></td>
                          <td><?php echo $rowa['payment_status']; ?></td>
                          <td><?php echo $rowa['payment_mode']; ?></td>
                          <td><?php echo $rowa['payment_details']; ?></td>
                          <td><?php echo $rowa['feedback']; ?></td>
                          <td><?php echo $rowa['date']; ?></td>
                         
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