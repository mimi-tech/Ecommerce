
<?php

$db = mysqli_connect('localhost','root','root','chile');
if(mysqli_connect_errno()){
    echo 'database connection failed with the following errors: '.mysqli_connect_error();
    die();
}

require_once $_SERVER ['DOCUMENT_ROOT'].'/chilee/config.php';

define('BASEURL', '/chilee/');



