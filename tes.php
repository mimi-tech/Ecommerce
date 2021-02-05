<?php
session_start();


require_once 'connection/db.php'; ?>
<?php require_once 'connection/connect.php'; ?>
<?php require_once 'config.php'; ?>
<?php include 'includes/head.php';?>

<?php include 'includes/navigation.php';
?>
<?php

if(isset($_GET['view'])){
    $view_id = ($_GET['view']);
    
}else{
    $view_id = '';
}

  
 
$sql = "SELECT * FROM products WHERE id = '$view_id'";
    $run_query = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
        
        $total_amt =0 ;
        while($row = mysqli_fetch_array($run_query)){
            $id = $row["id"];
            $pro_image = $row["image"];
            $pro_name = $row["title"];
            
           
        
    }
}

?>
  <div class="container-fluid">
   
      <!-- MAIN CONTENT-->
      <div class="row" >
      <div class="col-sm-12" >
          
              <h2 class="text-center" style="margin-top:100px;"><?php echo $pro_name; ?></h2>
             <center>              
                <div class="view-image">
                 
                 <?php $photos = explode(',',$pro_image); 
                            foreach($photos as $photo):
                            ?>
                  <img src="images/<?= $photo; ?> " class="img-responsive"/>
                   <?php endforeach; ?>
              </div>
          </center>
              
          </div>
      </div>
      <?php include 'includes/rightbar.php';?>
</div>
 <?php
 include 'includes/footer.php';  
?>
