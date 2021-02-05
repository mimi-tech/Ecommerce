
<?php require_once 'connection/db.php'; ?>  
<?php require_once 'connection/connect.php'; ?>  
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>
  <p><br /></p>
  <p><br /></p>
  <p><br /></p>
  
  
  
  
  <?php
									


$sql = "SELECT * FROM wish_list WHERE user_id = 22";
          
$query = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($query)):
    $u = $row['w_p_id'];

    $sqlk = "SELECT * FROM products WHERE id = '$u' AND featured = 1 AND deleted = 0";
    $kquery = mysqli_query($conn, $sqlk);

   ?>
   <div class="row">
   <div class="col-sm-2"></div>
    <div class="col-md-8">
            <br />
           
              <?php while($product = mysqli_fetch_assoc($kquery)) :?>
              
              <div class="col-sm-3">
                  <h4><?php echo $product['title']; ?></h4>
                   <?php $photos = explode(',' ,$product['image']); ?>
                  <img src="images/<?= $photos[0]; ?> " alt="<?php echo $product['title']; ?>" class="img-responsive"/>
                  <p class="list-price text-danger">List Price<s><?= $product['list_price']; ?></s></p>
                  <P class="price">our price:<?= $product['price']; ?></P>
                  
                  <a href="product_details.php?details=<?php echo $product['id']; ?>">add</a>
                  <a class='addtowishlist' href='javascript:;' data-data='<?php echo $product['id']; ?>' style="color: red"><i class='fa fa-heart whishstate'></i></a>
              </div>
              
               <?php endwhile; ?>
               <?php endwhile; ?>
              </div>
</div>
   
 <?php include 'includes/footer.php';?>