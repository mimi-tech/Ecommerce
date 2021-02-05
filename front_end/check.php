
 <?php

 session_start();

 require_once '../db.php';

 if(isset($_POST["userLogin"])){
 
    $user_id = $_SESSION["uid"];  
 $fName = mysqli_real_escape_string($conn, $_POST['userName']);
 
$lName= mysqli_real_escape_string($conn, $_POST['userLame']);
$phone= mysqli_real_escape_string($conn, $_POST['userPhone']);     
$email = mysqli_real_escape_string($conn, $_POST['userEmail']);
 
$address= mysqli_real_escape_string($conn, $_POST['userAddress']);
     
     $number = "/^[0-9]+$/"; 
 
   
  if (empty($fName)) {
    $error = true;  
   echo "empty";
  } else if (strlen($fName) < 3) {
    $error = true;  
   echo "complete";
  } else if (!preg_match("/^[a-zA-Z ]+$/", $fName)) {
    $error = true;  
   echo "Invalid";
  }
     
      
  // basic lname validation
  if (empty($lName)) {
    $error = true;  
   echo "emptys";
  } else if (strlen($lName) < 3) {
$error = true;      
  echo "completes";
  } else if (!preg_match("/^[a-zA-Z ]+$/", $lName)) {
    $error = true;  
   echo "invalids";
      
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
    $error = true;  
   echo "invalidEmail";
  } else {
   // check email exist or not
   $e = "SELECT * FROM user_info WHERE email='$email'";
   $re = mysqli_query($conn, $e);
   $count = mysqli_num_rows($re);
   if($count!=1){
       $error = true;
    echo "doubleEmail";
}
  }
     
    
  
  
    // basic phone no validation
  if (empty($phone)) {
      $error = true;
   echo "phoneEmpty";
  } else if(!(strlen($phone) == 11)) { 
      $error = true;
      echo "phoneError";
}else if(!preg_match($number,$phone)){
      $error = true;
       echo "invalidPhone"; 
  }
     
     // basic phone no validation
  if (empty($address)) {
      $error = true;
   echo "addressError";
  }else{  
  
  if( !$error ) {
   
   
   $query = "UPDATE user_info SET  first_name ='$fName', last_name = '$lName', email = '$email', phone = '$phone',   shipping_address='$address' WHERE user_id = $user_id ";
      
     
       $res = mysqli_query( $conn, $query);
   
    
   
   
        echo "Yes";
        
    
  }
  }
   } else {
   echo"danger";
            
   } 
 
 
?>

