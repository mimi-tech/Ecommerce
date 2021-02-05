<?php
session_start();
if(isset($_POST["forgotPass"])){
    //connect to my database
   $connection = new mysqli("localhost", "root", "root", "chile");
    
    $email = $connection->real_escape_string($_POST["email"]);
    $data = $connection->query("SELECT user_id FROM user_info WHERE email = '$email'");
    if($data->num_rows > 0){
        
         $random_note = time().rand(50000,100000);
         $random_note = str_shuffle($random_note);
        $url = "http://domain.com/passwordreset.php?note=$random_note&email=$email";
        
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
$mail->addAddress($email, 'testing');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('testmetesting45@gmail.com');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Reset Password ';
$mail->Body = '<p><b>Hi!</b>'. $_SESSION["u_first"].'Click On the link helow to reset your password</p>';
$mail->Body   .= '<p>'.$url.'</p>';
$mail->AltBody = 'yeah';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    $connection->query("UPDATE user_info SET note='$random_note' WHERE email= '$email'");
        $error = true;
        $Error = "please check your email, we have sent you a reset link";
}
        
        
        
    }else{
        $error = true;
   $Error = "Your email address does not exit.";
    }
    
    
}


?>
<?php include '../includes/head.php'?>
      
    <div class="signup-form">
   
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
   
       <div class="wrapper wrapper--w960">
			<div class="card card-2">
				<div class="card-heading">
				
				</div>
				<div class="card-body">
					<h2 class="title">Reset Password</h2>
     
     
      
        <span><?php echo $Error; ?></span> 
      
        
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">  
     
          <div class="input-group"> 
        <input type="text" id="fname" name="email"  placeholder=" Email Address.."  required  class="input--style-2" />
         <div class="input-group-addon ">
       
        <span class="fa fa-fw fa-eye field-icon  input-icon js-btn-calendar hidden"></span>
      </div>     
		  </div>
         <div class="p-t-30">
          <button type="submit" class="btn btn--radius btn--green btn-lg" name="forgotPass"  >Submit</button>
		  </div>
     
    
          
          
     
          
         
      </form>
		</div>
		   </div>
        </div>
        </div>
</div>
       
        
          
 <?php include '../includes/footer.php'?>