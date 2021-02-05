
<?php

$db = mysqli_connect('localhost','root','root','chile');
if(mysqli_connect_errno()){
    echo 'database connection failed with the following errors: '.mysqli_connect_error();
    die();
}
/*
require_once $_SERVER ['DOCUMENT_ROOT'].'/chilee/config.php';


$cart_id = '';
if(isset($_COOKIE[CART_COOKIE])){
    $cart_id = ($_COOKIE[CART_COOKIE]);
    
}

if(isset($_SESSION['success_flash'])){
    echo '<div class="bg-success">
    <p class="text-success text-center">'.$_SESSION['success_flash'].'</p>
    </div>
    ';
    unset($_SESSION['success_flash']);
}
*/
