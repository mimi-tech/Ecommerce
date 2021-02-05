


<?php
session_start();
require_once '../core/init.php';
$id = $_POST['id'];
$id = (int)$id;
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

  <?php ob_start(); ?>
  
  
  <div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
          <div class="modal-header">
              <button class="close" type="button" onclick="closeModal();window.location.reload();" data-dismiss="modal" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title text-center" id="title"><?php echo $product['title']; ?></h4>
             
              <div class="modal-body">
                  <div class="container-fluid">
                      <div class="row">
                         <span id="modal_errors" class="bg-danger"></span>
                          <span id="modal_success" class="bg-success"></span>
                          <div class="col-sm-6 fotorama">
                        
                           
                           <?php $photos = explode(',',$product['image']); 
                            foreach($photos as $photo):
                            ?>
                           
                            <img src="images/<?php echo $photo; ?>" alt="<?php echo $product['title']; ?>" class="details img-responsive">
                            <?php endforeach; ?>
                        
                          </div>
                          <div class="col-sm-6">
                              <h4>Details</h4>
                              <p><?php echo nl2br($product['description']); ?></p>
                              <hr>
                              <p>Price:#<?php echo $product['price']; ?></p>
                              <p>Brand: <?php echo $brand['brand']; ?></p>
                              <form action="add_cart.php" method="post" id="add_product_form">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                 <input type="hidden" name="avaliable" id="avaliable" value="">
                                
                                  <div class="form-group">
                                      <div class="col-xs-3">
                                          <label for="quantity">Quantity:</label>
                                          <input type="number" class="form-control" id="quantity" name="quantity" min="0"><br>
                                         
                                      </div>
                                      <div class="col-xs-9">&nbsp;</div>
                                       
                                  </div><br><br>
                                  <div class="form-group">
                                      <label for="size">Size</label>
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
                              </form>
                          </div>
                          
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-default " onclick="closeModal();window.location.reload();" data-dismiss="modal" >Close</button>
                  <button class="btn btn-warning" onclick="add_to_cart();return false;"><span class="glyphicon glyphicon-shopping-cart"></span>add to cart</button>
                 
              </div>
             </div>
          </div>
      </div>
  </div>
  
  <script>
      jQuery('#size').change(function(){
          var avaliable = jQuery('#size option:selected').data("avaliable");
          jQuery('#avaliable').val(avaliable);   
      });
      
      $(function () {
  $('.fotorama').fotorama({'loop':true,'autoplay':true});
});
      
 
</script>
  <?php echo ob_get_clean(); ?>