<?php
session_start();
unset($_SESSION["uid"]);
setcookie("user","",time()-31556926,'/');

header("location:signin.php?suy=3e5402328927376460982389687623768685128879127");
?>