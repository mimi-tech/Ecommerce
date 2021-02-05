<?php  
session_start();  
if(!isset($_SESSION["uid"]))
{
 header("location:recommend_signup.php");
}else{
   header("Location:../recommend.php"); 
}
?>

