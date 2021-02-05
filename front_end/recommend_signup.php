
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
   $errTyp = "danger";
    $errMSG = "Mobile Number incomplete"; 
}else if(!preg_match($number,$phone)){
       $error = true;
      $errTyp = "danger";
    $errMSG = "Invalid Mobile Number"; 
  }
    
     
  // if there's no error, continue to signup
  if ($_POST["check_address"]){
   
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
       
   } else {
    
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
  }
     
       
   
 
    
  
  
  
 
?>

      
<?php
session_start();


if( isset($_POST['submit'] ) ){ 

//connect to database
include('../connection/db.php');

$email = mysqli_real_escape_string($conn, $_POST['email']);

$pwd= mysqli_real_escape_string($conn, $_POST['password']);

    //error handler
    //check if input are empty
    if(empty($email) || empty($pwd)) {
       $error = true;
   $Error = "Please fill all the fields.";
    }else{
         
        $sql = "SELECT * FROM user_info WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        
        
        if($resultCheck < 1) {
           $loginError = "<span style='color:red;'>No such user in database.Try again.</span>";
        }else{
            if($row = mysqli_fetch_assoc($result)) {
                //dehashing the password
                
                $hashedPwdCheck = password_verify($pwd, $row['password']);
                if($hashedPwdCheck == false ) {
           $loginError = "<span style='color:red;'>wrong email or password combination.Try again.</span>";
                    
                }elseif ($hashedPwdCheck == true){
                    //login the user here
                    $_SESSION['uid'] = $row['user_id'];
                    $_SESSION['u_token'] = $row['token'];
                    $_SESSION['u_first'] = $row['first_name'];
                    $_SESSION['u_last'] = $row['last_name'];
                    $_SESSION['u_email'] = $row['email'];
                   $_SESSION['u_phone'] = $row['phone'];
                   
                    $_SESSION['u_address'] = $row['shipping_address'];
                    
                    header("Location: /chilee/recommen.php?success=1");
                   
                    
        exit();
                    
                } 
            }
        }
    
}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>store</title>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <script src="../bootstrap/js/bootstrap.min.js"></script>
    
       <!-- Bootstrap -->
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  
  </head>
  <body>
  <style>
*{
  margin: 0;
  padding: 0;
}

body{
  background: #e9eaea;
  font-family: roboto;
  user-select: none;
}

.container{
  width: 450px;
  margin: 30px auto;
}

.signup,
.login{
  width: 50%;
  background: #fff;
  float: left;
  height: 60px;
  line-height: 60px;
  text-align: center;
  cursor: pointer;
  text-transform: uppercase;
}

.signup-form{
  background: #fff;
  padding: 40px;
  clear: both;
  width: 100%;
  box-sizing: border-box;
  height: 500px;
}

.login-form{
  background: #fff;
  padding: 40px;
  clear: both;
  width: 100%;
  box-sizing: border-box;
  height: 450px;
}
      
      
.input{
  width: 100%;
  padding: 20px 10px;
  box-sizing: border-box;
  margin-bottom: 25px;
  border: 2px solid #e9eaea;
  color: #3e3e40;
  font-size: 14px;
  outline: none;
  transform: all 0.5s ease;
}

.input:focus{
  border: 2px solid #34b3a0;
}

.btn{
  width: 100%;
  background: #34b3a0;
  height: 60px;
  text-align: center;
  line-height: 60px;
  text-transform: uppercase;
  color: #fff;
  font-weight: bold;
  letter-spacing: 1px;
  cursor: pointer;
  margin-bottom: 30px;
}

span a{
  text-decoration: none;
  color: #000;
}

::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: #3e3e40;
  font-family: roboto;
}
::-moz-placeholder { /* Firefox 19+ */
  color: #3e3e40;
  font-family: roboto;
}
:-ms-input-placeholder { /* IE 10+ */
  color: #3e3e40;
  font-family: roboto;
}
:-moz-placeholder { /* Firefox 18- */
  color: #3e3e40;
  font-family: roboto;
}
  
      


