
<?php require_once 'connection/db.php'; ?>  
<?php require_once 'connection/connect.php'; ?>  
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>
 <p><br /></p>
  <p><br /></p>
  <p><br /></p>
  
  <?php

$sq = "SELECT MIN(  `price` ) AS  `lowest` , MAX(  `price` ) AS  `highest` FROM  `products`";
$result = mysqli_query($conn, $sq);
while($row = mysqli_fetch_array($result)){
 $minimum_range = $row['lowest'];
    $maximum_range = $row['highest'];
   
}

?>
  
  <div class="row">
    <div class="col-md-1">
        <input type="text" name="minimum_range" id="minimum_range" class="form-control" value="<?php echo $minimum_range; ?>" />
    </div>  
    <div class="col-md-2">
        
        <div id="price_range"></div>
    </div>
     <div class="col-md-1">
    <input type="text" name="maximum_range" id="maximum_range" class="form-control" value="<?php echo $maximum_range; ?>" />
      </div>
  </div>
  
   <div id="load_product"></div>
<style>
    #loading{
        text-align: center;
        background: url('images/loading.gif')no-repeat center;
        height:  150px;
    }

</style>
  <?php include 'includes/footer.php'; ?>