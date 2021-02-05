
<?php

$db = mysqli_connect('localhost','root','root','chile');
if(mysqli_connect_errno()){
    echo 'database connection failed with the following errors: '.mysqli_connect_error();
    die();
}

require_once $_SERVER ['DOCUMENT_ROOT'].'/chilee/core/config.php';
require_once  '../helpers/helpers.php';
define('BASEURL', '/chilee/');

$cart_id = '';
if(isset($_COOKIE['CART_COOKIE'])){
    $cart_id = sanitize($_COOKIE['CART_COOKIE']);
    echo $cart_id;
}

