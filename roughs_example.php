

<?php

//fetch_data.php

include('db.php');

if(isset($_POST["action"]))
{
    $ram_filter = implode("','", $_POST["ram"]);
	$query = "
		SELECT * FROM products WHERE featured = '1' AND deleted = 0 AND color = '$ram_filter'
	ORDER BY id DESC LIMIT 3";
	
	
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
              </div>
               <a href="product_details.php?details=<?php echo $product['id']; ?>" onclick="window.location.reload();">add</a>
               <?php endwhile; ?>
               
              
             
            
          