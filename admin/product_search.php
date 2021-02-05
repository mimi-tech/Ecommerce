<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:login.php");
}
?> 
<?php

require_once '../core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';

//delete products
if(isset($_GET['delete'])){
    $id = sanitize($_GET['delete']);
    $db->query("UPDATE products SET deleted = 1 WHERE id = '$id'");
    header("Location: products.php");
}

$dbpath = '';
if(isset($_GET['add']) || isset($_GET['edit'])){ 
  $brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
    $parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
    $title = ((isset($_POST['title']) && $_POST['title']!= '')?sanitize($_POST['title']):'');
    $brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
     $parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
     $category = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):'');
    $price = ((isset($_POST['price']) && $_POST['price']!= '')?sanitize($_POST['price']):'');  
    $list_price = ((isset($_POST['list_price']) && $_POST['list_price']!= '')?sanitize($_POST['list_price']):'');  
    $description = ((isset($_POST['description']) && $_POST['description']!= '')?sanitize($_POST['description']):'');
   
    $sizes = ((isset($_POST['sizes']) && $_POST['sizes']!= '')?sanitize($_POST['sizes']):''); 
    $sizes = trim($sizes,',');
    $saved_image = ''; 
    
    if(isset($_GET['edit'])){
        $edit_id = (int)$_GET['edit'];
        $productresults = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
        $product = mysqli_fetch_assoc($productresults);
        if(isset($_GET['delete_image'])){
            $imgi = (int)$_GET['imgi'] - 1;
            $images = explode(',',$product['image']);
        $image_url = '../core/init.php'.$images[$imgi];echo $image_url;
            
              
        unlink($image_url);
            unset($images[$imgi]);
            $imageString = implode(',',$images);
        $db->query("UPDATE products SET image = '($imageString)' WHERE id = '$edit_id'");
            header("Location: products.php?edit='.$edit_id");
        }
$category = ((isset($_POST['child']) && $_POST['child'] !='')?sanitize($_POST['child']):$product['categories']);
    
$title = ((isset($_POST['title']) && $_POST['title']!= '')?sanitize($_POST['title']):$product['title']);
 $brand = ((isset($_POST['brand']) && $_POST['brand']!= '')?sanitize($_POST['brand']):$product['brand']);
$parentQ = $db->query("SELECT * FROM categories WHERE id = '$category'");
$parentResult = mysqli_fetch_assoc($parentQ);
$parent = ((isset($_POST['parent']) && $_POST['parent']!= '')?sanitize($_POST['parent']):$parentResult['parent']); 
    
$price = ((isset($_POST['price']) && $_POST['price']!= '')?sanitize($_POST['price']):$product['price']);   
$list_price = ((isset($_POST['list_price']))?sanitize($_POST['list_price']):$product['list_price']); 
$description = ((isset($_POST['description']))?sanitize($_POST['description']):$product['description']);         
$sizes = ((isset($_POST['sizes']) && $_POST['sizes']!= '')?sanitize($_POST['sizes']):$product['sizes']);     $sizes = trim($sizes,',');
        
   $saved_image = (($product['image']!= '')?$product['image']:''); 
    $dbpath = $saved_image;    
    }
    
    if(!empty($sizes)){
            $sizeString = sanitize($sizes);
            $sizeString = rtrim($sizeString,',');
            
            $sizesArray = explode(',',$sizeString);
            $sArray = array();
            $qArrar = array();
            foreach($sizesArray as $ss){
                $s = explode(':',$ss);
                $sArray[] = $s[0];
                $qArrar[] = $s[1];
            }
        }else{
            $sizesArray = array();
        }
        
    
    
    $sizesArray = array();
    if($_POST){
        
        $errors = array();
        
        
        $required = array('title', 'brand', 'price', 'parent','child', 'sizes');
         $allowed = array('png','jpg','jpeg','gif');
        
        $uploadPath = array();
        $tmpLoc = array();
        foreach($required as $field){
            if($_POST[$field] == ''){
                $errors[] = 'All fields with Astrisk are required';
                break; 
            }
        }
        var_dump($_FILES['photo']);
        $photoCount = count($_FILES['photo']['name']);
        if($photoCount > 0){ 
            for($i = 0;$i<$photoCount;$i++){ 
        
        
        //if($_FILES['photo']['name'] != ''){
            
            //$photo = $_FILES['photo'];
            //$name = $photo['name'];
            $name = $_FILES['photo']['name'][$i];    
            $nameArray = explode('.',$name);
            $fileName = $nameArray[0];
            $fileExt = $nameArray[1];
            $mime = explode('/',$_FILES['photo']['type'][$i]);
            $mimeType = $mime[0];
            $mimeExt = $mime[1];
            $tmpLoc[] = $_FILES['photo']['tmp_name'][$i];
            
            $fileSize = $_FILES['photo']['size'][$i];
           
            //$uploadName = md5(microtime()).'.'.$fileExt;
           
            $uploadPath[] = BASEURL.'images/'.$name;
                if($i != 0){
                    $dbpath .= ',';
                }
            $dbpath .= $name;
            if($mimeType != 'image'){
                $errors[] = 'The file must be an image';
            }
            if(!in_array($fileExt, $allowed)){
                $errors[] = 'The photo extension must be a png,jpg,jpeg or gif';
            }
          if($fileSize > 1000000){
              $errors[] = 'The file size must be under 15mb';
          } 
            if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
                $errors[] = 'file extensions does not match the file';
           
        }
        }
        
                
        }
        
        
        
        if(!empty($errors)){
        echo display_errors($errors);
        }else{
            
            if($photoCount > 0){
                for($i = 0;$i<$photoCount;$i++){ 
          move_uploaded_file($tmpLoc[$i], $uploadPath[$i]);
                }
            }
            $insertsql = "INSERT INTO `chile`.`products` ( `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `sizes`) VALUES ('$title', '$price', '$list_price', '$brand', '$category', '$dbpath', '$description', '$sizes')";
            
            if(isset($_GET['edit'])){
                $insertsql = "UPDATE products SET title = '$title', price = '$price', list_price = '$list_price', brand = '$brand', categories = '$category', sizes = '$sizes', image = '$dbpath', description = '$description' WHERE id = '$edit_id'";
            }
                $db->query($insertsql);
            header('Location: products.php');
        }
    }
  ?> 
  
  
  <h2 class="text-center"><?php echo ((isset($_GET['edit']))?'Edit':'Add A New'); ?> product</h2><hr>
  <form action="products.php?<?php echo ((isset($_GET['edit']))?'edit='.$edit_id:'add=1'); ?>" method="post" enctype="multipart/form-data">
      <div class="form-group col-sm-3">
          <label for="title">Title*:</label>
          <input type="text" name="title" class="form-control" id="title" value="<?php echo $title; ?>">
      </div>
      
      <div class="form-group col-sm-3">
          <label for="brand">Brand*:</label>
          <select class="form-control" id="brand" name="brand">
              <option value=""<?php echo (($brand == '')?'selected': '');?>></option>
              <?php while($b = mysqli_fetch_assoc($brandQuery)):?>
              <option value="<?php echo $b['id'];?>" <?php echo (($brand == $b['id'])?'selected':'');?>><?php echo $b['brand']; ?></option>
              <?php endwhile;  ?>
              
          </select>
      </div>
      
      <div class="form-group col-sm-3">
          <label for="parent">Parent Category*:</label>
          <select class="form-control" id="parent" name="parent">
              <option value=""<?php echo (($parent == '')?'selected': ''); ?>></option>
              <?php while($p = mysqli_fetch_assoc($parentQuery)): ?>
              <option value="<?php echo $p['id']; ?>"<?php echo (($parent == $p['id'])?'selected':'');?>><?php echo $p['category']; ?></option>
              <?php endwhile;  ?>
          </select>
      </div>
     
      <div class="form-group col-sm-3">
          <label for="child">Child Category*:</label>
          <select id="child" name="child" class="form-control"></select>
          
      </div>
      
        <div class="form-group col-sm-3">
            <label for="price">Price*:</label>
        
        <input id="price" type="text" name="price" class="form-control" value="<?php echo $price;?>" >
        </div>
           
            <div class="form-group col-sm-3">
            <label for="list_price">List Price*:</label>
        
        <input id="list_price" type="text" name="list_price" class="form-control" value="<?php echo $list_price ;?>" >
        </div>
            
            <div class="form-group col-sm-3">
               <label>Quantity & Sizes</label>
                <button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">Quantity & Sizes</button>
            </div>
            <div class="form-group col-sm-3">
                <label for="sizes">Sizes Qty preview</label>
                <input type="text"  class="form-control" name="sizes" id="sizes" value="<?php echo $sizes ;?>" readonly>
            </div>
            
            <div class="form-group col-sm-6">
               <?php if($saved_image != ''): ?>
               <?php 
                $imgi = 1;
                $images = explode(',',$saved_image);
                ?>
                <?php foreach($images as $image): ?>
               <div class="saved-image col-sm-4"><img src="/chilee/images/<?php echo $image; ?> " alt="saved image" class="img-responsive"><br/>
               <a href="products.php?delete_image=1&edit=<?=$edit_id; ?>&imgi=<?php echo $imgi;?>" class="text-danger">Delete Image</a>
               </div>
               <?php 
    $imgi++;
    endforeach; 
                ?>
               <?php else: ?>
                <label for="photo">Product Photo:</label>
                <input type="file" name="photo[]" id="photo" class="form-control" multiple>
                <?php endif; ?>
            </div>
            
            
             
            
            <div class="form-group col-sm-6">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="6"><?php echo $description; ?></textarea>
            </div>
            <div class="form-group col-sm-3">
            <a href="products.php" class="btn btn-danger" role="button">Cancel</a>
            <input type="submit" value="<?php echo ((isset($_GET['edit']))?'Edit':'Add'); ?> Product" class="btn btn-success">
      </div><div class="clearfix"></div>
  </form>
   
    <!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">Size & Quantity</h4>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
        <?php for($i=1;$i <=12;$i++): ?>
        <div class="form-group col-sm-4">
            <label for="size<?php echo $i;?>">Sizes:</label>
            <input type="text" name="size<?php echo $i;?>" id="size<?php echo $i;?>" value="<?php echo ((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>" class="form-control">
        </div>
         <div class="form-group col-sm-2">
            <label for="qty<?php echo $i;?>">Quantity:</label>
            <input type="number" name="qty<?php echo $i;?>" id="qty<?php echo $i;?>" value="<?php echo ((!empty($qArrar[$i-1]))?$qArrar[$i-1]:'');?>" min="0" class="form-control">
        </div>
        
        <?php endfor; ?>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>
  
