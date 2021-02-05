<?php


session_start();


require_once 'connection/db.php'; ?>
<?php require_once 'connection/connect.php'; ?>
<?php require_once 'config.php'; ?>
<?php include 'includes/head.php';?>

<?php include 'includes/navigation.php';
?>
<?php include 'helpers/helpers.php';?>
<p><br /></p>
<p><br /></p>

<?php


if(isset($_GET['details'])){
    $id = ($_GET['details']);
    $_SESSION["id"] = $id;
    $saved_image = '';
     $saved_simage = '';
}else{
    $id = '';
}

  
 
$sql = "SELECT * FROM products WHERE id = '$id'";
    $run_query = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
        
        $total_amt =0 ;
        while($row = mysqli_fetch_array($run_query)){
            $id = $row["id"];
            $pro_image = $row["image"];
            $pro_name = $row["title"];
             $pro_price = $row["price"];
             $pro_desc = $row["description"];
           $pro_brand = $row["brand_name"];
            $pro_color = $row["color"];
             $pro_sample_image = $row["sample_images"];
      $saved_image = (($row['image']!= '')?$row['image']:'');
    $saved_simage = (($row['sample_images']!= '')?$row['sample_images']:'');         
    }
}

?>



<?php
session_start();

$sql = "SELECT * FROM products WHERE id = '$id'";
$result = $db->Query($sql);
$product = mysqli_fetch_assoc($result);
$brand_id = $product['brand'];
$sql = "SELECT brand FROM brand WHERE id = '$brand_id'";
$brand_query = $db->Query($sql);
$brand = mysqli_fetch_assoc($brand_query);
$sizestring = $product['sizes'];
$sizestring = rtrim($sizestring,',');
$size_array = explode(',', $sizestring);
?>
<!--DETAILS MODAL -->




<?php
	
    if($id == $_SESSION['item_id']){
	$ratingDetails = "SELECT ratingNumber FROM item_rating WHERE itemId = '$id'";
	$rateResult = mysqli_query($conn, $ratingDetails) or die("database error:". mysqli_error($conn));
	$ratingNumber = 0;
	$count = 0;
	$fiveStarRating = 0;
	$fourStarRating = 0;
	$threeStarRating = 0;
	$twoStarRating = 0;
	$oneStarRating = 0;
	while($rate = mysqli_fetch_assoc($rateResult)) {
		$ratingNumber+= $rate['ratingNumber'];
		$count += 1;
		if($rate['ratingNumber'] == 5) {
			$fiveStarRating +=1;
		} else if($rate['ratingNumber'] == 4) {
			$fourStarRating +=1;
		} else if($rate['ratingNumber'] == 3) {
			$threeStarRating +=1;
		} else if($rate['ratingNumber'] == 2) {
			$twoStarRating +=1;
		} else if($rate['ratingNumber'] == 1) {
			$oneStarRating +=1;
		}
	}
    }else{
        $rateResult = '';
    }
	$average = 0;
	if($ratingNumber && $count) {
		$average = $ratingNumber/$count;
	}	
            
                     $limit = 2; 
	?>

<?php

$comsql = "SELECT id, parent_id, comment, sender, date FROM comment WHERE parent_id = '0' AND product_id = '".$_SESSION['id']."'";
$commentResult = mysqli_query($conn, $comsql);
 $count = mysqli_num_rows($commentResult);
?>



