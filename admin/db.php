<?php
$server = "localhost";
$username = "root";
$password = "root";
$db       = "chile";

//create a connection
$con = mysqli_connect ( $server, $username, $password, $db );

    //check connection
    
    if(!$con ){
        die( "connection failed: " . mysqli_connect_error() );
    }
     // echo "Connected successfully";


?>