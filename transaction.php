        
                                
                                         
<?php 
session_start();
require('UserInfo.php');

$ip= UserInfo::get_ip();
include 'db.php';


/*
$user_id = $_SESSION["uid"];
               
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $run_query = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
       
        while($row = mysqli_fetch_array($run_query)){
            $id = $row["id"];
           $pro_items = $row["items"];
            $pro_size = $row["size"];
             $pro_qty = $row["quantity"];
          $sqlb = "INSERT INTO semi_posts(id, items,sizes, quantity) VALUES (Null, '$pro_items', '$pro_size','$qty')"; 
            
            if(mysqli_query($conn,$sqlb)){
        echo "<h2 class='text-success'> successfully done</h2>";
    }else{
     $error = "<h2 class='text-danger'> Sorry! there is an error</h2>";
        //something went wrong
            echo "Error:" . $sqlb . "<br>" . mysqli_error($conn);   
    }
            
        }
    }
*/


 $curdate=date("Y/m/d");

 $user_id = $_SESSION["uid"];      
if(isset($_POST['submit'])){
	 $items = $_POST['items'];						
     $qty = $_POST['qty'];	
     $avaliable = $_POST['avaliable'];	
     $sizes = $_POST['sizes'];
    $item_count = $_POST['item_count'];	
    $sub_total = $_POST['sub_total'];	
    $total_amt = $_POST['total_amt'];
    $product = $_POST['product'];
   $price = $_POST['price'];
   $u= implode(",", $items);
   $d = implode(",", $qty);     
   $e = implode(",", $avaliable);                                    
   $s = implode(",", $sizes);
  $p = implode(",", $product);    
  
$statues ="Successful";
$new ="Not Confirm";
$newUser="INSERT INTO posts(user_id ,p_id, token , first_name , last_name , email , address , items , quantity , size, product_id ,avaliable , sub_price , total_price , item_count ,phone , statues , confirm ) VALUES ('$user_id', '$ip', '".$_SESSION['u_token']."','".$_SESSION['u_first']."','".$_SESSION['u_last']."','".$_SESSION['u_email']."','".$_SESSION['u_address']."','$u','$d','$s','$p','$e','$sub_total','$total_amt','$item_count', '".$_SESSION['u_phone']."',
'$statues','$new')";
                                
                                
                                
   
if (mysqli_query($conn, $newUser)){
    
     $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 1 ";
    $run_query = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
       
        while($row = mysqli_fetch_array($run_query)){
            $tid = $row["id"];
        }
    }
    
    
   $rpsql = "UPDATE `cart` SET `tes`= 1";
   
    
    if (mysqli_query($conn, $rpsql)){
  
  

               
    $sql = "SELECT * FROM cart WHERE tes = 1 ";
    $run_query = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
       
        while($row = mysqli_fetch_array($run_query)){
            $id = $row["id"];
           $pro_items = $row["items"];
             $pro_id = $row["product_id"];
            $pro_size = $row["size"];
             $pro_qty = $row["quantity"];
             $pro_avaliable = $row["avaliable"];
            $pro_price = $row["price"];
            $s_price = $pro_price * $pro_qty;
            $g = date('F d Y H:i:s');
              $month = date('F');
          
            $n = date('n');

            $d = date('d');

            $y = date('Y');
            
            $currentWeekNumber = date('W');
            $date=date("Y-m-d");

             
            
            
            
          $sqlb = "INSERT INTO semi_posts(id, product_id,items,sizes, quantity, avaliable,user_id, p_id, customer_name, sub_prices, post_id, date, date_added, month_added, c_year, c_date, months, wk_number) VALUES (Null,'$pro_id', '$pro_items', '$pro_size','$pro_qty','$pro_avaliable', '$user_id', '$ip',  '".$_SESSION['u_first']."','$s_price', '$tid', '$curdate', '$g','$month', '$y', '$d', '$n', '$currentWeekNumber')"; 
            
            if(mysqli_query($conn,$sqlb)){
       
                $sqlt = "INSERT INTO post_voters(id, items,user_id, sizes,quantity,product_id)VALUES (Null, '$pro_items','$user_id', '$pro_size','$pro_qty','$pro_id')";
        if(mysqli_query($conn,$sqlt)){
                
                $sql ="DELETE FROM `cart` WHERE user_id = '$ip'" ;
    if(mysqli_query($conn,$sql)){
        
            echo "<h2 class='text-success'> Successful</h2>"; 
        
    }else{
     $error = "<h2 class='text-danger'> Sorry! there is an error</h2>";
        
    }
                
                
                
    }
            
        }
    }
   
}

}
}
}


   


?>


<?php
include 'admin/includes/init.php';
   function sizesToArray($string){
    $sizesArray = explode(',',$string);
    $returnArray = array();
    foreach($sizesArray as $size){
        $s = explode(':',$size);
        $returnArray[] = array('size' => $s[0], 'quantity' => $s[1]);
        
    }
    return $returnArray;
}

function sizesToString($sizes){
   $sizeString = '';
    foreach($sizes as $size){
        $sizeString .= $size['size'].':'.$size['quantity'].',';
    }
    $trimmed = rtrim($sizeString, ',');
    return $trimmed;
    
}

$sqly = "SELECT * FROM post_voters ";
$featured = $db->query($sqly);

?>
<?php while($producs = mysqli_fetch_assoc($featured)) :?>
 <?php
$prod_id =$producs['product_id'];
$prod_title =$producs['items'];
$prod_size =$producs['sizes'];
$prod_quantity =$producs['quantity'];
$newSizes = array();
$productQ = $db->query("SELECT sizes FROM products WHERE id = '$prod_id'");
$product = mysqli_fetch_assoc($productQ);
$sizes = sizesToArray($product['sizes']);
foreach($sizes as $size){
   // echo $size['quantity'];
    if($size['size'] == $prod_size){
     $q = $size['quantity'] - $prod_quantity;
        $newSizes[] = array('size' => $size['size'],'quantity' => $q);
    }else{
     $newSizes[] = array('size' => $size['size'],'quantity' => $size['quantity']);   
    }
}

    
$sizeString = sizesToString($newSizes);
$urp_query = "UPDATE products SET sizes = '{$sizeString}' WHERE id = '{$prod_id}' AND title = '{$prod_title}'";
$fea = $db->query($urp_query);


 ?>  

<?php
session_start();
$users_id = $_SESSION["uid"];
 $sqlDel ="DELETE FROM `post_voters` WHERE user_id = '$users_id' " ;
if(mysqli_query($conn,$sqlDel)){
        
            echo "<h2 class='text-success'> gogo</h2>";
}
?>


 <?php endwhile; ?>  


  <span><?php echo $success;?></span>
         
               