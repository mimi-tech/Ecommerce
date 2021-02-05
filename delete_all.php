
<?php
 include 'db.php';

$sql = "DELETE FROM cart";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
if($resultset) {
echo "Record Deleted";
}

?>