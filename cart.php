<?php  
session_start();  
if(!isset($_SESSION["uid"]))
{
 header("location:/chilee/front_end/login.php");
}
?> 



<?php
session_start();


if ( isset($_GET['success']) && $_GET['success'] == 1 )
{
     // treat the succes case ex:
     $errTyp = "success";   
      $errMSG = " Successfull Registered, please verify your email for complete registration";
}

?>


<?php
session_start();
require_once 'connection/db.php'; ?>
<?php require_once 'connection/connect.php'; ?>
<?php require_once 'config.php'; ?>
<?php include 'includes/head.php';?>
<?php //include 'includes/header.php';?>
<?php include 'includes/navigation.php';?>




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
if(isset($_GET['delete'])){
    $id = $citem['id'];
    $id = ($_GET['delete']);
    $db->query("DELETE FROM cart WHERE id = '$id'");
    //header("Location: cart.php");
    $result_delete = "Deleted Successfully";
}                
?>


<?php
if(isset($_GET['ups'])){
    $cid = $citem['id'];
    $cid = ($_GET['ups']);
    $db->query("UPDATE cart SET quantity = (quantity + 1)
      WHERE id='$cid'");
    //header("Location: cart.php");
    $result_delete = "updated Successfully";
}                
?>


<?php
if(isset($_GET['minus'])){
    $mid = $citem['id'];
    $mid = ($_GET['minus']);
    $db->query("UPDATE cart SET quantity = (quantity - 1)
      WHERE id='$mid'");
    //header("Location: cart.php");
    $result_delete = "updated Successfully";
}                
?>





<?php
      
session_start();
    $user_id = $ips;
$whereIn = implode(',' , $_SESSION['cart']);

    $_SESSION['avaliable'] = $_POST['avaliable'];            
    $sql = "SELECT * FROM cart WHERE  product_id IN ($whereIn) AND user_id = '$user_id'";
    $ClintItems = array();
    $run_query = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
        $item_count= 0;
        $total_amt =0 ;
        $st = 0;
        $num = 0;
        $num++;
        while($row = mysqli_fetch_array($run_query)){
            
            $citem = array();
            $citem = array(
                
                'id' => $row["id"],
            'pid' => $row["product_id"],
            'pro_name' => $row["items"],
            'pro_image' => $row["product_image"],
            'qty' => $row["quantity"],
            'pro_price' => $row["price"],
            'pro_size' => $row["size"],
            'pro_avaliable' => $row["avaliable"]
                       
                        );
                        $ClintItems[] = $citem;
    
            
            
        }
    }
            
?>



 <?php if ($count > 0):?>
 <div class="col-sm-2"></div>
<div class="col-sm-8" id="test">
    <div class="row">
      
        <h2 class="text-center">My Shopping Cart</h2>
       
        
        <h3 id="remove_success"></h3>
        <div id="save_feedback"> </div>
        
<p><br /></p>
       <p><br /></p>
       
        <table class="table table-bordered table-condensed table-stripe" >
            <thead>
               <tr>
                <th>S/N</th>
                <th>Statues</th>
                <th>Images</th>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Size</th>
                <th>Sub Total </th>
                
                </tr>
            </thead>
            <tbody>

            

             <?php foreach($ClintItems as $citem): ?>
             <tr>
                <td><?php echo $num++ ;?></td>
                
             
                <td><a class="delete_employee" data-emp-id="<?php echo $citem["id"]; ?>" href="javascript:void(0)">
<i class="glyphicon glyphicon-trash"></i>
</a></td>
                
                
                <?php $photos = explode(',' ,$citem['pro_image']); ?>
                <td><img src="images/<?= $photos[0]; ?> " alt="<?php echo $citem['pro_image']; ?>" /></td>
                 <td> <?php echo $citem['pro_name']; ?></td>
             <td> <?php echo $citem['pro_price']; ?></td>
                              
             <td >
              <a  href="cart.php?minus=<?php echo $citem['id']; ?>" class="btn btn-xs btn-default">-</a> 
           
                 
                <span> <?php echo $citem['qty'];?></span>
             <?php
            if($citem['qty'] < $citem['pro_avaliable']):
            ?>
             
               
                 
                  <a  href="cart.php?ups=<?php echo $citem['id']; ?>" class="btn btn-xs btn-default">+ </a> 
           
                 
                 
                 
                 
             <?php else: ?>
             <span class="text-danger">Max</span>
             <?php endif;?>
                 </td>
                
             <td> <?php echo $citem['pro_size']; ?></td>
             <?php
            $total = $citem['pro_price'] *  $citem['qty']; 
                 
            ?>
                 <td><?php echo $total; ?></td>
             </tr>
<?php endforeach;?>
            </tbody>
      
       
          

 <?php
         
                
session_start();
    $user_id = $ips;
    $_SESSION['avaliable'] = $_POST['avaliable'];            
    //$sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $sql = "SELECT * FROM cart WHERE  product_id IN ($whereIn) AND user_id = '$user_id'";
    $run_query = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
        $item_count= 0;
        $total_amt =0 ;
        $st = 0;
        while($row = mysqli_fetch_array($run_query)){
           
            $qty = $row["quantity"];
            $pro_price = $row["price"];
           
            $totals = $row["price"] *  $row["quantity"];
            $price_array = array($totals);
            $total_sum = array_sum($price_array);
            $total_amt = $total_amt + $total_sum;
            
            $subPrice_array = array($pro_price);
            $subPrice_total = array_sum($subPrice_array);
            $st = $st + $subPrice_total;
            
            $It_array = array($qty);
            $It_total = array_sum($It_array);
            $item_count = $item_count + $It_total;
        }
        
    }
            
