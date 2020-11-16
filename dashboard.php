<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');
date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	$adsession = $_SESSION['admin'];
	$adsessrole = $_SESSION['role'];
?>

<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('dashboard'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title">
                Dashboard
              </h1>
            </div>
            <div class="row row-cards">
             <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fe fe-pie-chart" title="fe fe-pie-chart"></i>
                    </span>
                    <div>
					<?php 	
		 if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
		 {
					$query2 = mysqli_query($conn,"select * from sales order by id DESC");
		 }
					$inc=0;
					while($row = mysqli_fetch_array($query2))
					{
						
					$inc++;	
							}
				?>
						<?php 	
		 if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
		 {
					$query2a = mysqli_query($conn,"select * from sales where sale_date='$date' order by id DESC");
		 }
					$incc=0;
					while($rowa = mysqli_fetch_array($query2a))
					{
						
					$incc++;	
							}
				?>
                      <h4 class="m-0"><a href="javascript:void(0)"><?php echo $inc; ?> <br/><small>Sales</small></a></h4>
                      <small class="text-muted"><?php echo $incc; ?> Today Sales</small>
                    </div>
                  </div>
                </div>
              </div>
			  <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-yellow mr-3">
                       <i class="fe fe-file"></i>
                    </span>
                    <div>
					<?php 	
		 if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
		 {
					$query2xx = mysqli_query($conn,"select * from  daily_expenses order by id DESC");
		 }
					$dail_exp=0;
					
					while($rowxx = mysqli_fetch_array($query2xx))
					{
						$dail_exp+=$rowxx['amount'];
						
					$inc++;	
							}
				?>
						<?php 	
		 if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
		 {
					$query2zz = mysqli_query($conn,"select * from  daily_expenses where exp_date='$date' order by id DESC");
		 }
					$dail_ex=0;
					
					while($rowzz = mysqli_fetch_array($query2zz))
					{
					$dail_ex+=$rowzz['amount'];
					
					$incc++;	
							}
				?>
                      <h4 class="m-0"><a href="javascript:void(0)">Rs. <?php echo $dail_exp; ?> <br/><small>Total Expenses</small></a></h4>
                      <small class="text-muted">Rs. <?php echo $dail_ex; ?> Today Expenses</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fe fe-users"></i>
                    </span>
                    <div>
					<?php 	
		 if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
		 {
					$query2xx = mysqli_query($conn,"select * from advance_pay_repay order by id DESC");
		 }
					$total_adv=0;
					$total_readv=0;
					while($rowxx = mysqli_fetch_array($query2xx))
					{
						$total_adv+=$rowxx['advance_amt'];
						$total_readv+=$rowxx['advance_repayment'];
					$inc++;	
							}
				?>
						<?php 	
		 if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
		 {
					$query2zz = mysqli_query($conn,"select * from advance_pay_repay where dailydate='$date' order by id DESC");
		 }
					$total_advanc=0;
					$total_readvanc=0;
					while($rowzz = mysqli_fetch_array($query2zz))
					{
					$total_advanc+=$rowzz['advance_amt'];
					$total_readvanc+=$rowzz['advance_repayment'];
					$incc++;	
							}
				?>
                      <h4 class="m-0"><a href="javascript:void(0)">Rs. <?php echo $total_adv; ?> <br/><small>Advance Amount</small></a></h4>
                      <small class="text-muted">Rs. <?php echo $total_advanc; ?> Today Advance Amount</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-yellow mr-3">
                       <i class="fe fe-users"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)">Rs. <?php echo $total_readv; ?> <br/><small>Advance Repayment</small></a></h4>
                      <small class="text-muted">Rs. <?php echo $total_readvanc; ?> Today Repayment</small>
                    </div>
                  </div>
                </div>
              </div>
			   
           <!---
              <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fe fe-database" title="fe fe-database"></i>
                    </span>
                    <div>
					<?php 	
		 if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
		 {
					$query2v = mysqli_query($conn,"select * from daily_production order by id DESC");
		 }
					$total_loads=0;
					while($rowv = mysqli_fetch_array($query2v))
					{
						$total_loads+=$rowv['total_load'];
					$inc++;	
							}
				?>
						<?php 	
		 if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
		 {
					$query2vv = mysqli_query($conn,"select * from daily_production where dailydate='$date' order by id DESC");
		 }
					$total_loa=0;
					while($rowvv = mysqli_fetch_array($query2vv))
					{
					$total_loa+=$rowvv['total_load'];
					$incc++;	
							}
				?>
                      <h4 class="m-0"><a href="javascript:void(0)"><?php echo $total_loads; ?> <br/><small>Total Production</small></a></h4>
                      <small class="text-muted"><?php echo $total_loa; ?> Today Productiion</small>
                    </div>
                  </div>
                </div>
              </div> --->
			  
             
            </div>
			
			 
			 	 <div class="row row-cards">
          <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Production</h3>
                  </div>
                  <div id="chart-development-activity" style="height: 10rem"></div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                  	$(document).ready(function(){
                  		var chart = c3.generate({
                  			bindto: '#chart-development-activity', // id of chart wrapper
                  			data: {
                  				columns: [
                  				    // each columns data
                  					['data1', 			0,<?php 	
		 if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
		 {
					$query2v = mysqli_query($conn,"select * from daily_production order by id DESC");
		 }
					$total_loads=0;
					while($rowv = mysqli_fetch_array($query2v))
					{
						$total_loads+=$rowv['total_load'];
						?>
						 <?php echo $rowv['total_load']; ?>,
						<?php
					$inc++;	
							}
				?>]
                  				],
                  				type: 'area', // default type of chart
                  				groups: [
                  					[ 'data1', 'data2', 'data3']
                  				],
                  				colors: {
                  					'data1': tabler.colors["blue"]
                  				},
                  				names: {
                  				    // name of each serie
                  					'data1': 'Production'
                  				}
                  			},
                  			axis: {
                  				y: {
                  					padding: {
                  						bottom: 0,
                  					},
                  					show: false,
                  						tick: {
                  						outer: false
                  					}
                  				},
                  				x: {
                  					padding: {
                  						left: 0,
                  						right: 0
                  					},
                  					show: false
                  				}
                  			},
                  			legend: {
                  				position: 'inset',
                  				padding: 0,
                  				inset: {
                                      anchor: 'top-left',
                  					x: 20,
                  					y: 8,
                  					step: 10
                  				}
                  			},
                  			tooltip: {
                  				format: {
                  					title: function (x) {
                  						return '';
                  					}
                  				}
                  			},
                  			padding: {
                  				bottom: 0,
                  				left: -1,
                  				right: -1
                  			},
                  			point: {
                  				show: false
                  			}
                  		});
                  	});
                  });
                </script>
                
              </div>
               
             </div>
			 
			 <div class="row row-cards">
          <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <div class="h5">Total Employee</div>
						<?php 	
		 if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
		 {
					$query2zz = mysqli_query($conn,"select * from  employee_details order by id DESC");
		 }
					$incck=0;
					
					while($rowzz = mysqli_fetch_array($query2zz))
					{
					$incck++;
						
							}
				?>
                        <div class="display-4 font-weight-bold mb-4"><?php echo $incck; ?></div>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-red" style="width: <?php echo $incck; ?>%"></div>
                        </div>
                      </div>
                    </div>
                  </div>
				    <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <div class="h5">Today Present</div>
						            <?php 	
		 if(($adsessrole=='Admin')or($adsessrole=='Purchase Manager')or($adsessrole=='Accountant')or($adsessrole=='Driver')or($adsessrole=='Dailywage'))
		 {
					$query2zz = mysqli_query($conn,"select * from  emp_attendance where dailydate='$date' order by id DESC");
		 }
					$inccks=0;
					
					while($rowzz = mysqli_fetch_array($query2zz))
					{
					$inccks++;
						
							}
							$abs=$incck-$inccks;
				?>
                        <div class="display-4 font-weight-bold mb-4"><?php echo $inccks; ?></div>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-green" style="width: <?php echo $inccks; ?>%"></div>
                        </div>
                      </div>
                    </div>
                  </div>
				  <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body text-center">
                        <div class="h5">Today Absent</div>
                        <div class="display-4 font-weight-bold mb-4"><?php echo $abs; ?></div>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-yellow" style="width: <?php echo $abs; ?>%"></div>
                        </div>
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