<?php
session_start();
$user_id = $_SESSION["uid"];

?>
 <?php require_once 'connection/db.php'; ?> 
<?php require_once 'connection/connect.php'; ?> 

 
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>

<?php include 'helpers/helpers.php';?>

   
  <div class="container-fluid">
   
      <!-- MAIN CONTENT-->
      <div class="col-sm-8" >
        
         <div class="content"></div>
        <div class="row" id="images">
         <div class="test">
          
             
            
              <h2 class="text-center" style="margin-top:100px;">
              
     <?php echo $errMSG; ?>
                
         
                
              Recommended Products</h2>
<?php

$sql = ("SELECT * FROM semi_posts WHERE user_id = '$user_id'");
$featured = $db->query($sql);
?>
<?php while($product = mysqli_fetch_assoc($featured)):?>
  <?php $pro_item = $product['items'];
             $pro_id = $product['product_id'];
            
             ?> 
    
   <?php
$iQuery = ("SELECT * FROM products WHERE id = '$pro_id'");
        $p_r = $db->query($iQuery);
?>
               <?php while($producta = mysqli_fetch_assoc($p_r)):?>
                   
                   
                    
                   <?php $cat = get_category($producta['categories']);
                        
                        $category =  $cat['parent'] . '~' .$cat['child'];    
                       $pro_title = $producta['title'];
            
                    $pc = $cat['parent'];

                             ?>
                             
                    <?php $cQuery = ("SELECT * FROM categories WHERE category = '$pc'");
                         $p_t = $db->query($cQuery);
?>
                      <?php while($pro = mysqli_fetch_assoc($p_t)): ?>
                          <?php $category_id = $pro['id']; ?>
                           
                           <?php $pQuery = ("SELECT * FROM categories WHERE parent = '$category_id'");
                             $p_p = $db->query($pQuery);
?>
                      <?php while($pcategory = mysqli_fetch_assoc($p_p)):?>
                         <?php
                          // echo $pcategory['parent'];
                          // echo $pcategory['category'];
                          // echo $pcategory['id'];
                           $p_c = $pcategory['id'];
                           ?>
                           <?php
                           $sQuery = "SELECT * FROM products WHERE categories = '$p_c' AND id != '$pro_id' AND featured = 1 AND deleted = 0 ORDER BY RAND()";
                           $p_s = $db->query($sQuery);
?>
                      <?php while($scategory = mysqli_fetch_assoc($p_s)):?>
                          
                           <div class="col-sm-3">
                  <h4><?php echo $scategory['title']; ?></h4>
                  
                  <?php $photos = explode(',' ,$scategory['image']); ?>
                  <img src="images/<?= $photos[0]; ?> " alt="<?php echo $scategory['title']; ?>" class="img-responsive"/>
                  <p class="list-price text-danger">List Price<s><?= $scategory['list_price']; ?></s></p>
                  <P class="price">our price:<?= $scategory['price']; ?></P>
                  <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<? echo $scategory['id']; ?>)">Details</button>
                  <a href="tes.php?view=<?php echo $scategory['id']; ?>">view</a>
                 <a href="star-rating/index.php?review=<?php echo $scategory['id']; ?>"><img src="img/stars.jpg" height="15px" width="70px"></a>
                 
               
                 
                 
              </div>
                          
                      <?php endwhile;?>
                       <?php endwhile;?>
                           
                       <?php endwhile;?>
                       <?php endwhile;?>
                    
                    <?php endwhile;?>

 </div>
          </div>
      </div>
  <?php include 'includes/rightbar.php';?>      
  </div> 
 <?php include 'includes/footer.php';?>