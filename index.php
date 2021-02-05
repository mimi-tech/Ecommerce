


<?php
session_start();


if ( isset($_GET['success']) && $_GET['success'] == 1 )
{
     // treat the succes case ex:
     $errTyp = "success";   
     $errMSG = "You have been logged in successfully"; 
}

?>

<?php require_once 'connection/db.php'; ?>  
<?php require_once 'connection/connect.php'; ?>  
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>
  <p><br /></p>
  <p><br /></p>
  <p><br /></p>
<?php //include 'includes/left_bar.php';?>



 <?php
if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 3;
        $offset = ($pageno-1) * $no_of_records_per_page;

       

        $total_pages_sql = "SELECT COUNT(*) FROM products  WHERE featured = 1 AND deleted = 0";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


$sql = "SELECT * FROM products WHERE featured = 1 AND deleted = 0 ";
$featured = $db->query($sql);

?>
  
   
  

 <?php
                
                function sizesToArray($string){
    $sizesArray = explode(',',$string);
    $returnArray = array();
    foreach($sizesArray as $size){
        $s = explode(':',$size);
        $returnArray[] = array('size' => $s[0], 'quantity' => $s[1]);
        
    }
    return $returnArray;
}

function sizesToString($sizes){
   $sizeString = '';
    foreach($sizes as $size){
        $sizeString .= $size['size'].':'.$size['quantity'].',';
    }
    $trimmed = rtrim($sizeString, ',');
    return $trimmed;
    
}
        
        ?>
           

    <!-- Page Content -->
    <div class="container">
        <div class="row">
        	<br />
        	<h2 align="center">Advance Ajax Product Filters in PHP</h2>
        	<br />
            <div class="col-md-2 front-range">                				
				<div class="list-group">
					<h3>Price</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="500" />
                    <p id="price_show">700 - 65000</p>
                    <div id="price_range"></div>
                </div>				
                <div class="list-group">
					<h3>Brand</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                   $sql = "SELECT DISTINCT(brand_name) FROM products  WHERE featured = '1' AND deleted = 0 ORDER BY id DESC ";
$lowItems = array();
     
$query = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($query)){
    $item = array();
    $item = array(
                        'id' => $row['id'],
                         
                        'brand' => $row['brand_name']
                         
                        );
                        $lowItems[] = $item;
    
    
}
                    ?>
                    <?php foreach($lowItems as $item):?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector brand" value="<?php echo $item['brand']; ?>"  > <?php echo $item['brand']; ?></label>
                    </div>
                   <?php endforeach; ?>
                    </div>
                </div>

				<div class="list-group">
					<h3>Colors</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <?php

                    $queryc = "
                    SELECT DISTINCT(color) FROM products WHERE featured = '1' AND deleted = '0' ORDER BY color DESC
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
                        <label><input type="checkbox" class="common_selector ram" value="<?php echo $colors['color']; ?>" > <?php echo $colors['color']; ?> color</label>
                    </div>
                     <?php endforeach; ?>
                </div>
				</div>
				
            </div>

            <div class="col-md-10">
            <br />
            <div class="test">
            
             
              <?php while($product = mysqli_fetch_assoc($featured)) :?>
              
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
              <br /> <br />
				</div>
               <?php endwhile; ?>
              </div>
                
   
               
               
                <div class="row filter_data">

                </div>
                
                 
            </div>
        </div>

    </div>
    
   
    



  <?php //include 'includes/rightbar.php';?>      

 <center>
 <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
</center>

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
              <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
               
                <button type="button" class="btn btn-primary submitBtn pull-right" onclick="submitContactForm()">Update</button>
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
  
 