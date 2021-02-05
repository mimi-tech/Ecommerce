<?php
session_start();
   include '/chilee/connection/db.php';
   $user_id = $ips;
?>

<?php
if(isset($_GET['delete'])){
    $id = $citem['id'];
    $id = ($_GET['delete']);
    $db->query("DELETE FROM cart WHERE id = '$id'");
    header("Location: /chilee/index.php");
}                
?>



    
     
       
        <div class="modal_cart">
        <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel2">Right Sidebar</h4>
				</div>

				<div class="modal-body">
        
       
        <div id="modal_success"></div>
        
                    <h3>RECOMMENDATIONS</h3>
                    
  
 <?php
    $sqlc = "SELECT * FROM products WHERE featured = 1 AND deleted = 0 ORDER BY RAND()
   LIMIT 3";
    $cquery = mysqli_query($conn, $sqlc);
?>

 <?php while($Cproduct = mysqli_fetch_array($cquery)) :?>
              
              <div class="col-sm-3">
                  <h4><?php echo $Cproduct['title']; ?></h4>
                  
                  <?php $photos = explode(',' ,$Cproduct['image']); ?>
                  <img src="images/<?= $photos[0]; ?> " alt="<?php echo $Cproduct['title']; ?>" height=50px width=30px/>
                  <p class="list-price text-danger">List Price<s><?= $Cproduct['list_price']; ?></s></p>
                  <P class="price">our price:<?= $Cproduct['price']; ?></P>
                  <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<? echo $Cproduct['id']; ?>)">Details</button>
                  
                 
               
                 
                 
              </div>
              <?php endwhile;?>
             
   	</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
		
	</div><!-- modal -->
</div>
   
 