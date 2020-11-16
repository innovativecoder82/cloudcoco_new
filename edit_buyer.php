<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');

$id=$_GET['id'];

extract($_POST);
if(isset($submit)){
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	
	$query = mysqli_query($conn,"update buyer set buy_name='$buy_name', buy_address='$buy_address', buy_mobile='$buy_mobile', buy_emailid='$buy_emailid' where id='$id'");

	
	echo'<script>alert("Successfully Updated..!");window.location.href="view_buyer.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('add_supplier'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
          <div class="row">
              <div class="col-12">
                <form method="post" class="card">
                  <div class="card-header">
                    <h3 class="card-title">Buyer</h3>
					 <div class="col-auto ml-auto d-print-none">
				   
                <span class="d-none d-sm-inline">
                  <a href="view_buyer.php" class="btn btn-secondary">
                    View
                  </a>
                </span>
                <a href="add_buyer.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Create new 
                </a>
                <a href="#" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal" data-target="#modal-report" aria-label="Create new report">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </a>
              </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                     <div class="col-xl-4">
                      <div class="row">
                      <?php
					$query1= mysqli_query($conn,"SELECT * FROM buyer where id='$id' ORDER BY `id` DESC");
					$rows = mysqli_fetch_assoc($query1);
					 ?>
					  
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Buyer Name<span class="form-required">*</span></label>
                            <input type="text" name="buy_name" value="<?php echo $rows['buy_name']; ?>" class="form-control" autofocus autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
				
                    </div>
                  </div>
                  <div class="col-xl-4">
                    <div class="row">
					
					<div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Address<span class="form-required">*</span></label>
                                 <textarea class="form-control" name="buy_address" data-toggle="autosize" required placeholder="Enter Address…"><?php echo $rows['buy_address']; ?></textarea>
                     
                          </div>
                        </div>
                      </div>
						<div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Mobile<span class="form-required">*</span></label>
                            <input type="number" name="buy_mobile" value="<?php echo $rows['buy_mobile']; ?>" class="form-control" autocomplete="off" required />
                          </div>
                        </div>
                      </div>
								  
					 
                    </div>
                  </div>
                  <div class="col-xl-4">
                    <div class="row">
				
					  
					   <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Email Id<span class="form-required">*</span></label>
                            <input type="email" name="buy_emailid"  value="<?php echo $rows['buy_emailid']; ?>" class="form-control" autocomplete="off" required />
                          </div>
                        </div>
                      </div>
					   <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Comments<span class="form-required">*</span></label>
                                 <textarea class="form-control" name="comments" data-toggle="autosize" required placeholder="Comments…"><?php echo $rows['comments']; ?></textarea>
                     
                          </div>
                        </div>
                      </div>
				
                      
					</div>
					</div>
        
          </div>
          </div>
		  <div class="card-footer text-right">
  <div class="d-flex">
    <a href="add_buyer.php" class="btn btn-link">Cancel</a>
    <button type="submit" name="submit" class="btn btn-primary ml-auto">Submit</button>
  </div>
</div>
</form>
          </div>
          </div>
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
</html>