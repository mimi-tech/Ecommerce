
<?php
 ob_start();
 session_start();
 if ( isset($_GET['suy']) && $_GET['suy'] == 3e5402328927376460982389687623768685128879127)
{
     // treat the succes case ex:
        
     $sucMSG = "You have been logged out successfully"; 
}
 
 include('../connection/db.php');

 $error = false;

 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections
  $fName = trim($_POST['fName']);
  $fName = strip_tags($fName);
  $fName = htmlspecialchars($fName);
     
  $lName = trim($_POST['lName']);
  $lName = strip_tags($lName);
  $lName = htmlspecialchars($lName);
  
     
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
     
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  $confirmpass = trim($_POST['confirmpass']);
  $confirmpass = strip_tags($confirmpass);
  $confirmpass = htmlspecialchars($confirmpass);
     
   $phone = trim($_POST['phone']);
  $phone = strip_tags($phone);
  $phone = htmlspecialchars($phone);
     
     $address = trim($_POST['address']);
  $address = strip_tags($address);
  $address = htmlspecialchars($address);
     
$state = trim($_POST['state']);
  $state = strip_tags($state);
  $state = htmlspecialchars($state);
     
$country = trim($_POST['country']);
  $country = strip_tags($country);
  $country = htmlspecialchars($country);     
  
   $number = "/^[0-9]+$/";  
     
 $Token = bin2hex(openssl_random_pseudo_bytes(40));
  $random_note = time().rand(50000,100000);
    $random_note = str_shuffle($random_note);
  // basic fname validation
   
  if (empty($fName)) {
   $error = true;
   $fnameError = "Please enter your first name.";
  } else if (strlen($fName) < 3) {
   $error = true;
   $fNameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/", $fName)) {
   $error = true;
   $fNameError = "Name must contain alphabets and space.";
  }
     
      
  // basic lname validation
  if (empty($lName)) {
   $error = true;
   $lnameError = "Please enter your last name.";
  } else if (strlen($lName) < 3) {
   $error = true;
   $lNameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/", $lName)) {
   $error = true;
   $lNameError = "Name must contain alphabets and space.";
      
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT *  FROM user_info WHERE email='$email'";
   $result = mysqli_query($conn, $query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
}
  }
     
    
  
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }
     
     // password validation
  if (empty($confirmpass)){
   $error = true;
   $confirmPassError = "Please re-enter your password.";
  } else if($pass != $confirmpass){
        $confirmpassError = "passwords does not match";
  
     
    }else{ 
  // password encrypt using SHA256();
 // $pass = hash('sha256', $pass);
   $hashedpass = password_hash($pass, PASSWORD_DEFAULT);  
   }
    // basic phone no validation
  if (empty($phone)) {
   $error = true;
   $phoneError = "Please enter your mobile number correctly.";
  } else if(!(strlen($phone) == 11)) {    
      $error = true;
   $error = true;
    $phoneError = "Mobile Number incomplete"; 
}else if(!preg_match($number,$phone)){
       $error = true;
      $errTyp = "danger";
    $errMSG = "Invalid Mobile Number"; 
  }
    
     
  // if there's no error, continue to signup
	 
  if ($_POST["check_address"]){
   if( !$error ) {
   $query = "INSERT INTO user_info(user_id, first_name, last_name, email, password,phone, state, country,shipping_address, hash, token, date_added) VALUES(Null,'$fName','$lName', '$email', '$hashedpass','$phone', '$state', '$country','$address', '$random_note',  '$Token',  CURRENT_TIMESTAMP)";
      
       $res = mysqli_query( $conn, $query);
   //$res = mysqli_query($query);
    
   if ($res) {
   
    $msg = "http://yourdomain.com/signup_activate.php?token=$Token";
    
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

$mail->Subject = 'EMAIL VERFICATION ';
$mail->Body = '<p><b>HI!</b>'. $fName.'Click On the link Below to verify your email</p>';
$mail->Body   .= '<p>'.$msg.'</p>';
$mail->AltBody = 'yeah';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
     $errMSG = " Successfull Registered, please verify your email for complete registration";
     unset($fName);
    unset($lName);
    unset($email);
    unset($pass);
}
        
        
    }else{
       $errMSGS = "Not Registered";
        
      
    unset($fName);
    unset($lName);
    unset($email);
    unset($pass);
        
   }
  
   }
   } else {
  if( !$error ) {
    //$errTyp = " <div id = 'msg'>Not Successful </div>";
       $query = "INSERT INTO user_info(user_id, first_name, last_name, email, password,phone, state, country,shipping_address, hash, token, date_added) VALUES(Null,'$fName','$lName', '$email', '$hashedpass','$phone', '$state', '$country','', '$random_note',  '$Token',  CURRENT_TIMESTAMP)";
      
       $res = mysqli_query( $conn, $query);
   //$res = mysqli_query($query);
    
   if ($res) {
   
    $msg = "http://yourdomain.com/signup_activate.php?token=$Token";
    
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

$mail->Subject = 'EMAIL VERFICATION ';
$mail->Body = '<p><b>HI!</b>'. $fName.'Click On the link Below to verify your email</p>';
$mail->Body   .= '<p>'.$msg.'</p>';
$mail->AltBody = 'yeah';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
     $errMSG = " Successfull Registered, please verify your email for complete registration";
    
}
        
        
    }else{
       $errMSGS = "Not Registered";
        
      
    unset($fName);
    unset($lName);
    unset($email);
    unset($pass);
        
        
    }
       
   }
  }
     
 }
   
 
    
  
  
  
 
