<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?>

<?php
		if(!isset($_GET["rid"]))
		{
				
			 header("location:login.php");
		}
		else {
				$curdate=date("Y/m/d");
				include ('db.php');
				$id = $_GET['rid'];
				
				
				$sql ="Select * from posts where id = '$id'";
				$re = mysqli_query($con,$sql);
				while($row=mysqli_fetch_array($re))
				{
                    
                    
					
					$fname = $row['first_name'];
					$lname = $row['last_name'];
					$email = $row['email'];
					$ui = $row['user_id'];
					$token = $row['token'];
					$phone = $row['phone'];
					$address = $row['address'];
					$items = $row['items'];
					$qty = $row['quantity'];
				    $size = $row['size'];
					$sub_p = $row['sub_price'];
                    $tm = $row['total_price'];
					$item_c = $row['item_count'];
					
				    
				
				}
            
           
	}
		
			?>



<?php


    
    
    
						if(isset($_POST['co']))
						{	
							$st = $_POST['conf'];
							
							 
							
							if($st=="Confirm")
							{
                                
	
									$urb = "UPDATE `posts` SET `confirm`='$st' WHERE id = '$id'";
									if( mysqli_query($con,$urb)){
                                        
                                  $thisYr = date("Y");
								   	
														$psql = "INSERT INTO `payment`(`ids`, `first_name`, `last_name`, `email`, `items`, `quantity`, `size`, `item_count`, `sub_price`,`total_price`, `date_added`,`year_added`) VALUES ('$id','$fname','$lname','$email','$items','$qty','$size','$item_c','$sub_p','$tm', CURRENT_TIMESTAMP, '$thisYr')";
														
														if(mysqli_query($con,$psql)){ 
                                                            
                                                        
                                                            
                                                            foreach ($items as $ok) {
    
                                                      $oks = mysqli_real_escape_string($ok);
                                                       
         
                                                    $query = "INSERT INTO post_votes (id, items, sizes, quantity, p_date,) VALUES (Null, )";
                                                      if (mysqli_query($con, $query)){ 
                                                          
															
														
											}else{
                                        $error = "<h2 class='text-danger'>Not Confirmed</h2>";
                                                            //something went wrong
            echo "Error:" . $query . "<br>" . mysqli_error($con);
                                    }
									
                            }
							}
 
     }
    

					
						?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator </title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="admincss.css">
</head>

<body>
    
    <div id="wrapper">
         <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $_SESSION["user"]; ?> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="user-setting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Inventory</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
         
                  
        
                    <li>
                        <a class="active" href="index.php" style="background: #e17339;"><i class="fa fa-dashboard"></i> Status</a>
                    </li>
                   <li><a href="/chilee/admin/brands.php"><i class="fa fa-dashboard"></i> Brands</a></li>
              
             <li><a href="/chilee/admin/categories.php"><i class="fa fa-dashboard"></i> Categories</a></li>
               <li><a href="/chilee/admin/products.php"> <i class="fa fa-dashboard"></i> Products</a></li>
              <li><a href="/chilee/admin/archives.php"><i class="fa fa-dashboard"></i> Archives</a></li>
               
               <li><a href="payment.php"> <i class="fa fa-dashboard"></i>Payment</a></li>
               <li><a href="profit.php"> <i class="fa fa-dashboard"></i>Profit</a></li> 
               <li><a href="subscribers.php"> <i class="fa fa-dashboard"></i>Message</a></li>  
      </ul>
        
        
      

            </div>

        </nav>
        


        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Room Booking<small>
                                <?php echo  $curdate; ?> </small>
                            <?php echo $error; ?>
                        </h1>
                    </div>


                    <div class="col-md-8 col-sm-8">
                        <div class="panel panel">
                            <div class="panel-heading">
                                Booking Conformation
                            </div>
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>DESCRIPTION</th>
                                            <th>INFORMATION</th>

                                       
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>
                                                <?php echo $fname." ".$lname; ?>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <th>
                                                <?php echo $email; ?>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>User_Number </th>
                                            <th>
                                                <?php echo $ui; ?>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>Mobile Number </th>
                                            <th>
                                                <?php echo $phone;  ?>
                                            </th>

                                        </tr>
                                       
                                        <tr>
                                            <th>Address </th>
                                            <th>
                                                <?php echo $address; ?>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>Items Bought </th>
                                            <th>
                                                <?php echo $items; ?>
                                            </th>

                                        </tr>

                                        <tr>
                                            <th>Quantity </th>
                                            <th>
                                                <?php echo $qty; ?>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>Sizes </th>
                                            <th>
                                                <?php echo $size; ?>
                                            </th>

                                        </tr>

                                        <tr>
                                            <th>No Of Items </th>
                                            <th>
                                                <?php echo $item_c ?>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>Sub_Total</th>
                                            <th>
                                                <?php echo $sub_p; ?>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>Total amount</th>
                                            <th>
                                                <?php echo $tm; ?>
                                            </th>

                                        </tr>
                                       
                                    
                                    </table>
                                </div>



                            </div>
                            <div class="panel-footer">
                                <form method="post">
                                    <div class="form-group">
                                        <label style=" font-family: 'PlayfairDisplay-Regular';">Select the Confirmation</label>
                                        <select name="conf" class="form-control">
                                            <option value selected> </option>
                                            <option value="Confirm">Confirm</option>


                                        </select>
                                    </div>
                                    <input type="submit" name="co" value="Confirm" class="btn btn-lg" id="button-edit">

                                </form>
                            </div>
                        </div>
                    </div>





                </div>
                <div class="panel-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- /. ROW  -->

    </div>
    <!-- /. ROW  -->




    </div>
    <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>