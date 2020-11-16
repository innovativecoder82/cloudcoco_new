<?php
error_reporting(0);

function make_safe($variable) 
{
	include('connection.php');
	$variable = strip_tags(mysqli_real_escape_string($conn,trim($variable)));
	return $variable; 
}

function headertemplate(){ 
	include('connection.php');
	$sqltitle = mysqli_query($conn,"SELECT * FROM site_config");
	$rowtitle = mysqli_fetch_array($sqltitle);


?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
       <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2019-04-04 16:55:45 +0200 -->
    <title><?php echo $rowtitle['site_title']; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="./assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
    <!-- Datatables Plugin -->
    <script src="./assets/plugins/datatables/plugin.js"></script>
  </head>
<?php }


function navbar($active){
	include('templates/session.php');
	$emp_idsess = $_SESSION['admin'];
	$role=$_SESSION['role'];
	?>
		 <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="./index.html">
            Cloudcoco 
			 </a>
              <div class="d-flex order-lg-2 ml-auto">
                
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">Cloudcoco</span>
                      <small class="text-muted d-block mt-1">Administrator</small>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                     <a class="dropdown-item" href="templates/logout.php">
                      <i class="dropdown-icon fe fe-log-out"></i> Sign out
                    </a>
                  </div>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
            
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
				<?php 
					if(($role=='Admin' or $role=='Purchase Manager' or $role=='Accountant' or $role=='Driver' or $role=='Dailywage'))
					{ if(($active=="dashboard")){ ?>
                  <li class="nav-item ">
				  <a href="dashboard.php" class="nav-link active"><i class="fe fe-home"></i> Dashboard</a>
					<?php }else{ ?>
					 <li class="nav-item ">
						 <a href="dashboard.php" class="nav-link"><i class="fe fe-home"></i> Dashboard</a>
				
						
					<?php } ?>
                  </li>
				  <?php }else{} ?>
				  <?php 
					if(($role=='Admin' or $role=='Purchase Manager' or $role=='Accountant' or $role=='Driver' or $role=='Dailywage'))
					{ if(($active=="add_employee") or ($active=="view_employee") or ($active=="add_employee_role") or ($active=="view_employee_role") or ($active=="add_department") or ($active=="view_department")){ ?>
                 
                  <li class="nav-item ">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-box"></i> Employee</a>
					<?php }else{ ?>
					 <li class="nav-item ">
					 <a href="javascript:void(0)" class="nav-link " data-toggle="dropdown"><i class="fe fe-box"></i> Employee</a>
					<?php } ?>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="add_employee_role.php" class="dropdown-item ">Add Employee Role</a>
                      <a href="view_employee_role.php" class="dropdown-item ">View Employee Role</a>
					   <a href="add_department.php" class="dropdown-item ">Add Department</a>
                      <a href="view_department.php" class="dropdown-item ">View Department</a>
                      <a href="add_employee.php" class="dropdown-item ">Add Employee</a>
                      <a href="view_employee.php" class="dropdown-item ">View Employee</a>
                    </div>
					
                  </li>
				  <?php }else{} ?>
				    <?php 
					if(($role=='Admin' or $role=='Purchase Manager' or $role=='Accountant' or $role=='Driver' or $role=='Dailywage'))
					{ if(($active=="add_raw") or ($active=="view_raw") or ($active=="add_raw_material") or ($active=="view_raw_material") or ($active=="raw_material_pending_amt")){ ?>
                 
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-calendar"></i> Raw Material</a>
					<?php }else{ ?>
					<li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-calendar"></i> Raw Material</a>
					<?php } ?>
                  
                    <div class="dropdown-menu dropdown-menu-arrow">
					<a href="add_raw.php" class="dropdown-item ">Add Raw Material</a>
                      <a href="view_raw.php" class="dropdown-item ">View Raw Material</a>
                      <a href="add_raw_material.php" class="dropdown-item ">Raw Material Purchase</a>
                      <a href="view_raw_material.php" class="dropdown-item ">View Raw Material Purchased</a>
                      <a href="raw_material_pending_amt.php" class="dropdown-item ">Raw Material Pending Amount</a>
                    </div>
                  </li>
				 <?php }else{} ?>	
<?php 
					if(($role=='Admin' or $role=='Purchase Manager' or $role=='Accountant' or $role=='Driver' or $role=='Dailywage'))
					{ if(($active=="add_supplier") or ($active=="view_supplier")){ ?>
                 				
				  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-server"></i> Supplier</a>
					<?php }else{ ?>
					 <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-server"></i> Supplier</a>
					<?php } ?>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="add_supplier.php" class="dropdown-item ">Add Supplier</a>
                      <a href="view_supplier.php" class="dropdown-item ">View Supplier</a>
                      <a href="add_supplier_advance.php" class="dropdown-item ">Add Supplier Advance</a>
                      <a href="view_supplier_advance.php" class="dropdown-item ">View Supplier Advance</a>
                      
                    </div>
                  </li>
				   <?php }else{} ?>
				  <?php 
					if(($role=='Admin' or $role=='Purchase Manager' or $role=='Accountant' or $role=='Driver' or $role=='Dailywage'))
					{ if(($active=="add_emp_attendance") or ($active=="view_emp_attendance")){ ?>
                 
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-rotate-cw"></i> Attendance</a>
					<?php }else{ ?>
					 <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-rotate-cw"></i> Attendance</a>
				<?php } ?>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="add_emp_attendance.php" class="dropdown-item ">Add Attandance</a>
                      <a href="view_emp_attendance.php" class="dropdown-item ">View Attandance</a>
                     
                      
                    </div>
                  </li>
				   <?php }else{} ?>
				  <?php 
					if(($role=='Admin' or $role=='Purchase Manager' or $role=='Accountant' or $role=='Driver' or $role=='Dailywage'))
					{ if(($active=="add_sales") or ($active=="view_sales") or ($active=="add_buyer") or ($active=="view_buyer") or ($active=="buyer_notification")){ ?>
                 
				   <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-tag"></i> Sales</a>
					<?php }else{ ?>
					  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-tag"></i> Sales</a>
				<?php } ?>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="add_sales.php" class="dropdown-item ">Add Sales</a>
                      <a href="view_sales.php" class="dropdown-item ">View Sales</a>
                      <a href="add_buyer.php" class="dropdown-item ">Add Buyer</a>
                      <a href="view_buyer.php" class="dropdown-item ">View Buyer</a>
                      <a href="buyer_notification.php" class="dropdown-item ">Buyer Notification</a>
                     
                      
                    </div>
                  </li>
				   <?php }else{} ?>
				  <?php 
					if(($role=='Admin' or $role=='Purchase Manager' or $role=='Accountant' or $role=='Driver' or $role=='Dailywage'))
					{ if(($active=="daily_production") or ($active=="view_production")){ ?>
                 
				  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-bar-chart"></i> Production</a>
					<?php }else{ ?>
					 <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-bar-chart"></i> Production</a>
				<?php } ?>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="daily_production.php" class="dropdown-item ">Add Daily Production</a>
                      <a href="view_production.php" class="dropdown-item ">View Production</a>
                     
                      
                    </div>
                  </li>
				   <?php }else{} ?>
				  <?php 
					if(($role=='Admin' or $role=='Purchase Manager' or $role=='Accountant' or $role=='Driver' or $role=='Dailywage'))
					{ if(($active=="add_product_purchase") or ($active=="view_product_purchase") or ($active=="add_product") or ($active=="view_product")){ ?>
                 
				   <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-shuffle"></i> Product Purchase</a>
					<?php }else{ ?>
					 <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-shuffle"></i> Product Purchase</a>
					<?php } ?>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="add_product.php" class="dropdown-item ">Add Product </a>
                      <a href="view_product.php" class="dropdown-item ">View Product </a>
                      <a href="add_product_purchase.php" class="dropdown-item ">Add Product Purchase</a>
                      <a href="view_product_purchase.php" class="dropdown-item ">View Product Purchase</a>
                     
                      
                    </div>
                  </li>
				   <?php }else{} ?>
				  <?php 
					if(($role=='Admin' or $role=='Purchase Manager' or $role=='Accountant' or $role=='Driver' or $role=='Dailywage'))
					{ if(($active=="add_daily_expenses") or ($active=="view_daily_expenses")){ ?>
                 
				    <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-edit"></i> Expenses</a>
					<?php }else{ ?>
					 <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-edit"></i> Expenses</a>
					<?php } ?>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="add_daily_expenses.php" class="dropdown-item ">Add Expenses Details</a>
                      <a href="view_daily_expenses.php" class="dropdown-item ">View Expenses Details</a>
                     
                      
                    </div>
                  </li>
				   <?php }else{} ?>
				  <?php 
					if(($role=='Admin' or $role=='Purchase Manager' or $role=='Accountant' or $role=='Driver' or $role=='Dailywage'))
					{ if(($active=="add_advance") or ($active=="view_advance")){ ?>
                 
				   <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-stop-circle"></i> Advance</a>
					<?php }else{ ?>
					<li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-stop-circle"></i> Advance</a>
					<?php } ?>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="add_advance.php" class="dropdown-item ">Add Employee Advance</a>
                      <a href="view_advance.php" class="dropdown-item ">View Employee Advance</a>
                     
                      
                    </div>
                  </li>
				   <?php }else{} ?>
				   <?php 
					if(($role=='Admin' or $role=='Purchase Manager' or $role=='Accountant' or $role=='Driver' or $role=='Dailywage'))
					{ if(($active=="report_emp_attendance") or ($active=="view_today_absent")or ($active=="view_today_present")or ($active=="report_production")or ($active=="report_daily_expenses")or ($active=="report_product_purchase")or ($active=="report_sales")){ ?>
                 
				   <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown"><i class="fe fe-file"></i> Report</a>
					<?php }else{ ?>
					<li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i> Report</a>
					<?php } ?>
                    <div class="dropdown-menu dropdown-menu-arrow">
					   <a href="view_today_absent.php" class="dropdown-item ">Today Absent</a>
                      <a href="view_today_present.php" class="dropdown-item ">Today Present</a>
                      <a href="report_emp_attendance.php" class="dropdown-item ">Salary</a>
                      <a href="report_production.php" class="dropdown-item ">Production Report</a>
                      <a href="report_product_purchase.php" class="dropdown-item ">Product Purchase Report</a>
                      <a href="report_sales.php" class="dropdown-item ">Sales Report</a>
                      <a href="report_daily_expenses.php" class="dropdown-item ">Daily Expenses Report</a>
                    
                     
                      
                    </div>
                  </li>
				   <?php }else{} ?>
                  
                 
                </ul>
              </div>
            </div>
          </div>
        </div>
<?php }

