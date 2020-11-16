<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');
$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];
if(isset($_GET['id']))
{
	$query2 = mysqli_query($conn,"delete from employee_details where id='".$_GET['id']."'");
	echo'<script>alert("Deleted successfully..!");window.location.href="view_employee.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('view_employee'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">View Employee</h3>
					  <div class="col-auto ml-auto d-print-none">
				   
                <a href="add_employee.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Create new 
                </a>
                <a href="add_employee.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </a>
              </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
						  <th>Action</th>
                          <th class="w-1">No.</th>
                          <th>Employee Id</th>
                          <th>Name</th>
                          <th>Role</th>
                          <th>Department</th>
                          <th>Date of Joining</th>
                          <th>Wage</th>
                          <th>Status</th>
                          <th>Address</th>
						  <th>Mobile</th>
                          <th>Email Id</th>
                          <th>Comments</th>
                          <th>Salary</th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  <?php
											if(($adsessrole=='Admin') or ($adsessrole=='HR')){
					$sql = mysqli_query($conn,"SELECT * FROM employee_details order by id desc");
											}else{												
					$sql = mysqli_query($conn,"SELECT * FROM employee_details order by id desc");
											}$inc=1;
					while($rowa = mysqli_fetch_array($sql))
					{
							$empid=$rowa['emp_id'];
						
				?>
                        <tr>
						  <td class="text-right">
                            <a href="edit_employee.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="view_employee.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Delete</a>
                          </td>
                          <td><span class="text-muted"><?php echo $inc; ?></span></td>
                          <td><?php echo $rowa['emp_id']; ?></td>
                          <td>
                            <?php echo $rowa['emp_name']; ?>
                          </td>
                          <td>
                            <?php echo $rowa['emp_role']; ?>
                          </td>
                          <td>
                            <?php echo $rowa['department']; ?>
                          </td>
                          <td>
                             <?php echo $rowa['dateofjoining']; ?>
                          </td>
                          <td><?php echo $rowa['wage']; ?></td>
                          <td><?php echo $rowa['emp_status']; ?></td>
                          <td><?php echo $rowa['address']; ?></td>
                          <td><?php echo $rowa['emp_phone']; ?></td>
                          <td><?php echo $rowa['emp_emailid']; ?></td>
                          <td><?php echo $rowa['comments']; ?></td>
                          <td><?php echo $rowa['salary']; ?></td>
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