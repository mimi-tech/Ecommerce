<?php
session_start();


?>

<?php require_once 'connection/db.php'; ?>  
<?php require_once 'connection/connect.php'; ?>  
<?php include 'includes/head.php';?>


<?php include 'includes/navigation.php';?>
<p><br /></p>
<p><br /></p>
<p><br /></p>
<div class="row">
    
    <div class="col-sm-12" id="arrival">
        
<center >
    
    <h1>New Arrivals</h1>
    <span><a href="front_user.php" style="color:whitesmoke;" id="newa">New Arrivals /</a>  <a class="pop-it" href="#pop">Popular Items /</a>  <a class="abt" href="#abts">About</a></span>
    
</center>

    </div>
</div>
<p><br /></p>
<p><br /></p>
<p><br /></p>
<hr>
 <div class="container">
<div class="row">


<div class="col-sm-2 front-range">
  
   
    <center id="p-range">
     
     <h2>Price Range
        </h2>
     </center>
      
	  <input type="text" id="amount_recent" class="p-filter"readonly />
	
	 
	<div id="recent-range"></div>
	
               	 
               
				<div class="list-group">
					<h3>Colors</h3>
                   
                    <?php

                    $queryc = "
                    SELECT DISTINCT(color) FROM products WHERE featured = '1' AND deleted = '0' ORDER BY id DESC LIMIT 3
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
                        <label><input type="checkbox" class="common_selector ram" value="<?php echo $colors['color']; ?>" > <?php echo $colors['color']; ?> </label>
                    </div>
                     <?php endforeach; ?>
                </div>
				
				
            </div>

    


 <?php
    $sqlr = "SELECT * FROM products WHERE featured = 1 AND deleted = 0 ORDER BY id DESC LIMIT 6";
    $rquery = mysqli_query($conn, $sqlr);
?>

<div class="front_content">
 
 
</div>

<div class="col-md-8">
<div class="test">
 <?php while($Rproduct = mysqli_fetch_array($rquery)) :?>
           
             <div class="col-sm-4" >
             
                 <div class="imgs">
                   
                
                  <?php $photos = explode(',' ,$Rproduct['image']); ?>
                
                  <img src="images/<?= $photos[0]; ?> " alt="<?php echo $Rproduct['title']; ?>" class="img-responsive " />
                  
                 
                   <h4><?php echo $Rproduct['title']; ?></h4>
                  <P class="price">#<?= $Rproduct['price']; ?></P>
                 
                   <a href="product_details.php?details=<?php echo $Rproduct['id']; ?>" role="button" class="btn btn-lg" id="adds"><span>Add To Cart</span></a>
                  <br /><br />
			<?php
if(isset($_SESSION["uid"]))
{
    $uids = $_SESSION["uid"];
$pid = $Rproduct['id'];
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
    <div class="col-sm-2"></div>
	</div>
</div>
         
          


      
           <div class="col-sm-12">
           <div class="col-sm-2"></div>
            <div class="col-sm-8 next">
        <center>
           
            <a role=" button">NEXT +</a>
        </center>
</div>
    </div>
  
   
    
         <section id="pop">
        <div class="row">
        <div class="col-sm-12 pop-items" style="display:none;">
         <center>
             
              <h1>Popular Items</h1>
         </center>
<div class="popular">	
  <?php

$sql = "SELECT items, SUM(quantity) AS quantity FROM semi_posts GROUP BY items ORDER BY items ASC LIMIT 20";
$clientItems = array();
$nums = 0;
   $nums++;            
$query = mysqli_query($conn, $sql);

?>

<?php while($row = mysqli_fetch_array($query)):?>
      <?php  $pro_item = $row['items']; ?>
   
   <?php
    $sqlk = "SELECT * FROM products WHERE title = '$pro_item' AND featured = 1 AND deleted = 0";
    $kquery = mysqli_query($conn, $sqlk);
?>
   
        
 <?php while($product = mysqli_fetch_array($kquery)) :?>
              
              <div class="col-sm-2">
                 <div class="imgs">
                  
                  
                  <?php $photos = explode(',' ,$product['image']); ?>
                  <img src="images/<?= $photos[0]; ?> " alt="<?php echo $product['title']; ?>" class="img-responsive"/>
                 <h4><?php echo $product['title']; ?></h4>
                  <P class="price">#<?= $product['price']; ?></P>
                 
                
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
    </div>     
             
           <?php endwhile; ?>
                
 <?php endwhile; ?>
            </div>
            </div>
</div>
</section>
<div class="col-sm-2"></div>
 
 <div class="col-sm-12 recommend">
     <center>
         
         <a href="front_end/check_recommend.php" role="button" class="btn btn-lg">
         <svg class="liquid-button"
     data-text="Your recommendation"
     data-force-factor="0.1"
     data-layer-1-viscosity="0.5"
     data-layer-2-viscosity="0.4"
     data-layer-1-mouse-force="400"
     data-layer-2-mouse-force="500"
     data-layer-1-force-limit="1"
     data-layer-2-force-limit="2"
     data-color1="#4DE7BF"
     data-color2="#ee4266"
     data-color3="#2A62F4"></svg></a>

         
         
          <?php
include 'includes/about.php';
include 'includes/footer.php';
?>
    
    <script>
         $(".next").click(function(){
  $(".pop-items").fadeIn(500);
  
$(".next").hide();
     
        });
         </script>
         
          <script>
         $(".pop-it").click(function(){
     jQuery('.pop-it').css("color","whitesmoke");
             jQuery('#newa').css("color","#212122");
  $(".pop-items").fadeIn(500);
  
$(".next").hide();
     
        });
         </script>
     </center>
     
 </div>
 
  
  