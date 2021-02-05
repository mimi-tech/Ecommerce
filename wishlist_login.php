<?php include 'includes/head.php';?>


<?php
session_start();


if( isset($_POST['submit'] ) ){ 


 include('db.php');

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
                    
                    
              if(isset($_POST['chi'] ) ){ 
    setcookie("unn",$email,time()+31556926);
    setcookie("pwd",$pwd,time()+31556926);
                }
                    
                    //login the user here
                    $_SESSION['uid'] = $row['user_id'];
                    $_SESSION['u_token'] = $row['token'];
                    $_SESSION['u_first'] = $row['first_name'];
                    $_SESSION['u_last'] = $row['last_name'];
                    $_SESSION['u_email'] = $row['email'];
                   $_SESSION['u_phone'] = $row['phone'];
                   
                    $_SESSION['u_address'] = $row['shipping_address'];
                    $firstName = $_SESSION['uid'];
                      
                    setcookie("user",$firstName,time()+31556926,'/');
                    
                    header("Location:wishlist_login.php?success=1");
                   
                    
        exit();
                    
                
                }
            }
        }
    
}
    
}

?>


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
  
    <div class="container">
     
     
         
         <?php
          
if (isset($_GET['success']) && $_GET['success'] == 1 )
{
     // treat the succes case ex:
      
     $errMSGSS = "You have been logged in successfully"; 
}
          ?>
          <span class="text-success"><?php echo $errMSGSS;?></span>
         <span class="text-success"><?php echo $errMSG;?></span>
  <span class="text-warning"><?php echo $errMSGS;?></span>
       <span class="text-warning"><?php echo $errTyp;?></span>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
            
          <input type="text" placeholder="Email" class="input form-control" name="email"  value="<?php
        
        if(!isset($_COOKIE["unn"])){
            echo "";
        }else{
            echo $_COOKIE["unn"];
        }                                                                                         
        ?>"><br />
           <span class="text-danger" style="text-align:center;"><?php echo $Error; ?></span>
           
           <style>
              
              </style>
           
            <div class="input-group" id="show_hide_password">
          <input type="password" placeholder="Password" class="input form-control" name="password" value="<?php
        
        if(!isset($_COOKIE["pwd"])){
            echo "";
        }else{
            echo $_COOKIE["pwd"];
        }                                                                                         
        ?>"><br />
           <div class="input-group-addon">
        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
      </div>
    </div><br />
             <?php if(!isset($_COOKIE["pwd"])): ?>
              <input type="checkbox" name="chi" value="ch">Remember me <br />
              
                <?php else:?>
              <a href="remove.php"> <input type="checkbox" name="cancel" value="ch" checked>Cancel</a> <br />
              <?php endif;?>  
           <?php echo $loginError; ?>
          <button type="submit" class=" btn " name="submit" >Submit</button>
          <span><a href="forgotpassword.php">I forgot my  password.</a></span>
           <span><a href="front_end/wishlist_signup.php">signup here.</a></span>
           </form>
       </div>
       
            
  
<?php include 'includes/footer.php';?>
   
   <script>
      

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
  
   