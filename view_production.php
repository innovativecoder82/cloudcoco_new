<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');
$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];
if(isset($_GET['id']))
{
	$query1ks= mysqli_query($conn,"SELECT * FROM daily_production where id='".$_GET['id']."' ORDER BY `id` DESC");
	$rowsks = mysqli_fetch_assoc($query1ks);
	$prod=$rowsks['product'];
	$qual=$rowsks['quality'];
	$oldtot=$rowsks['total_load'];
	$oldtotwgt=$rowsks['total_weight'];
	
	$query1k= mysqli_query($conn,"SELECT * FROM product where prod_name='$prod' and quality='$qual' ORDER BY `id` DESC");
 $rowsk = mysqli_fetch_assoc($query1k);
 
 $pr_id=$rowsk['id'];
 $stk=$rowsk['stock'];
 $totwgt=$rowsk['total_weight'];
 $tot_stk=$stk-$oldtot;
 $ovtot_wgt=$totwgt-$oldtotwgt;
 
 if($stk>=$oldtot)
 {
 $query = mysqli_query($conn,"update product set stock='$tot_stk', total_weight='$$ovtot_wgt' where id='$pr_id'");

	$query2 = mysqli_query($conn,"delete from  daily_production where id='".$_GET['id']."'");
	echo'<script>alert("Deleted successfully..!");window.location.href="view_production.php";</script>';
}else{
	echo'<script>alert("Not Deleted... Stock is less..!");window.location.href="view_production.php";</script>';
	
}

}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('view_production'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">View Production</h3>
					  <div class="col-auto ml-auto d-print-none">
				   
                <a href="daily_production.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Create new 
                </a>
                <a href="daily_production.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
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
                        <a href="view_production.php" class="btn btn-link">Reset</a>
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
									$query2 = mysqli_query($conn,"select * from daily_production where  dailydate BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from daily_production order by id DESC");
								}
									}
							?>
			  
			  
				  
				  
                  <div class="table-responsive">
                    <table id="basic-datatables" class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th class="w-1">No.</th>
                           <th>Product</th>
                          <th>Quality</th>
                          <th>Total Load</th>
                          <th>Weight</th>
                          <th>Total Weight</th>
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
									$query2 = mysqli_query($conn,"select * from daily_production where  dailydate BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from daily_production order by id asc");
								}
									}
									$inc=1;
					while($rowa = mysqli_fetch_array($query2))
					{
							
						
				?>
                        <tr>
                          <td><span class="text-muted"><?php echo $inc; ?></span></td>
                          <td><?php echo $rowa['product']; ?></td>
                          <td><?php echo $rowa['quality']; ?></td>
                          <td><?php echo $rowa['total_load']; ?></td>
                          <td><?php echo $rowa['weight']; ?></td>
                          <td><?php echo $rowa['total_weight']; ?></td>
                          <td><?php echo $rowa['dailydate']; ?></td>
                          <td class="text-right">
                            <a href="edit_daily_production.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="view_production.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Delete</a>
                           
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