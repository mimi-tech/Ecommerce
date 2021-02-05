 <?php

    include ('db.php');
    
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

$sqlk = "SELECT * FROM code";
    $kquery = mysqli_query($con, $sqlk);
while($rowk = mysqli_fetch_array($kquery)){
     $citem = array();
    $citem = array(
                        
                  
   'email' => $rowk['email'],
    'code' => $rowk['codes']
        );
    $clientItems[] = $citem;
    foreach($clientItems as $citem){ 
$mail->addAddress($citem['email'], 'testing');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('testmetesting45@gmail.com');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $sub;

$mail->Body = '<p >'.$citem['codes'].' </p> ';    

$mail->AltBody = 'Please send ooo';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'ok';
}
}
}
?>
   