function footertemplate(){
	
?>
 <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="row align-items-center">
              
                <div class="col-auto">
                  Cloudcoco
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Developed by Cloudcoco.
            </div>
          </div>
        </div>
      </footer>
	  	<script>
					require(['datatables', 'jquery'], function(datatable, $) {
                      	
	$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#basic-datatables thead tr').clone(true).appendTo( '#basic-datatables thead' );
    $('#basic-datatables thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
    var table = $('#basic-datatables').DataTable( {
        
        orderCellsTop: true,
        fixedHeader: true,
		order: [[0, 'desc']],
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
 });
						  
	</script>
<?php } 

function footertemplates(){?>

<?php }

/*
 * Function to convert a number into readable Currency
 *
 * @param string $n   			The number
 * @param string $n_decimals	The decimal position
 * @return string           	The formatted Currency Amount
 *
 * Returns string type, rounded number - same as php number_format()):
 *
 * Examples:
 *		format_amount(54.377, 2) 	returns 54.38
 *		format_amount(54.004, 2) 	returns 54.00
 *		format_amount(54.377, 3) 	returns 54.377
 *		format_amount(54.00007, 3) 	returns 54.000
 */
function format_amount($n, $n_decimals) {
	return ((floor($n) == round($n, $n_decimals)) ? number_format($n).'.00' : number_format($n, $n_decimals));
}

/*
 * Function to Encrypt user sensitive data for storing in the database
 *
 * @param string	$value		The text to be encrypted
 * @param 			$encodeKey	The Key to use in the encryption
 * @return						The encrypted text
 */
function encryptIt($value) {
	// The encodeKey MUST match the decodeKey
	$encodeKey = 'd9eHUepkbO,@Yt7&a%cQ8/@t$r';
	$encoded = md5($value);
	return($encoded);
}

/*
 * Function to decrypt user sensitive data for displaying to the user
 *
 * @param string	$value		The text to be decrypted
 * @param 			$decodeKey	The Key to use for decryption
 * @return						The decrypted text
 */
function decryptIt($value) {
	// The decodeKey MUST match the encodeKey
	$decodeKey = 'd9eHUepkbO,@Yt7&a%cQ8/@t$r';
	$decoded = md5($value);
	return($decoded);
}

function month_diff_with_days($date1){ 

	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	
	$year1 = date('Y', strtotime($date1));
	$year2 = date('Y', strtotime($date));

	$month1 = date('m', strtotime($date1));
	$month2 = date('m', strtotime($date));

	$day1 = date('d', strtotime($date1)); /* I'VE ADDED THE DAY VARIABLE OF DATE1 AND DATE2 */
	$day2 = date('d', strtotime($date));

	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
	/* IF THE DAY2 IS LESS THAN DAY1, IT WILL LESSEN THE $diff VALUE BY ONE */

	if($day2<$day1){ $diff=$diff-1; }
	return($diff);
}
?>

				
	<!-- Start Datatable Export Plugins-->        
    <script type="text/javascript" src="tableexport/tableExport.js"></script>
	<script type="text/javascript" src="tableexport/html2canvas.js"></script>
	<script type="text/javascript" src="tableexport/jquery.base64.js"></script>
	<script type="text/javascript" src="tableexport/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="tableexport/jspdf/libs/base64.js"></script>
	<script type="text/javascript" src="tableexport/jspdf/libs/sprintf.js"></script>        
    <!-- End Datatable Export Plugins-->
<!-- DataTables -->
<script src="public/datatables/jquery.dataTables.min.js"></script>
<script src="public/datatables/dataTables.bootstrap.min.js"></script>
<!-- start print -->
<script src="public/datatables-export/js/dataTables.buttons.min.js"></script>