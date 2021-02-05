
<?php
session_start();
$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);
?>
     <nav class="navbar navbar-fixed-top"> 
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
           <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span>    
      </button>
          <a href="#" class="navbar-brand" >Chilee's Boutique</a>
         
          <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li> <a href="index.php" >All</a></li>
             <?php while($parent = mysqli_fetch_assoc($pquery)) :?>
             <?php $parent_id = $parent['id'];
              $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
              $cquery = $db->query($sql2);
              ?>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><?php echo $parent['category']; ?><span class="caret" ></span></a>
                  <ul class="dropdown-menu" >
                      <?php while($child = mysqli_fetch_assoc($cquery)) :?>
                      <l1><br><a href="/chilee/category.php?cat=<?php echo $child['id']; ?>" style="text-decoration:none;"><?php echo $child['category']; ?></a></l1>
                      
                      <?php endwhile; ?>
                  </ul>
              </li>
              <?php endwhile; ?>
              
              <?php
              require('UserInfo.php');
              $ips= UserInfo::get_ip();
              $uid = $ips;
              $whereIn = implode(',' , $_SESSION['cart']);

    $sql = "SELECT * FROM cart WHERE  product_id IN ($whereIn) AND  user_id = '$uid'";
    $run_query = mysqli_query($conn,$sql);
             
              ?>
             
              
             
            <li>
              <form name="form1" method="post" action="search.php" id="search-group" style="display:none;">
               <div class="input-group " style="width:350px; left:0px; top:10px;" >
                 <input name="search" type="search" required class="form-control input" />
                   <div class="input-group-addon">
                     
                     <button type="submit" class="btn btn-xs" name="submit"><span class="glyphicon glyphicon-search"></span></button>
                   </div>
                  </div>
      </form>
              </li>
             <li class="search"><a href="" class="glyphicon glyphicon-search open_search" style=" left:10px; top:0px;"></a></li>
              </ul>
               <ul class="nav navbar-nav navbar-right">
               
               <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart  <span class="badge"><?php echo mysqli_num_rows($run_query); ?></span></a></li>
               
              
 
               
              <?php  
session_start();
$name = $_SESSION["u_first"]; 
              
if(isset($_SESSION["uid"]))
{
    
  $result = "<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'> <span class='glyphicon glyphicon-user'></span>$name
             </a>
              <ul class='dropdown-menu'>
                   <li><a href='/chilee/history.php' style='text-decoration:none; color:white;'><span class='glyphicon glyphicon-shopping-cart'>History</span></a></li>
                  <li class='divider'></li>
                  <li><a href='#' style='text-decoration:none; color:white;' data-toggle='modal' data-target='#checkoutModal' class='nav-modal'>Update Profile</a></li>
                  <li class='divider'></li>
                   <li><a href ='/chilee/wishlist.php' style='text-decoration:none; color:white;'>Wishlist</a></li>
                   <li class='divider'></li>
                  <li><a href ='/chilee/front_end/logout.php' style='text-decoration:none; color:white;'>Logout</a></li>
                   </ul>
              </li>";
}else{

 
     $user_name = $_COOKIE["user"];
$sql = "SELECT * FROM user_info WHERE user_id = '$user_name'";
        $run_query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($run_query);
           if($count > 0){                 
        while($row = mysqli_fetch_assoc($run_query)){  
            $_SESSION['uid'] = $row['user_id'];
                    $_SESSION['u_token'] = $row['token'];
                    $_SESSION['u_first'] = $row['first_name'];
                    $_SESSION['u_last'] = $row['last_name'];
                    $_SESSION['u_email'] = $row['email'];
                   $_SESSION['u_phone'] = $row['phone'];
                   
                    $_SESSION['u_address'] = $row['shipping_address'];

                    $first_name =  $row['first_name'];
          $result = "<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>  <span class='glyphicon glyphicon-user'></span> $first_name 
             </a>
              <ul class='dropdown-menu'>
                   <li><a href='/chilee/history.php' style='text-decoration:none; color:blue;'><span class='glyphicon glyphicon-shopping-cart'>History</span></a></li>
                  <li class='divider'></li>
                  <li><a href='#' style='text-decoration:none; color:blue;' data-toggle='modal' data-target='#checkoutModal' class='nav-modal'>Update Profile</a></li>
                  <li class='divider'></li>
                  <li><a href ='/chilee/front_end/logout.php' style='text-decoration:none; color:blue;'>Logout</a></li>
                   </ul>
              </li>";
      
}
        }else{
                $log = "<li><a href ='/chilee/front_end/login.php'  >Login</a></li>";
           }
}

?>
             <?php echo $result;
              echo $log;
           
              ?>
             <li><a href ="/chilee/front_end/signin.php"  >  <span class='glyphicon glyphicon-user'></span>Signup</a></li>
              
          </ul>
          
          
          
      </div>
         
      </nav>
      
    
   