<?php ob_start(); ?>
<div class="container">

    <!-- MAIN CONTENT-->
    <div class="row">
        <div class="col-sm-2">
            <?php $photo = explode(',' ,$pro_image);?>
            <?php $photos = explode(',' ,$pro_sample_image);?>
            <img src="images/<?= $photo[0]; ?>" height="50px" width="50px" class="sample-image-zero"><br /> <br />
            <img src="uploads/<?= $photos[0]; ?>" height="50px" width="50px" class="sample-image-one"><br /> <br />

            <img src="uploads/<?= $photos[1]; ?>" height="50px" width="50px" class="sample-image-two"><br /> <br />

            <img src="uploads/<?= $photos[2]; ?>" height="50px" width="50px" class="sample-image-three">

        </div>


        <div class="col-sm-4">

            <h2 class="text-center">
                <?php echo $pro_name; ?>
            </h2>



            <div class="wm-zoom-container my-zoom-1 hide-image">

                <div class="wm-zoom-box">
                    <?php $photos = explode(',' ,$pro_image);?>

                    <img src="images/<?= $photos[0]; ?> " class="wm-zoom-default-img img-responsive" data-hight-src="images/<?= $photos[0]; ?> " data-loader-src="img/loader.gif" id="image1">

                </div>

            </div>
            <div class="show-image">

               

                    <?php $photos = explode(',' ,$pro_sample_image);?>

                    <img src="uploads/<?= $photos[0]; ?> " class="img-responsive show-sample-image-one" style="display:none;" id="image1">


                    <img src="uploads/<?= $photos[1]; ?> " class="img-responsive show-sample-image-two" style="display:none;" id="image1">


                    <img src="uploads/<?= $photos[2]; ?> " class=" img-responsive show-sample-image-three" style="display:none;" id="image1">

              
            </div>
        </div>


        <div class="col-sm-6 details-design">

            <?php
				$averageRating = round($average, 0);
				for ($i = 1; $i <= 5; $i++) {
					$ratingClass = "btn-default btn-grey";
					if($i <= $averageRating) {
						$ratingClass = "btn-warning";
                        
                        $_SESSION['rating'] = $ratingClass;
					}
				?>

            <button type="button" class="btn btn-sm <?php echo $ratingClass; ?>" aria-label="Left Align">
                <a class="glyphicon glyphicon-star" aria-hidden="true" href="#reviews" style="color:white;"></a>
            </button>

            <?php } ?>
            <a class="bold padding-bottom-7" href="#reviews">
                <?php printf('%.1f', $average); ?> <small> Reviews</small></a> &#124;
            <a href="#questions">
                <?php echo $count;?> answered question</a>




            <h4>Details</h4>
            <p>
                <?php echo nl2br($pro_desc); ?>
            </p>
            <hr>
            <span>Price:  #<?php echo $pro_price; ?>
            </span><br />
            <span>Brand:  <?php echo $pro_brand; ?>
            </span>
            <form action="add_cart.php" method="post" id="add_product_form">
                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                <input type="hidden" name="avaliable" id="avaliable" value="">

                <div class="form-group">
                    <div class="col-xs-3">
                        <h4>Quantity:</h4>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1"><br>

                    </div>
                    

                </div><br><br>
                
                <div class="form-group">
                  
                   
                    <select name="size" id="size" class="form-control">

                        <option value=""></option>
                        <?php foreach($size_array as $string){
                                         $string_array = explode(':', $string);
                                         $size = $string_array[0];
                                         $avaliable = $string_array[1];
                                            echo '<option value="'.$size.'" data-avaliable="'.$avaliable.'">'.$size.' inches ('.$avaliable.' Avaliable)</option>';
                                        }; ?>

                    </select>
					 
                </div>
                <!--<div class="cart-button">
                <button class="btn btn-warning" onclick="add_to_cart_product();return false;" data-toggle='modal' data-target='#myModal2'><span class="glyphicon glyphicon-shopping-cart"></span>add to cart</button>
				</div>-->
           
           <div class="cart-button">
           <button style="--content: 'add to cart!';" onclick="add_to_cart_product();return false;" data-toggle='modal' data-target='#myModal2'>
  <div class="left"></div>
			   add to cart
  <div class="right"></div>
</button>
				</div>
