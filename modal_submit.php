
      <?php

	
 if(isset($_POST['submi']) ) {
  
  include 'db.php';
     $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
    //basic email validation
	 
	 if(empty($email)){
		 echo 'empty';
	 }else{ 
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   echo 'Invalid';

  } else {
   // check email exist or not
   $query = "SELECT * FROM contact WHERE email='$email'";
   $result = mysqli_query($conn, $query);
   $count = mysqli_num_rows($result);
   if($count!=0){
   
   echo 'used';

}else{ 
	   $null = "Not Approved";
	    $curdate=date("Y/m/d");
   $sql = "INSERT INTO contact (id, email, cdate, approval)VALUES (NULL, '$email', '$curdate', '$null')";
        
        $run_query = mysqli_query($conn, $sql);
        if($run_query){
       echo 'Yes';
    unset($email);
   
        
    }else{
	 echo 'No';
 }
   }
   
  } 
 }
 }
     ?>

     