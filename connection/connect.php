
<?php

$db = mysqli_connect('localhost','root','root','chile');
if(mysqli_connect_errno()){
    echo 'database connection failed with the following errors: '.mysqli_connect_error();
    die();
}

define('BASEURL', '/chilee/');

