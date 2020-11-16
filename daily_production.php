<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');

$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];

?>
<?php
extract($_POST);
if(isset($_POST['submit_row']))
{
 
 date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');

 $query11 = mysqli_query($conn,"INSERT INTO daily_production (prod_id, prod_id1, product, quality, total_load, weight, total_weight, dailydate, date) VALUES('$prod_id','$prod_id1','$product','$quality','$total_load','$weight','$total_weight','$dailydate','$date')");
 
 if(($product=='White Fiber')AND($quality=='TwoPly')){
 $query1k= mysqli_query($conn,"SELECT * FROM product where prod_name='$product' and quality='TwoPly' ORDER BY `id` DESC");
 $rowsk = mysqli_fetch_assoc($query1k);
					
 $pr_id=$rowsk['id'];
 $stk=$rowsk['stock'];
 $wgt=$rowsk['weight'];
 $tot_wgt=$rowsk['total_weight'];
 //$ovwgt=$wgt+$weight;
 $ovtot_wgt=$tot_wgt+$total_weight;
 $tot_stk=$total_load+$stk;
 $query = mysqli_query($conn,"update product set stock='$tot_stk', weight='$weight', total_weight='$ovtot_wgt' where id='$pr_id'");
 
 	echo'<script>alert("Successfully Added..!");window.location.href="daily_production.php";</script>';

 }
 
 if(($product=='White Fiber')AND($quality=='Export')){
 $query1k= mysqli_query($conn,"SELECT * FROM product where prod_name='$product' and quality='Export' ORDER BY `id` DESC");
 $rowsk = mysqli_fetch_assoc($query1k);
					
 $pr_id=$rowsk['id'];
 $stk=$rowsk['stock'];
 $wgt=$rowsk['weight'];
 $tot_wgt=$rowsk['total_weight'];
 $ovwgt=$wgt+$weight;
 $ovtot_wgt=$tot_wgt+$total_weight;
 $tot_stk=$total_load+$stk;
 $query = mysqli_query($conn,"update product set stock='$tot_stk', weight='$weight', total_weight='$ovtot_wgt' where id='$pr_id'");
 	echo'<script>alert("Successfully Added..!");window.location.href="daily_production.php";</script>';

 }
 
 if(($product=='Brown Fiber')AND($quality=='TwoPly')){
 $query1k= mysqli_query($conn,"SELECT * FROM product where prod_name='$product' and quality='TwoPly' ORDER BY `id` DESC");
 $rowsk = mysqli_fetch_assoc($query1k);
					
 $pr_id=$rowsk['id'];
 $stk=$rowsk['stock'];
 $wgt=$rowsk['weight'];
 $tot_wgt=$rowsk['total_weight'];
 $ovwgt=$wgt+$weight;
 $ovtot_wgt=$tot_wgt+$total_weight;
 $tot_stk=$total_load+$stk;
 $query = mysqli_query($conn,"update product set stock='$tot_stk', weight='$weight', total_weight='$ovtot_wgt' where id='$pr_id'");
 	echo'<script>alert("Successfully Added..!");window.location.href="daily_production.php";</script>';

 }
 
 if(($product=='Brown Fiber')AND($quality=='Export')){
 $query1k= mysqli_query($conn,"SELECT * FROM product where prod_name='$product' and quality='Export' ORDER BY `id` DESC");
 $rowsk = mysqli_fetch_assoc($query1k);
					
 $pr_id=$rowsk['id'];
 $stk=$rowsk['stock'];
 $wgt=$rowsk['weight'];
 $tot_wgt=$rowsk['total_weight'];
 $ovwgt=$wgt+$weight;
 $ovtot_wgt=$tot_wgt+$total_weight;
 $tot_stk=$total_load+$stk;
 $query = mysqli_query($conn,"update product set stock='$tot_stk', weight='$weight', total_weight='$ovtot_wgt' where id='$pr_id'");
 	echo'<script>alert("Successfully Added..!");window.location.href="daily_production.php";</script>';

 }
 
 if(($product!='')AND($quality=='')){
 $query1k= mysqli_query($conn,"SELECT * FROM product where prod_name='$product' and quality='' ORDER BY `id` DESC");
 $rowsk = mysqli_fetch_assoc($query1k);
					
 $pr_id=$rowsk['id'];
 $stk=$rowsk['stock'];
 $wgt=$rowsk['weight'];
 $tot_wgt=$rowsk['total_weight'];
 $ovwgt=$wgt+$weight;
 $ovtot_wgt=$tot_wgt+$total_weight;
 $tot_stk=$total_load+$stk;
 $query = mysqli_query($conn,"update product set stock='$tot_stk', weight='$weight', total_weight='$ovtot_wgt' where id='$pr_id'");
 	echo'<script>alert("Successfully Added..!");window.location.href="daily_production.php";</script>';

 }
 
 
  
 	  
}
?>