<svg style="width:2em;height:2em;position:fixed;top:1em;left:1em;opacity:.8;" viewBox="0 0 24 24"><path fill="#fff" d="M17.71,9.33C18.19,8.93 18.75,8.45 19,7.92C18.59,8.13 18.1,8.26 17.56,8.33C18.06,7.97 18.47,7.5 18.68,6.86C18.16,7.14 17.63,7.38 16.97,7.5C15.42,5.63 11.71,7.15 12.37,9.95C9.76,9.79 8.17,8.61 6.85,7.16C6.1,8.38 6.75,10.23 7.64,10.74C7.18,10.71 6.83,10.57 6.5,10.41C6.54,11.95 7.39,12.69 8.58,13.09C8.22,13.16 7.82,13.18 7.44,13.12C7.81,14.19 8.58,14.86 9.9,15C9,15.76 7.34,16.29 6,16.08C7.15,16.81 8.46,17.39 10.28,17.31C14.69,17.11 17.64,13.95 17.71,9.33M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2Z" /></svg>
           
           
            </form>
            <p>colors:
                <?php echo $pro_color; ?>
            </p>

            <?php

$sql = "SELECT * FROM products WHERE product_color = 0 AND deleted = 0 AND brand_name = '$pro_brand' AND title = '$pro_name'";
$product_color = $db->query($sql);        
?>

            <?php while($prod_color = mysqli_fetch_assoc($product_color)) :?>

            <div class="col-sm-3">

                <?php $photos = explode(',' ,$prod_color['image']); ?>


                <a href="product_details.php?details=<?php echo $prod_color['id']; ?>"><img src="images/<?= $photos[0]; ?> " alt="<?php echo $product['title']; ?>" height="30px" width="50px" /></a><br>
            </div>

            <?php endwhile; ?>




        </div>

    </div>

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
                                                    <input name="fName" class="form-control" value="<?php echo  $_SESSION[" u_first"]; ?>" id="inputName" required >

                                                </div>



                                            </div>

                                            <div class="col-sm-6 col-sm-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input name="lName" class="form-control" value="<?php echo  $_SESSION[" u_last"]; ?>" id="inputLame" required>

                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">
                                            <div class="col-sm-6 col-sm-6">

                                                <div class="form-group">
                                                    <label>Mobile</label>
                                                    <input name="phone" class="form-control" value="<?php echo  $_SESSION[" u_phone"]; ?>" id="inputPhone" required>

                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input name="email" type="email" class="form-control" value="<?php echo  $_SESSION[" u_email"]; ?>" id="inputEmail"required>
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




<div class="modal_cart">
    <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal();window.location.reload();"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Right Sidebar</h4>
                </div>

                <div class="modal-body">


                    <div id="modal_errors"></div>
                    <div id="modal_success"></div>

                    
                    
<h4>RECOMMENDATIONS</h4>


                    <?php
    $sqlc = "SELECT * FROM products WHERE featured = 1 AND deleted = 0 AND brand_name = '$pro_brand' ORDER BY RAND()
   LIMIT 10";
    $cquery = mysqli_query($conn, $sqlc);
?>

                    <?php while($Cproduct = mysqli_fetch_array($cquery)) :?>

                    <div class="col-sm-3">
                       
<a class="imgs" href="product_details.php?details=<?php echo $Cproduct['id']; ?>">
                        <?php $photos = explode(',' ,$Cproduct['image']); ?>
                        <img src="images/<?= $photos[0]; ?> " alt="<?php echo $Cproduct['title']; ?>" class="img-responsive" />
                          
                      
                  <br /><br />
			
				 </a>
	<br>
                    </div>
                    <?php endwhile;?>

                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->

    </div><!-- modal -->
</div>







<div class="row">

    <div class="col-sm-12">
       <hr />
        <h2>Sponsored products related to this item</h2>
        <?php

$sql = "SELECT * FROM products WHERE featured = 1 AND deleted = 0 AND brand_name = '$pro_brand' GROUP BY title ORDER BY title";
$featured = $db->query($sql);        
?>

        <?php while($product = mysqli_fetch_assoc($featured)) :?>

        <div class="col-sm-2">
            <div class="imgs">
            
            <?php $photos = explode(',' ,$product['image']); ?>
            <img src="images/<?= $photos[0]; ?> " alt="<?php echo $product['title']; ?>" class="img-responsive" />
            <h4>
                <?php echo $product['title']; ?>
            </h4>
            <P class="price">our price:
                <?= $product['price']; ?>
            </P>
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