?>
        
        

        </table>
         <button class="btn btn-lg delete_all"><i class="glyphicon glyphicon-trash"></i>  Delete cart</button>
	</div>
</div>
      
      
      
       <div class="col-sm-3"></div>
        <div class="col-sm-4" id="couponcode">           
        <h2>
            
            DISCOUNT/PROMO CODE
            <P>Don't have any yet? <a>check our discount program</a></P>
             <?php echo $loginError; ?>
             
        </h2>
        <span id="code_button"><?php echo $success; ?></span>
         
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  method="post" autocomplete="off">
         <div class="display-error" style="display: none">
    </div>
        
        <input type="text" class="form-control hidden" 
        id="amt" value="<?php echo $total_amt;?>">
        
        <div class="input-group " >
        <input type="text" class="form-control" placeholder="enter coupon code"
        id="name">
       
        <div class="input-group-btn">
        <button type="submit" id="submit" class="btn btn-theme" >Submit</button>
			
			</div>
			</div>
        </form>
    
    
</div>
    
                                    
       
       <div class="col-sm-4" id="checkout-table">
        <table class="table table-bordered table-condensed">
            
            
              
                <tr>
                 <th>Total items</th>
                    <th>
                        <?php echo $item_count; ?>
                    </th>
			</tr>
                   <tr>
                   <th>Sub total</th>
                    <th>
                        <?php echo $st; ?>
                    </th>
			</tr>
                   <tr>
                   <th>Grand Total</th>
                    <th class="Gsuccess" id="codes">
                        #<?php echo $total_amt; ?>
                    </th>
                   
                  
                </tr>
                <tr>
                	
                	 <th style="display: none" class="code-success">
                     Your 10 percent discount
					</th>
						<th class="display-success" style="display: none">
						
						
                    </th>
                </tr>
                
                
               
        </table>
        
       

        
       

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-lg pull-right" data-toggle="modal" data-target="#updateModal" id="checkbutton">
            <span class="glyphicon glyphicon-shopping-cart"></span> Check Out >>
        </button>
</div>
        <!-- Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="updateModalLabel">Shipping Address</h4>
                    </div>
                    <div class="modal-body">
                        <form action="transaction.php" method="post" id="payment_form">
                           
                            <div id="step" style="display:block;">
                               
                                
                                 <div class="row">
                
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel">
                        <div class="panel-heading">
                            PERSONAL INFORMATION
                        </div>
                       
                        <div class="panel-body">
                       <div class="row">
                               <div class="statusMsg"></div>
                                <div id="update_error"></div>   
                                    <div class="col-sm-6 col-sm-6">
							  <div class="form-group">
                                            <label>First Name</label>
                                            <input name="fName" class="form-control" value="<?php echo  $_SESSION["u_first"]; ?>" id="inputNames" required >
                                            
                               </div>
                                   
                                  
                                   
                                    </div>
                                    
                                     <div class="col-sm-6 col-sm-6">
							  <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="lName" class="form-control" value="<?php echo  $_SESSION["u_last"]; ?>" id="inputLames" required>
                                            
                               </div>
                                    </div>
                                    
                                </div>
                                
                                
                                 <div class="row">
                                <div class="col-sm-6 col-sm-6">
                                
							   <div class="form-group">
                                            <label>Mobile</label>
                                            <input name="phone" class="form-control" value="<?php echo  $_SESSION["u_phone"]; ?>" id="inputPhones" required>
                                            
                               </div>
                                     </div>
                                     
                                     <div class="col-sm-6 col-md-6">
							   <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="email" class="form-control" value="<?php echo  $_SESSION["u_email"]; ?>" id="inputEmails"required>
                                         </div>
                               </div>
                                </div>
                                
                                 <div class="row">
                                <div class="col-sm-12">
                                
							   <div class="form-group">
                                            <label>Shipping Address</label>
                                   <textarea class="form-control" name="address" id="inputAddresss"><?php echo  $_SESSION["u_address"];?></textarea>
                                            
                               </div>
                                     </div>
                                     
                                     
                                </div>
                                
                                
                                
                                <?php 