<!doctype html>
<html lang="en" dir="ltr">


<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('daily_production'); ?>
         <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title">
                Daily Production
              </h1>
            </div>
            <div class="row row-cards">
              
                  
 <form method="post">
                          
<div class="row">
<div class="col-xl-12">
<div class="row">
  					   <?php
					$query1= mysqli_query($conn,"SELECT * FROM daily_production ORDER BY `id` DESC");
					$rows = mysqli_fetch_assoc($query1);
					$prod_id1= $rows['id'];
					$prod_id2=$prod_id1+1;
				  ?>
				      <input type="hidden" name="prod_id" class="form-control" Value="<?php  printf("Prod%06d", $prod_id2);?>" autocomplete="off"/ readonly>
                            <input type="hidden" name="prod_id1" class="form-control" value="<?php echo $prod_id2;?>" autocomplete="off"/>
                     <?php $prod=$_GET['prod'];  ?>
                         <div class="col-md-4 col-xl-3">
					     <div class="mb-3">
                            <label class="form-label">Product<span class="form-required">*</span></label>
                            <select name="product" id="select-beast1" class="form-control custom-select"   onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);"  required>
<?php if($prod!=''){ ?><option value='<?php echo $prod; ?>' selected><?php echo $prod; ?></option><?php }else{ ?><option value='' selected>Select Product</option><?php } ?>
<?php $sql = mysqli_query($conn,"SELECT * FROM product order by id asc");
												while($rowsqq = mysqli_fetch_assoc($sql))
													{
														$prod_name=$rowsqq['prod_name'];
												?>
													<option value="daily_production.php?prod=<?php echo "$prod_name";?>"><?php echo $prod_name;?></option>
													<?php } ?>	
</select>
                          </div>
                      </div>
					   <div class="col-md-4 col-xl-3">
                      <div class="mb-3">
					  <?php  date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa'); ?>
						<label class="form-label">Daily Date<span class="form-required">*</span></label>
                              <input id="calendar-simple" name="dailydate" type="date" min="<?php echo $date; ?>" value="<?php echo $date; ?>" class="form-control mb-2" placeholder="Select a date" />
                        
					   </div>
					</div>
					   <?php  
							if(($prod=='White Fiber') or ($prod=='Brown Fiber')){ ?>
              
					  <div class="col-md-4 col-xl-2">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Quality<span class="form-required">*</span></label>
                     <select name="quality" id="select-beast1" class="form-control custom-select" required>
						<option value="" selected>Select Quality</option>
						<option value="TwoPly">TwoPly</option>
						<option value="Export">Export</option>
					  </select>							
					</div>
                        </div>
							</div><?php }else{} ?>
					   <div class="col-md-4 col-xl-2">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">No of Bales/Load<span class="form-required">*</span></label>
                            <input  name="total_load"id="total_load"  type="number" placeholder='Load' class="form-control" oninput="add_number()" required=""></td>
                          </div>
                        </div>
                      </div>
					    <div class="col-md-4 col-xl-2">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Weight<span class="form-required">*</span></label>
                            <input  name="weight" id="weight"  type="number" placeholder='Weight' class="form-control" value="35" readonly oninput="add_number()" required></td>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-4 col-xl-2">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Total Weight<span class="form-required">*</span></label>
                            <input  name="total_weight" id="total_weight"  type="number" placeholder='Total Weight' class="form-control" required=""></td>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-4 col-xl-2">
						<div class="mb-3">
                          <div class="mb-3">
						  <?php 
							date_default_timezone_set('Asia/Calcutta');
							$date = date('Y-m-d');
							$time = date('h:i sa');
							$query1l= mysqli_query($conn,"SELECT * FROM daily_production where dailydate = '$date' ORDER BY `id` DESC");
							while($rowsl = mysqli_fetch_assoc($query1l))
							{
								$tot=$tot+$rowsl['total_load'];
							}
					?>
                            <label class="form-label">Total Load Today <span class="form-required">*</span></label>
                            <input type="text" name="load_today"  placeholder='Loads' class="form-control" value="<?php echo $tot; ?>" autofocus readonly required autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-4 col-xl-2">
						<div class="mb-3">
                          <div class="mb-3">
						  <?php 
							$query1l= mysqli_query($conn,"SELECT * FROM daily_production ORDER BY `id` DESC");
							while($rowsl = mysqli_fetch_assoc($query1l))
							{
								$tots=$tots+$rowsl['total_load'];
							}
					?>
                            <label class="form-label">Total Load So For<span class="form-required">*</span></label>
                            <input type="text" name="load_so_for"  placeholder='Loads' class="form-control" value="<?php echo $tots; ?>" autofocus readonly required autocomplete="off"/>
                          </div>
                        </div>
                      </div>
					  
					  
							
				    
