<?php
error_reporting(0);
include('templates/session.php');
include('templates/functions.php');



extract($_POST);
if(isset($submit)){
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d');
	$time = date('h:i sa');
	$query = mysqli_query($conn,"INSERT INTO buyer_notification (daily_price,comments, date) VALUES('$daily_price','$comments','$date')");

	$sqlzz = mysqli_query($conn,"SELECT * FROM buyer order by id desc");
											
					while($rowazz = mysqli_fetch_array($sqlzz))
					{	
				$by_email=$rowazz['buy_emailid'];
$body = '
<table style="font-family: arial, sans-serif;border-collapse: collapse;width:500px;">
<tr><td colspan="2" style="text-align:center;background-color:#f78f1e;color:#ffffff;"><h3 style="text-align:center;background-color:#f78f1e;color:#ffffff;">Ram Material</h3></td></tr>
    <tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Supplier</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$rowsr['sup_name'].'</td>
    </tr>
    <tr style="background-color: #dddddd;">
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Raw Material</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$rawj['raw_name'].'</td>
    </tr>
    <tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Color</td><td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$rowsr['color'].'</td>
    </tr>
   
</table>';

$sender = $by_email;
$recipient = 'demo@gmail.com';

$subject = "Raw Material";
$headers = 'From:' . $sender;

mail($recipient, $subject, $body, $headers);
					}
	
	
	echo'<script>alert("Successfully Send..!");window.location.href="buyer_notification.php";</script>';
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<?php headertemplate(); ?>
 
  <body class="">
    <div class="page">
      <div class="flex-fill">
       <?php navbar('buyer_notification'); ?>
        <div class="my-3 my-md-5">
          <div class="container">
          <div class="row">
              <div class="col-12">
                <form method="post" class="card">
                  <div class="card-header">
                    <h3 class="card-title">Notification</h3>
					 <div class="col-auto ml-auto d-print-none">
				   
                <span class="d-none d-sm-inline">
                  <a href="buyer_notification.php" class="btn btn-secondary">
                    View
                  </a>
                </span>
                <a href="buyer_notification.php" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Create Notification 
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
                 
					  <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Daily Price<span class="form-required">*</span></label>
                            <input type="text" name="daily_price" class="form-control" autofocus autocomplete="off" required/>
                          </div>
                        </div>
                      </div>
					   <div class="col-md-6 col-xl-12">
						<div class="mb-3">
                          <div class="mb-3">
                            <label class="form-label">Comments<span class="form-required">*</span></label>
                                 <textarea class="form-control" name="comments" data-toggle="autosize" required placeholder="Comments…"></textarea>
                     
                          </div>
                        </div>
                      </div>
				
					
                    </div>
                  </div>
                 
        
          </div>
          </div>
		  <div class="card-footer text-right">
  <div class="d-flex">
    <a href="buyer_notificationd.php" class="btn btn-link">Cancel</a>
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