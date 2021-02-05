<?php
session_start();
include "db.php";
require_once 'connection/connect.php';


 include 'helpers/helpers.php';
$min_price=$_GET['min_price'];
$max_price=$_GET['max_price'];
 
 $cat_id = $_SESSION['cat_id']; 
 $category = get_category($cat_id);
$query = "SELECT * FROM products WHERE categories = '$cat_id' AND  price BETWEEN '$min_price' AND '$max_price' ORDER BY price ASC";
$result = mysqli_query($conn, $query);
 
?>



              <?php while($products = mysqli_fetch_assoc($result)) :?>
              
              <div class="col-sm-3">
                 <div class="imgs">
                  
                  <?php $photos = explode(',' ,$products['image']); ?>
                  <img src="images/<?= $photos[0]; ?> " alt="<?php echo $products['title']; ?>" class="img-responsive"/>
                 <h4><?php echo $products['title']; ?></h4>
                  <P class="price">our price:<?= $products['price']; ?></P>
                  <a href="product_details.php?details=<?php echo $products['id']; ?>" role="button" class="btn btn-lg" id="adds"><span>Add To Cart</span></a>
                  <br /><br />
			<?php
if(isset($_SESSION["uid"]))
{
    $uids = $_SESSION["uid"];
$pid = $products['id'];
    $results = ("SELECT * FROM wish_list WHERE user_id = '$uids' AND w_p_id = '$pid'" );
    $run_query = mysqli_query($conn, $results);
    $count = mysqli_fetch_assoc($run_query);
    if($count > 1){
     echo " <a class='addtowishlist' href='javascript:;' data-data='$pid'><button class='btn btn-warning btn-sm'> Add wishlist <i class='fa fa-heart whishstate'></i></button></a>";   
    }else{
        echo " <a class='addtowishlist' href='javascript:;' data-data='$pid'><button class='btn btn-primary btn-sm'> Add wishlist <i class='fa fa-heart whishstate'></i></button></a>"; 
    }
}else{
    echo "<a class='addtowishlist' href='wishlist_login.php' data-data='$pid'><button class='btn btn-primary btn-sm'> Add wishlist <i class='fa fa-heart whishstate'></i></button></a> 
    ";  
}
?>
				 </div>
	<br>
              </div>
              
               <?php endwhile; ?>
               
              
             
            
           

<?php

//fetch_data.php

include('db.php');

if(isset($_POST["action"]))
{
    $ram_filter = implode("','", $_POST["ram"]);
	$query = "
		SELECT * FROM products WHERE featured = '1' AND deleted = 0 AND color = '$ram_filter' AND categories = '$cat_id'";
	
	
	$result = mysqli_query($conn, $query);
	//echo $output;
    
    
}

?>


 <?php while($products = mysqli_fetch_assoc($result)) :?>
              
              <div class="col-sm-3">
                 
                  <div class="imgs">
                  <?php $photos = explode(',' ,$products['image']); ?>
                  <img src="images/<?= $photos[0]; ?> " alt="<?php echo $products['title']; ?>" class="img-responsive"/>
                 <h4><?php echo $products['title']; ?></h4>
                  <P class="price">our price:<?= $products['price']; ?></P>
                  <a href="product_details.php?details=<?php echo $products['id']; ?>" role="button" class="btn btn-lg" id="adds"><span>Add To Cart</span></a>
                  <br /><br />
			<?php
if(isset($_SESSION["uid"]))
{
    $uids = $_SESSION["uid"];
$pid = $products['id'];
    $results = ("SELECT * FROM wish_list WHERE user_id = '$uids' AND w_p_id = '$pid'" );
    $run_query = mysqli_query($conn, $results);
    $count = mysqli_fetch_assoc($run_query);
    if($count > 1){
     echo " <a class='addtowishlist' href='javascript:;' data-data='$pid'><button class='btn btn-warning btn-sm'> Add wishlist <i class='fa fa-heart whishstate'></i></button></a>";   
    }else{
        echo " <a class='addtowishlist' href='javascript:;' data-data='$pid'><button class='btn btn-primary btn-sm'> Add wishlist <i class='fa fa-heart whishstate'></i></button></a>"; 
    }
}else{
    echo "<a class='addtowishlist' href='wishlist_login.php' data-data='$pid'><button class='btn btn-primary btn-sm'> Add wishlist <i class='fa fa-heart whishstate'></i></button></a> 
    ";  
}
?>
				 </div>
	<br>
              </div>
              
               <?php endwhile; ?>
               
              
             
            
          