</div>
</div>
						
</div>		
</div>		
			
  <div class="card-footer text-right">
  <div class="d-flex">
  
     <a href="daily_production.php" class="btn btn-link">Cancel</a>
    <button type="submit" name="submit_row" class="btn btn-primary ml-auto">Submit</button>
  </div>
</div>
   </form>
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
					   date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
											if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
									{					
		
									$query2 = mysqli_query($conn,"select * from daily_production where dailydate='$date' order by id asc");
								}
									
									$incz=1;
					while($rowa = mysqli_fetch_array($query2))
					{
							
						
				?>
                        <tr>
                          <td><span class="text-muted"><?php echo $incz; ?></span></td>
                          <td><?php echo $rowa['product']; ?></td>
                          <td><?php echo $rowa['quality']; ?></td>
                          <td><?php echo $rowa['total_load']; ?></td>
                          <td><?php echo $rowa['weight']; ?></td>
                          <td><?php echo $rowa['total_weight']; ?></td>
                          <td><?php echo $rowa['dailydate']; ?></td>
                          <td class="text-right">
                            <a href="edit_daily_production.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="view_production?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Delete</a>
                           
                          </td>
                         
                        </tr>
                        <?php $incz++;  }?>
                      </tbody>
                    </table>
                   
                  </div>
        </div>
        </div>
        </div>
    
 <?php footertemplate(); ?>
      
    </div>
  </body>
  
  
  <script>
                require(['jquery', 'selectize'], function ($, selectize) {
                    $(document).ready(function () {
                        $('#input-tags').selectize({
                            delimiter: ',',
                            persist: false,
                            create: function (input) {
                                return {
                                    value: input,
                                    text: input
                                }
                            }
                        });
                
                        $('#select-beast').selectize({});
                        $('#select-beast1').selectize({});
                        $('#select-beast2').selectize({});
                
                        $('#select-users').selectize({
                            render: {
                                option: function (data, escape) {
                                    return '<div>' +
                                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                        '<span class="title">' + escape(data.text) + '</span>' +
                                        '</div>';
                                },
                                item: function (data, escape) {
                                    return '<div>' +
                                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                        escape(data.text) +
                                        '</div>';
                                }
                            }
                        });
                
                        $('#select-countries').selectize({
                            render: {
                                option: function (data, escape) {
                                    return '<div>' +
                                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                        '<span class="title">' + escape(data.text) + '</span>' +
                                        '</div>';
                                },
                                item: function (data, escape) {
                                    return '<div>' +
                                        '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                        escape(data.text) +
                                        '</div>';
                                }
                            }
                        });
                    });
                });
              </script>
		<script>	  
			  
			  function add_number() {
                   
  var total_load = parseInt(document.getElementById("total_load").value);
  var weight = parseInt(document.getElementById("weight").value);
  var result = total_load * weight;

  document.getElementById("total_weight").value = result;
  
}

</script>
			  
			  
			  
</html>