<?php
session_start();
 include('../connection.php');

    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['token']) && !empty($_GET['token'])){
    $TokenFromUrl = $_GET['token'];
        
    $email = mysqli_real_escape_string($conn, $_POST['email']);
   $token = mysqli_real_escape_string($conn, $_POST['token']);
        
         $sql = "SELECT * FROM user_info WHERE email = '$email' AND token = '$token' And statues = 0";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        
        
        if($resultCheck > 0) {
            $query = "UPDATE user_info SET statues = 1 WHERE token='$TokenFromURL'";
    $Execute = mysqli_query($conn, $query);
    if($Execute){
        echo "Account activated successfully Click <a href='index.php'>here</a> to login";
        
        }else{
    echo 'The url is either invalid or you already have activated your account.';
    }
}
    }else{
        echo "Invalid approach, please use the link that has been sent to your email.
        <a href = 'index.php'>Create Account</a>
        ";
       
    }
?>

