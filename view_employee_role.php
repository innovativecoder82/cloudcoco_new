<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');
$adsession = $_SESSION['admin'];
$adsessrole = $_SESSION['role'];
if(isset($_GET['id']))
{
	$query2 = mysqli_query($conn,"delete from  role where id='".$_GET['id']."'");
	echo'<script>alert("Deleted successfully..!");window.location.href="view_employee_role.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('view_employee_role'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">View Role</h3>
					  <div class="col-auto ml-auto d-print-none">
				   
                <a href="add_employee_role.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Create new 
                </a>
                <a href="add_employee_role.php" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </a>
              </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th class="w-1">No.</th>
                          <th>Role</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
											if(($adsessrole=='Admin') or ($adsessrole=='HR')){
					$sql = mysqli_query($conn,"SELECT * FROM  role order by id desc");
											}else{												
					$sql = mysqli_query($conn,"SELECT * FROM  role order by id desc");
											}$inc=1;
					while($rowa = mysqli_fetch_array($sql))
					{
							
						
				?>
                        <tr>
                          <td><span class="text-muted"><?php echo $inc; ?></span></td>
                          <td><?php echo $rowa['emp_role']; ?></td>
                          <td class="text-right">
                            <a href="view_employee_role.php?id=<?php echo $rowa['id'];?>" class="btn btn-secondary btn-sm">Delete</a>
                           
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