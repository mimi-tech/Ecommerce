<?php
session_start();
include_once("db.php");
if(!empty($_POST['rating']) && !empty($_POST['itemId'])){
	$itemId = $_SESSION['product_id'] ;
	$userID = $_SESSION['uid'];		
	$insertRating = "INSERT INTO item_rating (itemId, userId, ratingNumber, title, comments, created, modified) VALUES ('".$itemId."', '".$userID."', '".$_POST['rating']."', '".$_SESSION['pro_name']."', '".$_POST["comment"]."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')";
	mysqli_query($conn, $insertRating) or die("database error: ". mysqli_error($conn));		
	echo "rating saved!";
}
?>