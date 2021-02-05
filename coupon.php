 <?php
  session_start();     
//connect to database
include('db.php');
$email =  $_SESSION['u_email'];
$uid = $_SESSION['uid'];            
$code = mysqli_real_escape_string($conn, $_POST['name']);

$code_amount = mysqli_real_escape_string($conn, $_POST['amt']);
    
    if(empty($code))  {
      $errorMSG = "<p style='color:red;'>Code is required</<p>";
    }else{
         
        $sql = "SELECT * FROM code WHERE email = '$email' AND user_id = '$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        
        
        if($resultCheck < 1) {
         $errorMSG = "<p style='color:red;'>Sorry You are not yet qulified for this promoclick the link above.</<p>";
        }else{
            if($row = mysqli_fetch_assoc($result)) {
                 $hashedCodeCheck = password_verify($code, $row['codes']);
                if($hashedCodeCheck == false ) {
          $errorMSG = "<p style='color:red;'>Incorate code. Try angain</<p>";
        }else{
			if(empty($errorMSG)){		
					
             $msg = $code_amount/10;
				echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
				
				
			// $_SESSION['tot_coupon'] = $tot; 
			//$errorMSG = "<p style='color:green;'>Succefully, Your amount has been deducted by 10 percent.</p>";
			}
			}
            }
        }
        }
        
if(empty($errorMSG)){
	$msg = "Name: ".$name;
	echo json_encode(['code'=>200, 'msg'=>$msg]);
	exit;
	
}
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

        ?>
      