<?php
session_start();

if(!isset($_SESSION["uid"])){
    header("Location: signin.php");
}
?>

<?php require_once 'connection/db.php'; ?>  
<?php require_once 'connection/connect.php'; ?>  
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>
  
<?php include 'includes/left_bar.php';?>

 <?php
if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 3;
        $offset = ($pageno-1) * $no_of_records_per_page;

       

        $total_pages_sql = "SELECT COUNT(*) FROM products";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


$sql = "SELECT * FROM products WHERE featured = 1 LIMIT $offset, $no_of_records_per_page";
$featured = $db->query($sql);

?>
    
  <div class="container-fluid">
   
      <!-- MAIN CONTENT-->
      <div class="col-sm-8" >
          <div class="row" id="images">
              <h2 class="text-center" style="margin-top:100px;">Fetured Products</h2>
              <?php while($product = mysqli_fetch_assoc($featured)) :?>
              
              <div class="col-sm-3">
                  <h4><?php echo $product['title']; ?></h4>
                  <img src="images/<?= $product['image']; ?> " alt="<?php echo $product['title']; ?>" class="img-responsive"/>
                  <p class="list-price text-danger">List Price<s><?= $product['list_price']; ?></s></p>
                  <P class="price">our price:<?= $product['price']; ?></P>
                  <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<? echo $product['id']; ?>)">Details</button>
              </div>
              
               <?php endwhile; ?>
          </div>
      </div>
      
      <p>Search</p>
      <form name="form1" method="post" action="search.php">
          <input name="search" type="text" size="40" maxlength="50" />
          <input type="submit" name="submit" value="search" />
      </form>
      
  <?php include 'includes/rightbar.php';?>      
  </div> 
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
  <?php
//include 'includes/detailsmodal.php';

include 'includes/footer.php';
?>
 