session_start();
include 'db.php';


       
         
     $user_id = $ips;           
   // $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $sql = "SELECT * FROM cart WHERE  product_id IN ($whereIn) AND user_id = '$user_id'";                        
    $run_query = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
        $item_count= 0;
        $total_amt =0 ;
        $st = 0;
        while($row = mysqli_fetch_array($run_query)){
            $id = $row["id"];
           $_SESSION['pid'] = $row["product_id"];
           $_SESSION['pro_name'] = $row["items"];
            $_SESSION['image'] = $row["image"];
            $_SESSION['qty'] = $row["quantity"];
            $pro_price = $row["price"];
             $_SESSION['pro_prices'] = $row["price"];
            $_SESSION['pro_size'] = $row["size"];
            $_SESSION['pro_avaliable'] = $row["avaliable"];
            $total = $row["price"] *  $row["quantity"];
            $price_array = array($total);
            $total_sum = array_sum($price_array);
            $total_amt = $total_amt + $total_sum;
            
            $subPrice_array = array($pro_price);
            $subPrice_total = array_sum($subPrice_array);
            $st = $st + $subPrice_total;
            
            $It_array = array( $_SESSION['qty']);
            $It_total = array_sum($It_array);
            $item_count = $item_count + $It_total;
            
            
            
            echo "
                           
								
 <input name='items[]' type ='text' class='form-control hidden' value='".$_SESSION['pro_name']."' readonly required>
 <input name='qty[]' type ='text' class='form-control hidden' value='".$_SESSION['qty']."' readonly required>
 <input name='avaliable[]' type ='text' class='form-control hidden' value='".$_SESSION['pro_avaliable']."' readonly required>
  <input name='product[]' type ='text' class='form-control hidden' value='".$_SESSION['pid']."' readonly required> 
                                   
<input name='sizes[]' type ='text' class='form-control hidden' value='".$_SESSION['pro_size']."' readonly required>
 <input name='item_count' type ='text' class='form-control hidden' value='$item_count' readonly required>
   <input name='sub_total' type ='text' class='form-control hidden' value=' $st' readonly required>
   <input name='total_amt' type ='text' class='form-control hidden' value=' $total_amt' readonly required>
    <input name='price' type ='text' class='form-control hidden' value=' $pro_price' readonly required>
    
     ";
   
        }
    }

                        ?>        
                           
  
                            </div>
                        </div>
                    </div>
                            </div>
                            
                            
                            
                            </div>
                            <div id="step_2" style="display:none">
                                <div class="form-group col-sm-3">
                                    <label for="name">Name on Card:</label>
                                    <input type="text" id="name" class="form-control">
                                </div>
                                 <div class="form-group col-sm-3">
                                    <label for="number">Card Number:</label>
                                    <input type="number" id="number" class="form-control">
                                </div>
                                
                                 <div class="form-group col-sm-2">
                                    <label for="cvc">CVC:</label>
                                    <input type="number" id="cvc" class="form-control">
                                </div> 
                                
                                 <div class="form-group col-sm-2">
                                    <label for="name">Expired Month:</label>
                                     <select id=exp-month class="form-control">
                                         <option value=""></option>
                                             <?php for($i=1;$i < 13; $i++): ?>
                                             <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                                             <?php endfor; ?>
                                         
                                     </select>
                                </div>
                                
                                 <div class="form-group col-sm-2">
                                    <label for="exp-year">Expired Year:</label>
                                   <select id="exp-year" class="form-control">
                                       <option value=""></option>
                                       <?php $yr = date("Y");?>
                                       <?php for($i=0;$i<11; $i++):?>
                                       <option value="<?php echo $yr+$i; ?>"><?php echo $yr+$i; ?></option>
                                       <?php endfor; ?>
                                   </select>
                                </div>
                                
                            </div><br>
                     <div class="modal-footer"><br>
                        <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                         <button type="button" class="btn btn-primary submitBtn" id="update_button" onclick="submitUpdateForm()">Update</button>
                         <button type="button" class="btn btn-default" id="bak_button" style="display:none;" onclick="bak_button()"> back </button>
                        <button type="button" class="btn btn-default" id="next_button" onclick="check_address()"> next >></button>
                       
                         <button type="submit" class="btn btn-primary" id="checkout_button" name="submit" style="display:none;">check out >></button>
                         
                    </div>      
                    
                         
                    </form>
                    
                    
                    
                    
                    </div>
                    
                </div>
            </div>
        
</div>
<?php else:?>
    <h2 style="margin-top:50px;">Your shopping cart is empty</h2>
    <?php endif;?>




<?php

 include 'includes/footer.php';  
?>



   


     