/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

          
/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
}

   
      
      
      
      
</style>
  
  <center>
      <h2><?php echo $sucMSG;?></h2>
  </center>
   <div class="wrapper">
    <div class="container">
     
      <div class="login">Log In</div>
      <div class="signup">Sign Up </div>
      
      
      <div class="login-form">
         
         <span class="text-success"><?php echo $errMSG;?></span>
  <span class="text-warning"><?php echo $errMSGS;?></span>
       <span class="text-warning"><?php echo $errTyp;?></span>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
            
          <input type="text" placeholder="Email" class="input form-control" name="email"><br />
           <span class="text-danger" style="text-align:center;"><?php echo $Error; ?></span>
           
           
           
            <div class="input-group" id="show_hide_password">
          <input type="password" placeholder="Password" class="input form-control" name="password"><br />
           <div class="input-group-addon">
        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
      </div>
    </div>
           
           
           <?php echo $loginError; ?>
          <button type="submit" class=" btn " name="submit" >Submit</button>
          <span><a href="forgotpassword.php">I forgot my  password.</a></span>
           </form>
       </div>
       
            <div class="signup-form">
       <span class="text-success"><?php echo $errMSG;?></span>
  <span class="text-warning"><?php echo $errMSGS;?></span>
       <span class="text-warning"><?php echo $errTyp;?></span>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
            
  
    <div class="row">
     <div class="col-sm-6">
      
        <input type="text" name="fName"   placeholder="Enter First name" value="<?php echo $fName ?>" required class="form-control input" />
                <span class="text-danger"><?php echo $fnameError; ?></span>
      </div>
      
       <div class="col-sm-6">
            <input type="text" name="lName"  placeholder="Enter Last name"  value="<?php echo $lName ?>" required class="form-control input" />
                 <span class="text-danger"><?php echo $lnameError; ?></span>
         </div>
    </div>
            
            
    <div class="row">
      <div class="col-sm-6">
        <input type="text" name="email"  placeholder="Enter Your Email"  value="<?php echo $email ?>"  required class="form-control input"/>
                
                <span class="text-danger" ><?php echo $emailError; ?></span>
      </div>
        <div class="col-sm-6">
     
           
           <div class="input-group" id="show_hide_passwords">
            <input type="password" name="pass"  placeholder="Enter Password"  required class="form-control input"  /> 
              <div class="input-group-addon">
        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
      </div>
                 <span class="text-danger"><?php echo $passError; ?></span>
        </div>
            </div>
            </div>
           
          <div class="row">
      <div class="col-sm-6">
        <input type="password" name="confirmpass" placeholder="confirm your Password"  required class="form-control input" />
                
                 <span class="text-danger" ><?php echo $confirmpassError; ?></span>
      </div>
        <div class="col-sm-6">
       <input type="tel" name="phone"  placeholder="Mobile No"  required class="form-control input" />
            <span class="text-danger" ><?php echo $phoneError; ?></span>      
            
        </div>
            </div>
            
            
            <?php

								$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

								?>
                                
                                
                                 <div class="row">
                                <div class="col-sm-6 col-sm-6">
								<div class="form-group">
                                          
                                            <select name="country" class="form-control" required>
												<option value selected >Country</option>
                                                <?php
												foreach($countries as $key => $value):
												echo '<option value="'.$value.'">'.$value.'</option>'; //close your tags!!
												endforeach;
												?>
                                            </select>
								</div>
                                     </div>
                                     
                                     
                                     <div class="col-sm-6 col-sm-6">
								<div class="form-group">
                                          
            <input type="text" name="state"  placeholder="State" autocomplete="off" required class="form-control input" />
            <span class="text-danger" ><?php echo $stateError; ?></span> 
								</div>
                                     </div>
                                     
            </div>
            
            
          
          <div class="row">
              <div class="col-sm-12">
                  <textarea class="form-control input" name="address" placeholder="Your Shipping Address ...."></textarea>
                  <input type="checkbox" name="check_address"> Do You want to have this as Your Shipping Address</a>
                   <div class="checkbox" >
            <label>
              <input type="checkbox" s required> I agree to the <a href="#" > Terms &amp; conditions</a>
            </label>
         </div>
         
             <button type="submit" class="btn" name="btn-signup">Submit</button>
              </div>
          </div>
        
  </form>
  
       </div>
      
        
       
       
    </div>
  </div>
      

 
  
  
   
  <footer class="text-center" id="footer">&copy; 2019-2020 kmc technology  </footer>
  <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     
      
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
   
   <script>
       
      $(".signup-form").hide();
       
  $(".login").css("background", "#fff");
  
$(".login").click(function(){
  $(".signup-form").hide();
  $(".login-form").fadeIn(500);
  $(".signup").css("background", "none");
  $(".login").css("background", "#fff");
   $(".login").fadeIn(500); 
     
});
   
 $(".signup").css("background", "none");
      
$(".signup").click(function(){
  $(".signup-form").fadeIn(500);
  $(".login-form").hide();
  $(".login").css("background", "none");
  $(".signup").css("background", "#fff");
  $(".signup").fadeIn(500);
  
});
       

      $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
     
       
       $(document).ready(function() {
    $("#show_hide_passwords a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_passwords input').attr("type") == "text"){
            $('#show_hide_passwords input').attr('type', 'password');
            $('#show_hide_passwords i').addClass( "fa-eye-slash" );
            $('#show_hide_passwords i').removeClass( "fa-eye" );
        }else if($('#show_hide_passwords input').attr("type") == "password"){
            $('#show_hide_passwords input').attr('type', 'text');
            $('#show_hide_passwords i').removeClass( "fa-eye-slash" );
            $('#show_hide_passwords i').addClass( "fa-eye" );
        }
    });
});
      </script>
   
    </body>
</html>