<?php
include "db.php";
 
$min_price=$_GET['min_price'];
$max_price=$_GET['max_price'];
 
//echo "Test min price".$min_price;
 
$query = "SELECT * FROM products WHERE featured = 1 AND  price BETWEEN '$min_price' AND '$max_price' ORDER BY price ASC";
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
                 
                <a href="product_details.php?details=<?php echo $product['id']; ?>" onclick="window.location.reload();">add</a>
                 
                
              </div>
              <?php echo $product['id'];?>
               <?php endwhile; ?>
               