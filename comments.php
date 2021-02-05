<?php
session_start();
include_once("db.php");
if(!empty($_POST["name"]) && !empty($_POST["comment"])){
	$insertComments = "INSERT INTO comment (parent_id, comment, product_id, sender, email, first_name, last_name) VALUES ('".$_POST["commentId"]."', '".$_POST["comment"]."', '".$_SESSION['id']."', '".$_POST["name"]."', '".$_SESSION['u_email']."', '".$_SESSION['u_first']."', '".$_SESSION['u_last']."')";
	mysqli_query($conn, $insertComments) or die("database error: ". mysqli_error($conn));	
	$message = '<label class="text-success">Comment posted Successfully.</label>';
	$status = array(
		'error'  => 0,
		'message' => $message
	);	
} else {
	$message = '<label class="text-danger">Error: Comment not posted.</label>';
	$status = array(
		'error'  => 1,
		'message' => $message
	);	
}
echo json_encode($status);
?>