?>

 <?php include '../includes/head.php';?>
 
  
  
  <center>
      <h2><?php echo $sucMSG;?></h2>
  </center>
   
   <div class="signup-form">
   
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
   
       <div class="wrapper wrapper--w960">
			<div class="card card-2">
				<div class="card-heading">
					<a role="button" class="btn-login" href="login.php">Login</a>
					
				</div>
				<div class="card-body">
					<h2 class="title">Registration Info</h2>
       <span class="text-success"><?php echo $errMSG;?></span>
  <span class="text-warning"><?php echo $errMSGS;?></span>
       <span class="text-warning"><?php echo $errTyp;?></span>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off" class="signin-form">
            
  
    <div class="row row-space">
     <div class="col-2">
      <div class="input-group">
        <input type="text" name="fName" placeholder="First name" value="<?php echo $fName ?>" required class="input--style-2" />
          
               
                     <div class="input-group-addon ">
       
        <span class="fa fa-fw fa-eye field-icon  input-icon js-btn-calendar hidden"></span>
      </div>     
      </div>
       <span class="text-danger"><?php echo $fnameError; ?></span>
		</div>
       <div class="col-2">
           <div class="input-group">
            <input type="text" name="lName"  placeholder=" Last name"  value="<?php echo $lName ?>" required class="input--style-2" />
             <div class="input-group-addon ">
       
        <span class="fa fa-fw fa-eye field-icon  input-icon js-btn-calendar hidden"></span>
      </div>         
         </div>
          <span class="text-danger"><?php echo $lnameError; ?></span>
    </div>
			</div>      
            
    <div class="row row-space">
     
       <div class="col-2">
     
           
           <div class="input-group">
            <input type="password" name="pass"  placeholder=" Password"  required class="input--style-2" id="password-field" /> 
              <div class="input-group-addon">
       
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password input-icon js-btn-calendar"></span>
      </div>
                 
        </div>
           <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
             <div class="col-2">
       <div class="input-group">
        <input type="password" name="confirmpass" placeholder="confirm Password" required class="input--style-2" id="pass_log_id"  />
        
         <div class="input-group-addon">
       
        <span toggle="#pass_log_id" class="fa fa-fw fa-eye field-icon toggle-passwords input-icon js-btn-calendar"></span>
      </div>
        
      </div>
       <span class="text-danger" ><?php echo $confirmpassError; ?></span>
			  </div>
            </div>
           
          <div class="row row-space">
      
      
       <div class="col-2">
       <div class="input-group">
        <input type="text" name="email"  placeholder=" Email"  value="<?php echo $email ?>"  required class="input--style-2"/>
          <div class="input-group-addon ">
       
        <span class="fa fa-fw fa-eye field-icon  input-icon js-btn-calendar hidden"></span>
      </div>     
      </div>
      <span class="text-danger" ><?php echo $emailError; ?></span>
		</div>
      
       <div class="col-2">
       <div class="input-group">
       <input type="tel" name="phone"  placeholder="Mobile No"  required class=" input--style-2" />
              <div class="input-group-addon ">
       
        <span class="fa fa-fw fa-eye field-icon  input-icon js-btn-calendar hidden"></span>
      </div>         
		   </div> 
       <span class="text-danger" ><?php echo $phoneError; ?></span>  
        </div>
            </div>
            
            
            <?php

								$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

								?>
                                
                                
                                 <div class="row row-space">
                                <div class="col-2">
								<div class="input-group">
                                          <div class="rs-select2 js-select-simple select--no-search">
                                            <select name="country" class="select-input input--style-2" required>
												<option value selected disabled="disabled" selected="selected">Country</option>
                                                <?php
												foreach($countries as $key => $value):
												echo '<option value="'.$value.'">'.$value.'</option>'; //close your tags!!
												endforeach;
												?>
                                            </select>
                                            <div class="select-dropdown"></div>
									</div>
								</div>
                                     </div>
                                     
                                     
                                     <div class="col-2">
								<div class="input-group">
                                          
            <input type="text" name="state"  placeholder="State" autocomplete="off" required class=" input--style-2" />
            <div class="input-group-addon ">
       
        <span class="fa fa-fw fa-eye field-icon  input-icon js-btn-calendar hidden"></span>
      </div>     
								</div>
                                     <span class="text-danger" ><?php echo $stateError; ?></span> 
                                     </div>
                                     
            </div>
            
            
          
         
			
           	
           	 <textarea class=" input--style-2" name="address" placeholder="Your Shipping Address ...."></textarea>
    <div class="row row-space">       	 
         <div class="col-2">
								<div class="input-group">
                                          
    <!-- .roundedTwo -->
    
   <div class="roundedOne">
      <input type="checkbox" value="None" id="roundedOne" name="check_address" />
      <label for="roundedOne"></label>
    </div>
    <p>Do You want to have this as Your Shipping Address</p>
			 </div>
			</div>  
           	
           	  	 <div class="col-2">
								<div class="input-group">
                                          
    <!-- .roundedTwo -->
    <div class="squaredOne">
      <input type="checkbox" value="None" id="squaredOne" name="check"  required/>
      <label for="squaredOne">
              </label>
    </div>
    I agree to the <a href="#" > Terms &amp; conditions</a>
    <!-- end .roundedTwo -->
  </div>
			</div>    	 
			</div>	   	 
           	  	   	   	   	 
            	<div class="p-t-30">
             <button type="submit" class="btn btn--radius btn--green" name="btn-signup">Submit</button>
              
					</div>
				
					</form>
		   </div>
		</div>
</div>
	
		
</div>
</div>         
    
  
      
      
        
     

 
  <?php include '../includes/footer.php';?>
      
 
  
     
  
  
   
  
   