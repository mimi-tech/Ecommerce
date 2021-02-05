

<?php


$errorMSG = "";

$email = mysqli_real_escape_string($conn, $_POST['email']);
/* EMAIL */
if (empty($_POST["email"])) {
    $errorMSG .= "<p class='text-danger'>Email is required</p>";
} else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errorMSG .= "<p class='text-danger'>Invalid email format</p>";
}else {
   
   // check email exist or not
   $query = "SELECT * FROM contact WHERE email='$email'";
   $result = mysqli_query($conn, $query);
   $count = mysqli_num_rows($result);
   if($count!=0){
   $errorMSG .= "<p class='text-danger'>You have subscribed already</p>";
   
}else{ 
	   $null = "Not Approved";
	    $curdate=date("Y/m/d");
   $sql = "INSERT INTO contact (id, email, cdate, approval)VALUES (NULL, '$email', '$curdate', '$null')";
        
        $run_query = mysqli_query($conn, $sql);
        if($run_query){
      $msg = '<p class="text-success">Your subscription is successful</p>';
			echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
  
   
        
    }
   }
   
  } 
 

echo json_encode(['code'=>404, 'msg'=>$errorMSG]);


?>