<hr />
<div class="row">
    <div class="col-sm-12">


        <?php
		
$sql = "SELECT * FROM semi_posts WHERE brand_name = '$pro_brand' GROUP BY items ORDER BY items ASC LIMIT 20";
           
$query = mysqli_query($conn, $sql);
 
?>

        <?php while($row = mysqli_fetch_array($query)):?>
        <?php 
        $pro_id = $row['user_id'];
        
        ?>

        <?php
       $sqls = "SELECT * FROM semi_posts WHERE user_id = '$pro_id' AND brand_name = '$pro_brand' GROUP BY product_id ORDER BY items LIMIT 20";
    
    $squery = mysqli_query($conn, $sqls);
?>
        <?php while($row = mysqli_fetch_array($squery)):?>

        <?php
         $pro_item = $row['items'];
       

?>

        <?php
    $sqlk = "SELECT * FROM products WHERE title = '$pro_item' AND featured = 1 AND deleted = 0  GROUP BY title ORDER BY title";
   $popularItems = array();
     
$query = mysqli_query($conn, $sqlk);
$count = mysqli_num_rows($query);
while($row = mysqli_fetch_array($query)){
     
    $product = array();
    $product = array(
                        'title' => $row['title'],
                          'id' => $row['id'],
                        'price' => $row['price'],
                         'image' => $row['image']
                
                        );
                        $popularItems[] = $product;
    
}
        
?>





        <?php foreach($popularItems as $product): ?>
        <div class="col-sm-2">
            <div class="imgs">
                   
           
            <?php $photos = explode(',' ,$product['image']); ?>
            <img src="images/<?= $photos[0]; ?> " alt="<?php echo $product['title']; ?>" class="img-responsive" />
            <h4>
                <?php echo $product['title']; ?>
            </h4>

            <P class="price">our price:
                <?= $product['price']; ?>
            </P>


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

        <?php endforeach;?>


        <?php endwhile; ?>

        <?php endwhile; ?>
        <?php if($count > 0): ?>
        <h2 class="text-center">Customers who bought this item also bought</h2>
        <?php else: ?>

        <?php endif;?>

    </div>
</div>

<section id="reviews">
    <div class="row">

        <div class="col-sm-6">
            <div class="container">
                <h1>Reviews</h1>
                <?php
     session_start();


  
 
