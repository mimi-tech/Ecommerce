
<?php session_start();?>

<?php require_once 'connection/db.php'; ?> 
<?php require_once 'connection/connect.php'; ?>  
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>    

<?php include 'helpers/helpers.php';?>


 <?php
if(!isset($_POST['search'])){
    header("Location: index.php");
}
 
          $_SESSION['search'] = $_POST['search'];  
           $sql="SELECT * FROM products WHERE title LIKE '%".$_SESSION['search']."%' OR description LIKE '%".$_SESSION['search']."%' AND featured = 1 AND deleted = 0";

        $productQ = $db->query($sql);
$category = get_category($cat_id);
$count = mysqli_num_rows($productQ);
    if($count > 0){
     //$search_rs = mysqli_fetch_assoc($search_query);   
    }

       

?>

  <p><br /></p>
  <p><br /></p>
<div class="col-sm-2 front-range">
   <center id="p-range">
     
     <h2>Price Range
        </h2>
     </center>
	  <input type="text" id="amount_search"class="p-filter" readonly />
	
	 
	<div id="search-range"></div>
	
	
	 <div class="list-group">
					<h3>Colors</h3>
                    <?php

                    $queryc = "
                    SELECT DISTINCT(color) FROM products WHERE featured = '1' AND deleted = '0' AND description LIKE '%".$_SESSION['search']."%' ORDER BY color DESC
                    ";
                    $colorItems = array();
     
$queryc = mysqli_query($conn, $queryc);
while($row = mysqli_fetch_array($queryc)){
    $colors = array();
    $colors = array(
                        'id' => $row['id'],
                         
                        'color' => $row['color']
                         
                        );
                        $colorItems[] = $colors;
    
    
}
                    ?>
                    <?php foreach($colorItems as $colors):?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ram" value="<?php echo $colors['color']; ?>" > <?php echo $colors['color']; ?> GB</label>
                       
                    </div>
                     <?php endforeach; ?>
                </div>
</div>

   
  <div class="container-fluid">
   
      <!-- MAIN CONTENT-->
      <div class="col-sm-8" >
         <div class="content_search"></div>
          <div class="row" id="images">
              <div class="test">
             <?php if($count > 0): ?>
              <h2 class="text-center" style="margin-top:100px;"><?php echo $category['parent'].''.$category['child'];?></h2>
              <?php else: ?>
              <h2 class="text-center">No item found</h2>
              <?php endif;?>
              <?php while($product = mysqli_fetch_assoc($productQ)) :?>
              
              <div class="col-sm-3">
                   <div class="imgs">
                 
                   <?php $photos = explode(',' ,$product['image']); ?>
                  <img src="images/<?= $photos[0]; ?> " alt="<?php echo $product['title']; ?>" class="img-responsive"/>
                   <h4><?php echo $product['title']; ?></h4>
                  <P class="price">our price:<?= $product['price']; ?></P>
                  <a href="product_details.php?details=<?php echo $product['id']; ?>" role="button" class="btn btn-lg" id="adds"><span>Add To Cart</span></a>
                  <br /><br />
			<?php
if(isset($_SESSION["uid"]))
{
    $uids = $_SESSION["uid"];
$pid = $product['id'];
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
              </div>
          </div>
      </div>
       <?php include 'includes/rightbar.php';?>
  </div> 
  
 
  
  <?php
include 'includes/about.php';
include 'includes/footer.php';
?>
  
  