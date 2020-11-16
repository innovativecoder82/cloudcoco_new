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
	
	$query1r= mysqli_query($conn,"SELECT * FROM supplier_advance where id='".$_GET['id']."' ORDER BY `id` DESC");
	$rowsr = mysqli_fetch_assoc($query1r);
		$sup_id= $rowsr['sup_id'];		
		$advance_amount= $rowsr['advance_amount'];		
		
	
	$query1r= mysqli_query($conn,"SELECT * FROM supplier_details where sup_id='$sup_id' ORDER BY `id` DESC");
	$rowsr = mysqli_fetch_assoc($query1r);
		$sup_id= $rowsr['sup_id'];		
		$suplier_advance_amt=	$rowsr['suplier_advance_amt'];
		$add_advance_amt=$suplier_advance_amt-$advance_amount;
		
		if($add_advance_amt>=0){
	$query = mysqli_query($conn,"update supplier_details set suplier_advance_amt='$add_advance_amt', date='$date' where sup_id='$sup_id'");
	
	$query2 = mysqli_query($conn,"delete from supplier_advance where id='".$_GET['id']."'");
	
	
	echo'<script>alert("Deleted successfully..!");window.location.href="view_supplier_advance.php";</script>';
}else{
	echo'<script>alert("Amount Less in Supplier Advance..!");window.location.href="view_supplier_advance.php";</script>';
	
}

}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('view_supplier_advance'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">View Advance</h3>
					  <div class="col-auto ml-auto d-print-none">
				   
                <a href="add_supplier_advance.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Add Advance 
                </a>
                <a href="add_supplier_advance.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </a>
              </div>
                  </div>
			
		
				  
				  
                  <div class="table-responsive">
                    <table id="basic-datatables" class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
						 
                          <th class="w-1">No.</th>
                          <th>Supplier Name</th>
                          <th>Advance Amount</th>
                          <th>Payment Date</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
											if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
									{					
		 
									$query2 = mysqli_query($conn,"select * from supplier_advance order by id asc");
									}
								else{
									$query2 = mysqli_query($conn,"select * from supplier_advance order by id asc");
								}
									
									$inc=1;
					while($rowa = mysqli_fetch_array($query2))
					{
							$sup_id=$rowa['sup_id'];
							$sqlm = mysqli_query($conn,"SELECT * FROM supplier_details where sup_id='$sup_id' order by id desc");
							$rowam = mysqli_fetch_array($sqlm);
							
				?>
                        <tr>
						  
                          <td><span class="text-muted"><?php echo $inc; ?></span></td>
                          <td>
                            <?php echo $rowam['sup_name']; ?>
                          </td>
                          <td>
                            <?php echo $rowa['advance_amount']; ?>
                          </td>
						  <td>
                            <?php echo $rowa['date']; ?>
                          </td>
                          <td class="text-right">
                            <a href="view_supplier_advance.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Delete</a>
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