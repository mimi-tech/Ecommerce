        
            <?php
include 'db.php';
$min = $_POST["minimum_range"];
$max = $_POST["maximum_range"];
$query = "SELECT * FROM products WHERE featured = 1 AND  price BETWEEN '$min' AND '$max' ORDER BY price ASC";
$result = mysqli_query($conn, $query);
?>


<?php while($product = mysqli_fetch_array($result)) :?>
              
              <div class="col-sm-3">
                  <h4><?php echo $product['title']; ?></h4>
                  
                  <?php $photos = explode(',' ,$product['image']); ?>
                  <img src="/chilee/images/<?= $photos[0]; ?> " alt="<?php echo $product['title']; ?>" class="img-responsive"/>
                  <p class="list-price text-danger">List Price<s><?= $product['list_price']; ?></s></p>
                  <P class="price">our price:<?= $product['price']; ?></P>
                  <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<? echo $product['id']; ?>)">Details</button>
                  <a href="tes.php?view=<?php echo $product['id']; ?>">view</a>
                 <a href="star-rating/index.php?review=<?php echo $product['id']; ?>"><img src="img/stars.jpg" height="15px" width="70px"></a>
                 
               
                 
                
              </div>
              
               <?php endwhile; ?>
               
              
             
            
           
         
   
 <script>
$(document).ready(function(){
    
     
    $('#price_range').slider({
range:true,
min:1000,
max:20000,
value:[<?php echo $minimum_range; ?>, <?php echo $maximum_range; ?>],
        
        
slide:function(event,ui) {
    $("#minimum_range").val(ui.values[0]);
     $("#maximum_range").val(ui.values[1]);
    load_product(ui.values[0], ui.values[1]);
}       
    });
  
    
    
    load_product(<?php echo $minimum_range; ?>, <?php echo $maximum_range; ?>);
    function load_product(minimum_range, maximum_range){
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{minimum_range:minimum_range, maximum_range:maximum_range},
            success:function(data){
                $('#load_product').html(data).fadeIn(3000);
                
            }
        });
    }
    
})
</script>
     
         
        