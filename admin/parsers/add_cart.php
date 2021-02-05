
<?php
session_start();

require_once 'init.php';
require('UserInfo.php');
$_SESSION["ip"]= UserInfo::get_ip();
$user_id = $_SESSION["uid"];
$product_id = ($_POST['product_id']);
//$size = ($_POST['size']);
$avaliable = ($_POST['avaliable']);
$quantity = ($_POST['quantity']);
$price = ($_POST['price']);
$product_image = ($_POST['product_image']);

 $_SESSION['size'] = $_POST['size'];

if (empty($_SESSION['cart'])){
 $_SESSION['cart'] = array();   
}
array_push($_SESSION['cart'], $product_id); 



$query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");

$product = mysqli_fetch_assoc($query);
$id = $row["id"];
        $pro_name = $product["title"];
        $pro_image = $product["image"];
        $pro_price = $product["price"];
        $product_image = $product["image"];
        $subPrice_array = array($pro_price);
        $subPrice_total = array_sum($subPrice_array);
        $st = $st + $subPrice_total;
       
        


    $db->query("INSERT INTO cart(items,image,expired_date,user_id,quantity,size,product_id, product_image,avaliable,price,grand_total) VALUES ('{$pro_name}','{$pro_image}','{$cart_expire}','{$_SESSION["ip"]}',  '{$quantity}','{$_SESSION["size"]}','{$product_id}', '{$product_image}','{$avaliable}','{$pro_price}','{$st}')");

 $whereIn = implode(',' , $_SESSION['cart']);
  setcookie("cart",$whereIn,time()+31556926, '/');
?>

   