$sql = "SELECT * FROM products WHERE id = '$id'";
    $run_query = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
        
        $total_amt =0 ;
        while($row = mysqli_fetch_array($run_query)){
            
           
    $user_id = $_SESSION["uid"];
    $_SESSION['product_id'] = $row["id"];  
    $_SESSION['pro_name'] = $row["title"];  
    
        
    }
}

    $sql = "SELECT * FROM item_rating WHERE itemId = '$id'";
    $run_query = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
        
        $total_amt =0 ;
        while($row = mysqli_fetch_array($run_query)){
       
    $_SESSION['item_id'] = $row["itemId"];  
    
    
        
    }
}
?>


                <?php
	
    if($id == $_SESSION['item_id']){
	$ratingDetails = "SELECT ratingNumber FROM item_rating WHERE itemId = '$id'";
	$rateResult = mysqli_query($conn, $ratingDetails) or die("database error:". mysqli_error($conn));
	$ratingNumber = 0;
	$count = 0;
	$fiveStarRating = 0;
	$fourStarRating = 0;
	$threeStarRating = 0;
	$twoStarRating = 0;
	$oneStarRating = 0;
	while($rate = mysqli_fetch_assoc($rateResult)) {
		$ratingNumber+= $rate['ratingNumber'];
		$count += 1;
		if($rate['ratingNumber'] == 5) {
			$fiveStarRating +=1;
		} else if($rate['ratingNumber'] == 4) {
			$fourStarRating +=1;
		} else if($rate['ratingNumber'] == 3) {
			$threeStarRating +=1;
		} else if($rate['ratingNumber'] == 2) {
			$twoStarRating +=1;
		} else if($rate['ratingNumber'] == 1) {
			$oneStarRating +=1;
		}
	}
    }else{
        $rateResult = '';
    }
	$average = 0;
	if($ratingNumber && $count) {
		$average = $ratingNumber/$count;
	}	
            
                     $limit = 2; 
	?>
                <br>
                <div id="ratingDetails">

                    <div class="row">
                        <div class="col-sm-2">
                            <h4>Rating and Reviews</h4>
                            <h2 class="bold padding-bottom-7">
                                <?php printf('%.1f', $average); ?> <small> Reviews</small></h2>
                            <?php
				$averageRating = round($average, 0);
				for ($i = 1; $i <= 5; $i++) {
					$ratingClass = "btn-default btn-grey";
					if($i <= $averageRating) {
						$ratingClass = "btn-warning";
					}
				?>


                            <?php } ?>

                        </div>
                        <div class="col-sm-3">
                            <?php
				$fiveStarRatingPercent = round(($fiveStarRating/5)*100);
				$fiveStarRatingPercent = !empty($fiveStarRatingPercent)?$fiveStarRatingPercent.'%':'0%';	
				
				$fourStarRatingPercent = round(($fourStarRating/5)*100);
				$fourStarRatingPercent = !empty($fourStarRatingPercent)?$fourStarRatingPercent.'%':'0%';
				
				$threeStarRatingPercent = round(($threeStarRating/5)*100);
				$threeStarRatingPercent = !empty($threeStarRatingPercent)?$threeStarRatingPercent.'%':'0%';
				
				$twoStarRatingPercent = round(($twoStarRating/5)*100);
				$twoStarRatingPercent = !empty($twoStarRatingPercent)?$twoStarRatingPercent.'%':'0%';
				
				$oneStarRatingPercent = round(($oneStarRating/5)*100);
				$oneStarRatingPercent = !empty($oneStarRatingPercent)?$oneStarRatingPercent.'%':'0%';
				
				?>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fiveStarRatingPercent; ?>">
                                            <span class="sr-only">
                                                <?php echo $fiveStarRatingPercent; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">
                                    <?php echo $fiveStarRating; ?>
                                </div>
                            </div>

                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fourStarRatingPercent; ?>">
                                            <span class="sr-only">
                                                <?php echo $fourStarRatingPercent; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">
                                    <?php echo $fourStarRating; ?>
                                </div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $threeStarRatingPercent; ?>">
                                            <span class="sr-only">
                                                <?php echo $threeStarRatingPercent; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">
                                    <?php echo $threeStarRating; ?>
                                </div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $twoStarRatingPercent; ?>">
                                            <span class="sr-only">
                                                <?php echo $twoStarRatingPercent; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">
                                    <?php echo $twoStarRating; ?>
                                </div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $oneStarRatingPercent; ?>">
                                            <span class="sr-only">
                                                <?php echo $oneStarRatingPercent; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">
                                    <?php echo $oneStarRating; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" id="rateProduct" class="btn btn-default">Rate this product</button>
                        </div>
                    </div>


                    <h3 class="out-of" style="display:none;">showing
                        <?php echo $limit;?> out of
                        <?php echo $count;?>
                    </h3>
                   
                       
                         <button class="icon-btn add-btn" id="show-rating">
    <div class="add-icon"></div>
    <div class="btn-txt" >
                        <?php echo $count;?> Re</div>
  </button>
                       
                        <button class="icon-btn add-btn" id="show-all-rating">  
    <div class="btn-txt" >
                        <?php echo $count;?> Re</div>
  </button>
				          
				          
	
 
					          
                        
                    <div class="row">
                        <div class="col-sm-7">
                            <hr />
                            <div class="review-block " style="display:none;">


                                <?php
                    
                   if($id == $_SESSION['item_id']){
                     
                    
				$ratinguery = "SELECT ratingId, itemId, userId, ratingNumber, title, comments, created, modified FROM item_rating WHERE itemId = '$id'  ORDER BY ratingId ASC LIMIT $limit";
				$ratingResult = mysqli_query($conn, $ratinguery) or die("database error:". mysqli_error($conn));
				while($rating = mysqli_fetch_assoc($ratingResult)){
					$date=date_create($rating['created']);
					$reviewDate = date_format($date,"M d, Y");
                
                
				?>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="images/avater.png" class=" img-responsive">
                                        <div class="review-block-name">By <a href="#">
                                                <?php echo  $_SESSION['u_first'];?></a></div>
                                        <div class="review-block-date">
                                            <?php echo $reviewDate; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="review-block-rate">
                                            <?php
								for ($i = 1; $i <= 5; $i++) {
									$ratingClass = "btn-default btn-grey";
									if($i <= $rating['ratingNumber']) {
										$ratingClass = "btn-warning";
									}
								?>
                                            <button type="button" class="btn btn-xs <?php echo $ratingClass; ?>" aria-label="Left Align">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </button>
                                            <?php } ?>
                                        </div>
                                        <div class="review-block-title">
                                            <?php echo $rating['title']; ?>
                                        </div>
                                        <div class="review-block-description">
                                            <?php echo $rating['comments']; ?>
                                        </div>
                                    </div>
                                </div>

                                <hr />


                                <?php }
                   }else{
                       echo "No rating found";
                   }
                    ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="ratingSection" style="display:none;">
                    <div class="row">
                        <div class="col-sm-6">
                            <form id="ratingForm" method="POST">
                                <div class="form-group">
                                    <h4 >Rate this product</h4>
                                    <button type="button" class="btn btn-warning btn-sm rateButton" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <input type="hidden" class="form-control" id="rating" name="rating" value="1">
                                    <input type="hidden" class="form-control" id="itemId" name="itemId" value="12345678">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Title*</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $_SESSION['pro_name'] ;?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment*</label>
                                    <textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg" type="submit" id="saveReview">Save Review</button> <button type="button" class="btn btn-lg" id="cancelReview">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="rating-stars" style="display:none;">
                <?php
                    
                   if($id == $_SESSION['item_id']){
                     
                    
				$ratinguery = "SELECT ratingId, itemId, userId, ratingNumber, title, comments, created, modified FROM item_rating WHERE itemId = '$id'";
				$ratingResult = mysqli_query($conn, $ratinguery) or die("database error:". mysqli_error($conn));
				while($rating = mysqli_fetch_assoc($ratingResult)){
					$date=date_create($rating['created']);
					$reviewDate = date_format($date,"M d, Y");
                
                
				?>


                <div class="row">
                    <div class="col-sm-3">
                        <img src="images/avater.png" class=" img-responsive">
                        <div class="review-block-name">By <a href="#">
                                <?php echo  $_SESSION['u_first'];?></a></div>
                        <div class="review-block-date">
                            <?php echo $reviewDate; ?>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="review-block-rate">
                            <?php
								for ($i = 1; $i <= 5; $i++) {
									$ratingClass = "btn-default btn-grey";
									if($i <= $rating['ratingNumber']) {
										$ratingClass = "btn-warning";
									}
								?>
                            <button type="button" class="btn btn-xs <?php echo $ratingClass; ?>" aria-label="Left Align">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            </button>
                            <?php } ?>
                        </div>
                        <div class="review-block-title">
                            <?php echo $rating['title']; ?>
                        </div>
                        <div class="review-block-description">
                            <?php echo $rating['comments']; ?>
                        </div>
                    </div>
                </div>

                <hr />

                <?php }
                   }else{
                       echo "No rating found";
                   }
                    ?>
            </div>

        </div>


        <div class="col-sm-6">
            <h3>The Reality Show of buyers</h3>


            <?php

