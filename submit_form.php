
 <?php

 session_start();

 require_once 'db.php';

 if(isset($_POST["userLogin"])){
 
    $user_id = $_SESSION["uid"];  
 $fName = mysqli_real_escape_string($conn, $_POST['userName']);
 
$lName= mysqli_real_escape_string($conn, $_POST['userLame']);
$phone= mysqli_real_escape_string($conn, $_POST['userPhone']);     
$email = mysqli_real_escape_string($conn, $_POST['userEmail']);
 
$address= mysqli_real_escape_string($conn, $_POST['userAddress']);
     
    
   
   $query = "UPDATE user_info SET  first_name ='$fName', last_name = '$lName', email = '$email', phone = '$phone',   shipping_address='$address' WHERE user_id = $user_id ";
      
     
       $res = mysqli_query( $conn, $query);
   
    if($res){ 
   
   
         $status =  'Yes';
        
    }
  }
  
   
 
 
?>

