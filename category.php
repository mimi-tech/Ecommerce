
 
 
 
 
<?php session_start();?>

<?php require_once 'connection/db.php'; ?> 
<?php require_once 'connection/connect.php'; ?>  
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?> 
<p><br /></p>
<p><br /></p>
<p><br /></p>   




<?php include 'helpers/helpers.php';?>
 <?php

if(isset($_GET['cat'])){
    $cat_id = ($_GET['cat']);
 $_SESSION['cat_id'] = $cat_id;
}else{
    $cat_id = '';
}
  


$sql = "SELECT * FROM products WHERE categories = '$cat_id' AND featured = 1 AND deleted = 0  ORDER BY RAND()";
$productQ = $db->query($sql);
$category = get_category($cat_id);
?>
  <div class="col-sm-2 front-range">
   <p>
	 <center id="p-range">
     
     <h2>Price Range
        </h2>
     </center>
	  <input type="text" id="amount_category" readonly class="p-filter" />
	</p>
	 
	<div id="price-range"></div>
	
	<div class="list-group">
					<h3>Colors</h3>
                    <?php

                    $queryc = "
                    SELECT DISTINCT(color) FROM products WHERE featured = '1' AND deleted = '0' AND categories = '$cat_id' ORDER BY color DESC
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
         
          <div class="content_category">
</div>
            
             <div class="test">
              <h2 class="text-center" style="margin-top:100px;"><?php echo $category['parent'].' '.$category['child'];?></h2>
              <?php while($product = mysqli_fetch_assoc($productQ)) :?>
              
              <div class="col-sm-4">
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
       <?php include 'includes/rightbar.php';?>
  </div> 
   
   
    
    
    
    
        <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="checkoutModalLabel">Shipping Address</h4>
                    </div>
                    <div class="modal-body">
                        <form action="index" method="post" id="payment_form">
                           <span class="bg-danger" id="payment_errors"></span>
                            <div id="step1" style="display:block;">
                               
                                
                                 <div class="row">
                
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel">
                        <div class="panel-heading">
                            PERSONAL INFORMATION
                        </div>
                       
                        <div class="panel-body">
                            <div class="row">
                               <div class="statusMsg"></div>
                                <div id="update_errors"></div>   
                                    <div class="col-sm-6 col-sm-6">
							  <div class="form-group">
                                            <label>First Name</label>
                                            <input name="fName" class="form-control" value="<?php echo  $_SESSION["u_first"]; ?>" id="inputName" required >
                                            
                               </div>
                                   
                                  
                                   
                                    </div>
                                    
                                     <div class="col-sm-6 col-sm-6">
							  <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="lName" class="form-control" value="<?php echo  $_SESSION["u_last"]; ?>" id="inputLame" required>
                                            
                               </div>
                                    </div>
                                    
                                </div>
                                
                                
                                 <div class="row">
                                <div class="col-sm-6 col-sm-6">
                                
							   <div class="form-group">
                                            <label>Mobile</label>
                                            <input name="phone" class="form-control" value="<?php echo  $_SESSION["u_phone"]; ?>" id="inputPhone" required>
                                            
                               </div>
                                     </div>
                                     
                                     <div class="col-sm-6 col-md-6">
							   <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="email" class="form-control" value="<?php echo  $_SESSION["u_email"]; ?>" id="inputEmail"required>
                                         </div>
                               </div>
                                </div>
                                
                                 <div class="row">
                                <div class="col-sm-12">
                                
							   <div class="form-group">
                                            <label>Shipping Address</label>
                                   <textarea class="form-control" name="address" id="inputAddress"><?php echo  $_SESSION["u_address"];?></textarea>
                                            
                               </div>
                                     </div>
                                     
                                     
                                </div>
                                
                                 <div class="form-group"> 
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               
                <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">Update</button>
                    </div>
                                
                        </div>  
                        </div>
                        </div>
                        </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>

 
    
    
    
  <?php
include 'includes/about.php';
include 'includes/footer.php';
?>