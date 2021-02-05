<?php
header('Content-type: application/json; charset=UTF-8');
response = array();
if($_POST['delete']){
    include 'db.php';
    $pid = $_POST['delete'];
    $query = "DELETE FROM cart WHERE id = '$pid'";
    $result = mysqli_query($conn, $query);
    if($result){
        $respnse['status'] = 'success';
        $respnse['message'] = 'product deleted successfully';
    }else{
        $respnse['statues'] = 'error';
        $respnse['message'] = 'Unable to delete successfully';
    }
    echo json_encode($respnse);
}
?>






















