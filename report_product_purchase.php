<?php
error_reporting(0);
include('templates/session.php');
include('templates/export.php');
include('templates/functions.php');
$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];
if(isset($_GET['id']))
{
	$query2 = mysqli_query($conn,"delete from product_purchase where id='".$_GET['id']."'");
	echo'<script>alert("Deleted successfully..!");window.location.href="view_product_purchase.php";</script>';
}


if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
									{					
		 if (isset($_POST['submit'])) {
									$from_date=$_POST['from_date'];
									$to_date=$_POST['to_date'];
									
									if(($from_date!='')AND($to_date!=''))
									{
									$query2 = mysqli_query($conn,"select * from product_purchase where  dateofpurchase BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from product_purchase order by id DESC");
								}
									}
									while($rowa = mysqli_fetch_array($query2))
					{
						$tot_qty+=$rowa['quantity'];
						$tot_price+=$rowa['price'];
					}
							
			  
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('report_product_purchase'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">View Product Purchase - <div class="btn-group pull-right">
           
			<div class="control-group">
				<div class="controls" style="color:red;">
				 <form method="post" action="export.php" class="card">
                <button type="submit" name="prod_purchase" class="btn btn-primary ml-auto">Export</button>
			   </form>
				</div>
			</div>
		             </div></h3>
					  <div class="col-auto ml-auto d-print-none">
				   
                <a href="add_product_purchase.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Product Purchase 
                </a>
                <a href="add_product_purchase.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
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
                        <a href="view_product_purchase.php" class="btn btn-link">Reset</a>
					   </div>
					</div> 
              </div>
              </div>
			  
              </div>
			 
		</form>
		<div class="col-auto ml-auto d-print-none">
				   
                <a href="#" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                   Total Quantity :  <?php echo $tot_qty; ?>
                </a>
               
              </div>
			  	<div class="col-auto ml-auto d-print-none">
				   
                <a href="#" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                   Total Price : Rs. <?php echo $tot_price; ?>
                </a>
               
              </div>
              </div>
			  
              </div>
			  
			  
				  
                  <div class="table-responsive">
                    <table id="basic-datatables" class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
						 <th class="w-1">No.</th>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Paid Status</th>
                          <th>Date of Purchase</th>
                          <th>Supplier Name</th>
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
									$query2 = mysqli_query($conn,"select * from product_purchase where  dateofpurchase BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from product_purchase order by id DESC");
								}
									}
									$inc=1;
					while($rowa = mysqli_fetch_array($query2))
					{
							$sup_id=$rowa['sup_id'];
							$sqlh = mysqli_query($conn,"SELECT * FROM supplier_details where sup_id='$sup_id' order by id desc");
						    $rowah = mysqli_fetch_array($sqlh)
				?>
                        <tr>
						 
                          <td><span class="text-muted"><?php echo $inc; ?></span></td>
                          <td><?php echo $rowa['product']; ?></td>
                          <td>
                            <?php echo $rowa['quantity']; ?>
                          </td>
                          <td>
                            <?php echo $rowa['price']; ?>
                          </td>
                          <td>
                             <?php echo $rowa['paid_status']; ?>
                          </td>
                          <td><?php echo $rowa['dateofpurchase']; ?></td>
                          <td><?php echo $rowah['sup_name']; ?></td>
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