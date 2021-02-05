

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FOREVER HOTEL</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
    <link rel="stylesheet" href="up_date.css" />
</head>
<body>
    
<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                          
											<th>email</th>
											
											<th>name</th>
											<th>codes</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
				<?php
                include('db.php');
                    
				$sql =  "SELECT * FROM code";
										$run_query = mysqli_query($con,$sql);
                                          $count = mysqli_num_rows($run_query);
                                          if($count > 0){
                                               $item_count= 0;
                                             while($row = mysqli_fetch_array($run_query)){  
										
					                    $email = $row["email"];
                                        $name = $row["first_name"];         
											$code = $row['codes'];
                                            
                                         
											
												echo"
                                                
													<td>".$row['email']."</td>
													<td>".$row['first_name']."</td>
													
													<td>".$row['codes']."</td>
                                                    
													
													</tr>";
				
                                        
                                            require 'PHPMailerAutoload.php';
                                         $mail = new PHPMailer;
 
		                      
        $mail->SMTPDebug = 6;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'testmetesting45@gmail.com';                 // SMTP username
$mail->Password = 'kelvinmiriam';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('testmetesting45@gmail.com', 'Chilee project');
$mail->addAddress($email, 'testing');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('testmetesting45@gmail.com');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'bulk message';

$mail->Body    =  'i am only testing bulk sms';

$mail->AltBody = 'Please send ooo';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent to User name : '.$name.' Email:  '.$email.'<br><br>';
}                                    
                                            
                                            
                                        }
                                              
                                          }
                                        
                    
				?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
    </div>
    
    
					
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    
</body>

</html>