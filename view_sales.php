<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');
$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];
if(isset($_GET['id']))
{
	$query1ks= mysqli_query($conn,"SELECT * FROM sales where id='".$_GET['id']."' ORDER BY `id` DESC");
	$rowsks = mysqli_fetch_assoc($query1ks);
	$prod=$rowsks['prod_name'];
	$quali=$rowsks['quality'];
	$oldtot=$rowsks['quantity'];
	$oldtotwgt=$rowsks['total_weight'];
	
	$query1k= mysqli_query($conn,"SELECT * FROM product where prod_name='$prod' and quality='$quali' ORDER BY `id` DESC");
 $rowsk = mysqli_fetch_assoc($query1k);
 
 $pr_id=$rowsk['id'];
 $stk=$rowsk['stock'];
 $newtotwgt=$rowsk['total_weight'];
 $tot_stk=$stk+$oldtot;
 $tot_swgt=$newtotwgt+$oldtotwgt;
 
 $query = mysqli_query($conn,"update product set stock='$tot_stk', total_weight='$tot_swgt' where id='$pr_id'");
	
	$query2 = mysqli_query($conn,"delete from sales where id='".$_GET['id']."'");
	echo'<script>alert("Deleted successfully..!");window.location.href="view_sales.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('view_sales'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">View Sales</h3>
					  <div class="col-auto ml-auto d-print-none">
				   
                <a href="add_sales.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Create new 
                </a>
                <a href="add_sales.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
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
                        <a href="view_sales.php" class="btn btn-link">Reset</a>
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
									$query2 = mysqli_query($conn,"select * from sales where  sale_date BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from sales order by id DESC");
								}
									}
							?>
			  
			  
				  
                  <div class="table-responsive">
                    <table id="basic-datatables" class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
						  <th>Action</th>
                          <th class="w-1">No.</th>
                          <th>Sale Id</th>
                          <th>Product</th>
                          <th>Sale Date</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Payment Status</th>
                          <th>Buyer Name</th>
                          <th>Buyer Vehicle No.</th>
						  <th>Payment Mode</th>
                          <th>Payment Details</th>
                          <th>Paid Amount</th>
                          <th>Approve Name</th>
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
									$query2 = mysqli_query($conn,"select * from sales where  sale_date BETWEEN '$from_date' AND '$to_date' order by id desc");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from sales order by id desc");
								}
									}$inc=1;
					while($rowa = mysqli_fetch_array($query2))
					{
						
						$query2z = mysqli_query($conn,"select * from buyer where buyer_id='".$rowa['buyer_name']."' order by id DESC");	
						$rowad = mysqli_fetch_array($query2z)
				?>
                        <tr>
						  <td class="text-right">
                            <a href="edit_sales.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="view_sales.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Delete</a>
                          </td>
                          <td><span class="text-muted"><?php echo $inc; ?></span></td>
                          <td><?php echo $rowa['sal_id']; ?></td>
                          <td>
                            <?php echo $rowa['prod_name']; ?>
                          </td>
                          <td>
                            <?php echo $rowa['sale_date']; ?>
                          </td>
                          <td>
                            <?php echo $rowa['quantity']; ?>
                          </td>
                          <td>
                             <?php echo $rowa['price']; ?>
                          </td>
                          <td><?php echo $rowa['sold_status']; ?></td>
                          <td><?php echo $rowad['buy_name']; ?></td>
                          <td><?php echo $rowa['buyer_vehicle_no']; ?></td>
                          <td><?php echo $rowa['payment_mode']; ?></td>
                          <td><?php echo $rowa['payment_details']; ?></td>
                          <td><?php echo $rowa['paid_amount']; ?></td>
                          <td><?php echo $rowa['approve_name']; ?></td>
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