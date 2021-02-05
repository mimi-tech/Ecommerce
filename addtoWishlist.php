<?php
session_start();
include 'db.php';
session_start();
if(isset($_POST['product_id'])) {  
    $addmemberid = $_SESSION['uid'];
    $addproductid = $_POST['product_id'];

    $result = ("SELECT * FROM wish_list WHERE user_id = '$addmemberid' AND w_p_id = '$addproductid'");
    $run_query = mysqli_query($conn, $result);
    $countid = mysqli_fetch_assoc($run_query);
    if($countid > 1){
   $res_del =  ("DELETE FROM wish_list WHERE w_p_id = '$addproductid' AND user_id= '$addmemberid'"); 
         $run_del = mysqli_query($conn, $res_del);
        if($run_del){
        echo '0';
    } 
    }else {
        $res ="INSERT INTO wish_list (w_p_id, user_id) VALUES ('$addproductid', '$addmemberid')";
        $res_query = mysqli_query($conn, $res);
        if($res_query){
        echo '1';
        }
}
    
  
}
?>


