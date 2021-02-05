<?php
include '../db.php';
?>
          <?php
if(isset($_POST['log'])){ 
    include '../db.php';
    $news = mysqli_real_escape_string($con, $_POST['news']);
$sub= mysqli_real_escape_string($con, $_POST['subject']);
   require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
 
		                      
        $mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'testmetesting45@gmail.com';                 // SMTP username
$mail->Password = 'kelvinmiriam';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('testmetesting45@gmail.com', 'Chilee project');

$sqlk = "SELECT email, codes FROM code ORDER BY codes";
    $kquery = mysqli_query($con, $sqlk);
while($rowk = mysqli_fetch_array($kquery)){
   $email = $rowk['email'];
    $code = $rowk['codes'];
$mail->addAddress($email, 'testing');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('testmetesting45@gmail.com');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $sub;

$mail->Body = '<p > '.$rowk['codes'].' </p> ';    

$mail->AltBody = 'Please send ooo';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    $result =  'Message has been sent';
}
}
}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Send Bulk Email using PHPMailer with Ajax PHP</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
   
   <?php include '../includes/navigation.php';?>
		<br /><br /><br /><br />
		<div class="container">
			
			<br />
			
<span class="text-success"><?php echo $result; ?></span>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<tr>
					<th>s/n</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Code</th>
						<th>Select</th>
						<th>Action</th>
					</tr>
				<?php
                
                    
				$sql =  "SELECT * FROM code";
										$run_query = mysqli_query($con,$sql);
                                          $count = mysqli_num_rows($run_query);
                                          if($count > 0){
                                             
                                                
                                             while($row = mysqli_fetch_array($run_query)){ 
                                             $nums++;
                                              $no = 0;
                                              $no = $no + 1;
                                                 $hashedtoken = password_hash($row['codes'], PASSWORD_DEFAULT);
										
					echo '
					<tr>
                    <td>'.$no.'</td>
						<td>'.$row["first_name"].'</td>
                        <td>'.$row["last_name"].'</td>
						<td>'.$row["email"].'</td>
                        <td>'.$hashedtoken.'</td>
						<td>
							<input type="checkbox" name="single_select" class="single_select" data-email="'.$row["email"].'" data-name="'.$row["codes"].'" />
						</td>
						<td>
						<button type="button" name="email_button" class="btn btn-info btn-xs email_button" id="'.$nums++.'" data-email="'.$row["email"].'" data-name="'.$row["codes"].'" data-action="single">Send Single</button>
						</td>
					</tr>
					';
                                             }
                                          }
                                          
                   
				?>
					<tr>
						
						 
						
					</tr>
					
					
				</table>
			</div>
		</div>
		<div class="panel-body">
                            <button class="btn btn-lg" data-toggle="modal" data-target="#myModal" id="button-edit">
                              Send Bulk
                            </button>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Compose News Letter</h4>
                                        </div>
										<form method="post" action="<?php echo htmlspecialchars ( $_SERVER ['PHP_SELF'] ); ?>">
                                       
										<div class="modal-body">
                                            <div class="form-group">
                                            <label>Subject</label>
                                            <input name="subject" class="form-control" placeholder="Enter Subject" id="header" required>
											</div>
                                        </div>
										<div class="modal-body">
										<div class="form-group">
										  <label for="comment">News</label>
										  <textarea name="news" class="form-control" rows="5" id="message" required></textarea>
										</div>
										 </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											
                                            <button type="submit" name="log"  class="btn btn-primary" > send</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
						
		
		
	
                                  

<script>
$(document).ready(function(){
	$('.email_button').click(function(){
		$(this).attr('disabled', 'disabled');
		var id  = $(this).attr("id");
		var action = $(this).data("action");
		var email_data = [];
		if(action == 'single')
		{
			email_data.push({
				email: $(this).data("email"),
				name: $(this).data("name")
			});
		}
		else
		{
			$('.single_select').each(function(){
				if($(this).prop("checked") == true)
				{
					email_data.push({
						email: $(this).data("email"),
						name: $(this).data('name')
                        
					});
				} 
			});
		}

		$.ajax({
			url:"send_mail.php",
			method:"POST",
			data:{email_data:email_data},
			beforeSend:function(){
				$('#'+id).html('Sending...');
				$('#'+id).addClass('btn-danger');
			},
			success:function(data){
				if(data == 'ok')
				{
					$('#'+id).text('Success');
					$('#'+id).removeClass('btn-danger');
					$('#'+id).removeClass('btn-info');
					$('#'+id).addClass('btn-success');
				}
				else
				{
					$('#'+id).text(data);
				}
				$('#'+id).attr('disabled', false);
			}
		})

	});
});
    
   
</script>

