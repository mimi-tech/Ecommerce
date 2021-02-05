
<?php
									
include ('db.php');

$sql = "SELECT items, SUM(quantity) AS quantity FROM semi_posts GROUP BY items ORDER BY items ASC LIMIT 20";
$clientItems = array();
$nums = 0;
   $nums++;            
$query = mysqli_query($conn, $sql);

?>

<?php while($row = mysqli_fetch_array($query)):?>
      <?php  $pro_item = $row['items']; ?>
   
   <?php
    $sqlk = "SELECT * FROM products WHERE title = '$pro_item'";
    $kquery = mysqli_query($conn, $sqlk);
?>
   
   
    

                
 
                                
 <?php while($product = mysqli_fetch_array($kquery)) :?>
              
              <div class="col-sm-3">
                  <h4><?php echo $product['title']; ?></h4>
                  
                  <?php $photos = explode(',' ,$product['image']); ?>
                  <img src="images/<?= $photos[0]; ?> " alt="<?php echo $product['title']; ?>" class="img-responsive"/>
                  <p class="list-price text-danger">List Price<s><?= $product['list_price']; ?></s></p>
                  <P class="price">our price:<?= $product['price']; ?></P>
                  <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<? echo $product['id']; ?>)">Details</button>
                  <a href="tes.php?view=<?php echo $product['id']; ?>">view</a>
                 <a href="star-rating/index.php?review=<?php echo $product['id']; ?>"><img src="img/stars.jpg" height="15px" width="70px"></a>
                 
               
                 
                 
              </div>
              
               <?php endwhile; ?>
                                
 <?php endwhile; ?>
 
                           
                     