$sql = "SELECT * FROM products WHERE id = $id AND deleted = 0 AND brand_name = '$pro_brand' AND title = '$pro_name'";
$product_image = $db->query($sql);        
?>

            
                <?php while($prod_image = mysqli_fetch_assoc($product_image)) :?>

                

                    <?php if($saved_image != ''): ?>
                    <?php 
              
                $images = explode(',',$saved_image);
                ?>
                    <?php foreach($images as $image): ?>
                    <div class="col-sm-3">
                    <img src="images/<?= $image; ?> " class="img-responsive"> </div>

                    <?php endforeach;?>

                    <?php else: ?>

                    <?php endif;?>
               
                <?php endwhile; ?>
            </div>

       

    </div>
</section>



<?php
$_SESSION['class'] =  $ratingClass;
?>



<section id="questions">
    <div class="row">
        <div class="col-sm-6">
            <div class="container">
                <h2>Customer Question And Answer</h2>
                <br>
                <form method="POST" id="commentForm">
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control hidden" placeholder="Enter Name" value="<?php echo $name;?>" required />
                    </div>
                    <div class="form-group">
                        <textarea name="comment" id="comment" class="form-control" placeholder="Enter Comment" rows="5" required></textarea>
                    </div>
                    <span id="message"></span>
                    <br>
                    <div class="form-group">
                        <input type="hidden" name="commentId" id="commentId" value="0" />
                        <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Post Comment" />
                    </div>
                </form>
                <br>


            </div>

        </div>
    </div>
    <br>


    <div id="showComments" style="display:none";>
        <?php
