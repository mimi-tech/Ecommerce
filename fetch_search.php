<?php
session_start();
include "db.php";
 
$min_price=$_GET['min_price'];
$max_price=$_GET['max_price'];
 
 
 $query="SELECT * FROM products WHERE description LIKE '%".$_SESSION['search']."%' AND featured = 1 AND deleted = 0 AND price BETWEEN '$min_price' AND '$max_price' ORDER BY price ASC"; 

$result = mysqli_query($conn, $query);
 
?>


<?php while($product = mysqli_fetch_array($result)) :?>
              
              <div class="col-sm-3">
                  <h4><?php echo $product['title']; ?></h4>
                  
                  <?php $photos = explode(',' ,$product['image']); ?>
                  <img src="/chilee/images/<?= $photos[0]; ?> " alt="<?php echo $product['title']; ?>" class="img-responsive"/>
                  <p class="list-price text-danger">List Price<s><?= $product['list_price']; ?></s></p>
                  <P class="price">our price:<?= $product['price']; ?></P>
                  <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<? echo $product['id']; ?>)">Details</button>
                  <a href="tes.php?view=<?php echo $product['id']; ?>">view</a>
                 <a href="star-rating/index.php?review=<?php echo $product['id']; ?>"><img src="img/stars.jpg" height="15px" width="70px"></a>
                 
               
                 
                
              </div>
              
               <?php endwhile; ?>
               
              
             

<?php

//fetch_data.php

include('db.php');

if(isset($_POST["action"]))
{
    $ram_filter = implode("','", $_POST["ram"]);
	$query = "
		SELECT * FROM products WHERE featured = '1' AND deleted = 0  AND color = '$ram_filter' AND description LIKE '%".$_SESSION['search']."%'";
	
	
	$result = mysqli_query($conn, $query);
	//echo $output;
    
    
}

?>


 <?php while($products = mysqli_fetch_assoc($result)) :?>
              
              <div class="col-sm-3">
                  <h4><?php echo $products['title']; ?></h4>
                  <?php $photos = explode(',' ,$products['image']); ?>
                  <img src="images/<?= $photos[0]; ?> " alt="<?php echo $products['title']; ?>" class="img-responsive"/>
                  <p class="list-price text-danger">List Price<s><?= $products['list_price']; ?></s></p>
                  <P class="price">our price:<?= $products['price']; ?></P>
                  <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<? echo $products['id']; ?>)">Details</button>
                  <a href="star-rating/index.php?review=<?php echo $products['id']; ?>">Review</a>
                   <a href="product_details.php?details=<?php echo $product['id']; ?>" onclick="window.location.reload();">add</a>
              </div>
              
               <?php endwhile; ?>
               
              
             
            
          