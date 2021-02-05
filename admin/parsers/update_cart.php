<?php
session_start();
require_once 'init.php';
 require('UserInfo.php');
$user_id= UserInfo::get_ip();
 //$user_id = $_SESSION["uid"];
$mode = $_POST['mode'];
$edit_id = $_POST['edit_id'];
$edit_size = $_POST['edit_size'];
$cartQ = $db->query("SELECT * FROM cart WHERE user_id = '{$user_id}'");
$updated_items = array();
$result = mysqli_fetch_assoc($cartQ);


if($mode == 'remove'){
   
        echo "dbgdgbvgfddb";
    }



if($mode == 'addone'){
    foreach($updated_items as $uitem){ 
    if($uitem["id"] == $edit_id && $uitem["pro_size"] == $edit_size)
     $uitem["qty"] = $uitem["qty"] + 1;
     
}
    if($uitem['qty'] > 0){
        $updated_items = $items;
    }
    
}



 
?>