session_start();
include_once("db.php");


$commentQuery = "SELECT id, parent_id, comment, sender, date FROM comment WHERE parent_id = '0' AND product_id = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1";
$commentsResult = mysqli_query($conn, $commentQuery) or die("database error:". mysqli_error($conn));
 $count = mysqli_num_rows($commentsResult);
              
$commentHTML = '';
while($comment = mysqli_fetch_assoc($commentsResult)){
	$commentHTML .= '
		<div class="panel panel-primary">
		<div class="panel-heading">By <b>'.$comment["sender"].'</b> on <i>'.$comment["date"].'</i></div>
		<div class="panel-body">'.$comment["comment"].'</div>
		<div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="'.$comment["id"].'">Reply</button></div>
		</div> ';
	$commentHTML .= getCommentReply($conn, $comment["id"]);
}
echo $commentHTML;

function getCommentReply($conn, $parentId = 0, $marginLeft = 0) {
	$commentHTML = '';
	$commentQuery = "SELECT id, parent_id, comment, sender, date FROM comment WHERE parent_id = '".$parentId."' AND product_id = '".$_SESSION['id']."'";	
	$commentsResult = mysqli_query($conn, $commentQuery);
	$commentsCount = mysqli_num_rows($commentsResult);
	if($parentId == 0) {
		$marginLeft = 0;
	} else {
		$marginLeft = $marginLeft + 48;
	}
	if($commentsCount > 0) {
		while($comment = mysqli_fetch_assoc($commentsResult)){  
			$commentHTML .= '
				<div class="panel panel-primary" style="margin-left:'.$marginLeft.'px">
				<div class="panel-heading">By <b>'.$comment["sender"].'</b> on <i>'.$comment["date"].'</i></div>
				<div class="panel-body">'.$comment["comment"].'</div>
				<div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="'.$comment["id"].'">Reply</button></div>
				</div>
				';
			$commentHTML .= getCommentReply($conn, $comment["id"], $marginLeft);
		}
	}
	return $commentHTML;
}
 
?>
    </div>

   
   
   
    
   
    <?php  if($count > 0){ ?>
    

    <div id="showComments" style="display:none;"></div>
    
      
       <button class="icon-btn add-btn show-all-questions">
    <div class="add-icon"></div>
    <div class="btn-txt">comment</div>
  </button>
  <button class="icon-btn add-btn close-questions" style="display:none;">  
    <div class="btn-txt">Remove</div>
  </button>
      
       
        <?php }else{
    echo "No questions and answer";
}
               
               ?>


        <p><br /></p>
        <p><br /></p>
        <p><br /></p>
        <?php echo ob_get_clean(); ?>
         
        <?php 
	include 'includes/about.php';
	include 'includes/footer.php';?>
        
       
     
     