<?php }else{ 


$sql = "SELECT * FROM products WHERE deleted = 0 ";
$presult = $db->query($sql);
if(isset($_GET['featured'])){
    $id = (int)$_GET['id'];
    $featured = (int)$_GET['featured'];
    $featuredsql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
    $db->query($featuredsql);
    header("Location: products.php");
}
?>

<h2 class="text-center">Products</h2><hr>
<a href="products.php?add=1" class="btn btn-success"id="add-product-btn">Add product</a><div class="clearfix"></div>
<br />
<table class="table table-bordered table-condensed table-striped table-responsive">
    <thead>
        <th></th>
        <th>Product</th>    
    <th>Price</th>            
    <th>Category</th>                
    <th>Featured</th>            
    <th>Sold</th>        
        
    </thead>
    <tbody>
        <?php while($product = mysqli_fetch_assoc($presult)): 
        $childID = $product['categories'];
        $catSql = "SELECT * FROM categories WHERE id= '$childID'";
        $result = $db->query($catSql);
        $child = mysqli_fetch_assoc($result);
        $parentID = $child['parent'];
        $pSql = "SELECT * FROM categories WHERE id = '$parentID'";
        $sresult = $db->query($pSql);
        $parent = mysqli_fetch_assoc($sresult);
        $category = $parent['category'].'~'.$child['category'];
        ?>
        
        <?php
if(!isset($_POST['search'])){
    header("Location: products.php");
}
 
            
           $sql="SELECT * FROM products WHERE  title LIKE '%".$_POST['search']."%' OR description LIKE '%".$_POST['search']."%'";
//$search_query = mysqli_query($conn, $search_sql);


        
        $productQ = $db->query($sql);

$counts = mysqli_num_rows($productQ);
 if($counts > 0){
    
$sqls = "SELECT * FROM products WHERE id = '$id' ";
     $productw = $db->query($sqls);
 }   

?>

        
        
        
        <tr>
        <td>
        <?php if($productw): ?>
        <a href="products.php?edit=<?php echo $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
        <a href="products.php?delete=<?php echo $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>      
        </td> 
        <td><?php echo $product['title']; ?></td> 
        <td><?php echo money($product['price']); ?></td> 
        <td><?php echo $category; ?></td> 
        <td>
            <a href="products.php?featured=<?php echo (($product['featured'] == 0)?'1':'0'); ?>&id=<?=$product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-<?php echo (($product['featured']==1)?'minus':'plus'); ?>"> </span></a>&nbsp; <?php echo (($product['featured'] == 1)?'Featured Product': '');?>    
        </td> 
        <td>0</td>
         <?php else: ?>
         <h2 class="text-center">No item found</h2>
              <?php endif;?>    
        </tr>
        <?php endwhile; ?>
    </tbody>
    
</table>



 

<?php } include 'includes/footer.php'; ?>


	
<script>
jQuery('document').ready(function(){
    get_child_options('<?php echo $category; ?>');
  
});
</script>