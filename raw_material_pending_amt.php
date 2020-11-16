<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');
$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];
extract($_POST);
if(isset($_POST['submit_pending_amt']))
{
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa'); 

	
$query1r= mysqli_query($conn,"SELECT * FROM raw_material_pending_amt where rawmat_id='$rawmat_id' ORDER BY `id` DESC");
	$rowsr = mysqli_fetch_assoc($query1r);
	$rawmat_id= $rowsr['rawmat_id'];	
	$sup_id= $rowsr['sup_id'];	
	$rawmaterial_pending_amt= $rowsr['rawmaterial_pending_amt'];	

$querr= mysqli_query($conn,"SELECT * FROM supplier_details where sup_id='$sup_id' ORDER BY `id` DESC");
	$rowmr = mysqli_fetch_assoc($querr);
	$suplier_advance_amt= $rowmr['suplier_advance_amt'];	
	
	$remamtsup=$suplier_advance_amt-$Pay_amount;
	$remamtpai=$rawmaterial_pending_amt-$Pay_amount;
	
	
	if($suplier_advance_amt>=$Pay_amount){
		if($rawmaterial_pending_amt>=$Pay_amount){
			if($rawmaterial_pending_amt==$Pay_amount){
				$query = mysqli_query($conn,"update supplier_details set suplier_advance_amt='$remamtsup' where sup_id='$sup_id'");
	
 $query11 = mysqli_query($conn,"INSERT INTO supplier_advance_repayment (sup_id,rawmat_id, advace_repayment, date) VALUES('$supplier_id','$rawmat_id','$Pay_amount','$date')");
	$query2 = mysqli_query($conn,"delete from raw_material_pending_amt where rawmat_id='$rawmat_id'");
	
	echo'<script>alert("Successfully Updated..!");window.location.href="raw_material_pending_amt.php";</script>';
	
			}else{
							$query = mysqli_query($conn,"update supplier_details set suplier_advance_amt='$remamtsup' where sup_id='$sup_id'");
	
 $query11 = mysqli_query($conn,"INSERT INTO supplier_advance_repayment (sup_id,rawmat_id, advace_repayment, date) VALUES('$supplier_id','$rawmat_id','$Pay_amount','$date')");
	if($remamtpai>0){
			$query = mysqli_query($conn,"update raw_material_pending_amt set rawmaterial_pending_amt='$remamtpai', date='$date' where rawmat_id='$rawmat_id'");
 }
	
		 echo'<script>alert("Successfully Updated..!");window.location.href="raw_material_pending_amt.php";</script>';
	
			}
		}else{
		 echo'<script>alert("Paying amount is high..!");window.location.href="raw_material_pending_amt.php";</script>';
		
		}
		
		
	}else{
	 echo'<script>alert("Advance Amount is less..!");window.location.href="raw_material_pending_amt.php";</script>';
	
	}
	
	}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('raw_material_pending_amt'); ?>
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
									$query2 = mysqli_query($conn,"select * from raw_material_pending_amt where  date BETWEEN '$from_date' AND '$to_date' order by id DESC");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from raw_material_pending_amt order by id DESC");
								}
									}
							?>
			  
			  
                  <div class="table-responsive">
                    <table id="basic-datatables" class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
						   <th class="w-1">No.</th>
                          <th>Raw Material Purchase ID</th>
                          <th>Supplier</th>
                          <th>Purchased Amt</th>
                          <th>Paid Amt</th>
                          <th>Pending Amt</th>
                          <th>Paying Amt</th>
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
									$query2 = mysqli_query($conn,"select * from raw_material_pending_amt where  date BETWEEN '$from_date' AND '$to_date' order by id asc");
									}
								}else{
									$query2 = mysqli_query($conn,"select * from raw_material_pending_amt order by id asc");
								}
									}
						$inc=1;
					while($rowa = mysqli_fetch_array($query2))
					{
							$rawmat_id=$rowa['rawmat_id'];
							$sup_id=$rowa['sup_id'];
							
							
							$rawmaterial_pending_amt=$rowa['rawmaterial_pending_amt'];
							$sqls = mysqli_query($conn,"SELECT * FROM supplier_details where sup_id='$sup_id' order by id desc");
							$rowas = mysqli_fetch_array($sqls);
							$sup_name=$rowas['sup_name'];
							$suplier_advance_amt=$rowas['suplier_advance_amt'];
							
							$sqlsa = mysqli_query($conn,"SELECT * FROM raw_material where rawmat_id='$rawmat_id' order by id desc");
							$rowasa = mysqli_fetch_array($sqlsa);
							$supplier_id=$rowas['supplier_id'];
							$price_units=$rowasa['price_units'];
							$price_loads=$rowasa['price_loads'];
							$totprice=$price_units+$price_loads;
							
							$sqlsaa = mysqli_query($conn,"SELECT * FROM supplier_advance_repayment where rawmat_id='$rawmat_id' order by id desc");
							while($rowasaa = mysqli_fetch_array($sqlsaa)){
								$advace_repayment+=$rowasaa['advace_repayment'];
							}
						
				?>
                        <tr>
						  <td style="width:10%;"><span class="text-muted"><?php echo $inc; ?></span></td>
                          <td style="width:10%;"><?php echo $rawmat_id; ?></td>
                          <td style="width:10%;"><?php echo $sup_name; ?></td>
                          <td style="width:10%;"><?php echo $totprice; ?></td>
                          <td style="width:10%;"><?php echo $advace_repayment; ?></td>
                          <td style="width:10%;"><?php echo $rawmaterial_pending_amt; ?></td>
                            <form method="post">
						 
						  <td style="width:10%;">
						  <input name="rawmat_id" type="hidden"  placeholder='rawmat_id' value="<?php echo $rawmat_id; ?>" class="form-control" required="">
                          <input name="Pay_amount" type="number"  placeholder='Pay Amount'  class="form-control" required="">
                     
						  
						  
						  
						  </td>
                           <td class="text-right">
							<!--- <a href="edit_raw_material.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Edit</a> --->
							    <button type="submit" name="submit_pending_amt" class="btn btn-secondary btn-sm">Click to Pay</button>

                          </td>
                        </form>
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