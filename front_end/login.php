

<?php
session_start();


if( isset($_POST['submit'] ) ){ 


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
                    
                    header("Location: /chilee/cart.php?success=1");
                   
                    
        exit();
                    
                
                }
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
					<a role="button" class="btn-login" href="signin.php">Signup</a>
					
				</div>
				<div class="card-body">
					<h2 class="title">Login</h2>
     
     
         <span class="text-success"><?php echo $errMSG;?></span>
  <span class="text-warning"><?php echo $errMSGS;?></span>
       <span class="text-warning"><?php echo $errTyp;?></span>
         <p class="statusMsg"></p>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
            <div class="input-group"> 
          <input type="text" id="inputEmail" placeholder="Email" class="nput--style-2" name="email"  value="<?php
        
        if(!isset($_COOKIE["unn"])){
            echo "";
        }else{
            echo $_COOKIE["unn"];
        }                                                                                       
        ?>">
        
         <div class="input-group-addon ">
       
        <span class="fa fa-fw fa-eye field-icon  input-icon js-btn-calendar hidden"></span>
      </div>     
			  </div>
           <span class="text-danger" style="text-align:center;"><?php echo $Error; ?></span>
           
           
            <div class="input-group" id="show_hide_password">
          <input type="password" id="password-field" placeholder="Password" class="input--style-2" name="password" value="<?php
        
        if(!isset($_COOKIE["pwd"])){
            echo "";
        }else{
            echo $_COOKIE["pwd"];
        }                                                                                         
        ?>">
          <div class="input-group-addon">
       
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password input-icon js-btn-calendar"></span>
      </div>
    </div><br />
             <?php if(!isset($_COOKIE["pwd"])): ?>
          <div class="squaredOne">
              <input type="checkbox" name="chi" value="ch" id="squaredOne" >
              <label for="squaredOne">
              </label>
    
			  </div>
                <p>Remember Password</p>
                <?php else:?>
                
                <div class="squaredOne">
             <input type="checkbox" name="cancel" value="ch" id="squaredOne" checked />
               
               <label for="squaredOne"> 
				  </label>
    
			  </div>
           
             
            
              <?php endif;?>  
           <?php echo $loginError; ?>
         
          <span><a href="forgotpassword.php">I forgot my  password.</a></span>
          
           <div class="p-t-30">
            <button type="submit"  class="btn btn--radius btn--green" name="submit" >Submit</button>
			  </div>
           </form>
       </div>
		   </div>
		</div>
		 </div>
</div>
         
           

<?php include '../includes/footer.php'?>