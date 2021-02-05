<?php

session_start();

include('../connection/db.php');
// see if the auto-login cookie exists, if so set sessions vars
if(isset($_COOKIE["user"])){
    $name = $_COOKIE["user"];
$sql = "SELECT * FROM user_info WHERE user_id = '$name'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        
        
        if($resultCheck > 1) {
             header("Location: /chilee/index.php");
        }else{
            if($row = mysqli_fetch_assoc($result)){


        if($name == $row['user_id']) {
                    $_SESSION['uid'] = $row['user_id'];
                    $_SESSION['u_token'] = $row['token'];
                    $_SESSION['u_first'] = $row['first_name'];
                    $_SESSION['u_last'] = $row['last_name'];
                    $_SESSION['u_email'] = $row['email'];
                   $_SESSION['u_phone'] = $row['phone'];
                   
                    $_SESSION['u_address'] = $row['shipping_address'];
          
           header("Location: /chilee/index.php");
        }
}
        }
}else{
   header("Location: /chilee/index.php");  
}

?>

