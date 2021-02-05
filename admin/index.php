<?php
require_once '../core/init.php';
require_once '../core/confi.php';

session_start();

if ( isset($_GET['success']) && $_GET['success'] == 1 )
{
     // treat the succes case ex:
     $errTyp = "success";   
     $errMSG = "You have been Logged in successfully"; 
}
?>

 <?php
   if ( isset($errMSG) ) {
    
    ?>
   
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>" style="text-align:center;">
     <?php echo $errMSG; ?>
                </div>
         
                <?php
   }
   ?>






<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:login.php");
}
?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator	</title>
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
    <link rel="stylesheet" href="admincss.css" />
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
        
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Status <small>Room Booking </small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
				<?php
						include ('db.php');
						$sql = "select * from posts";
						$re = mysqli_query($con,$sql);
						$c =0;
						while($row=mysqli_fetch_array($re) )
						{
								$new = $row['confirm'];
								
								$id = $row['id'];
								if($new=="Not Confirm")
								{
									$c = $c + 1;
									
								
								}
						
						}
				
				?>

					<div class="row">
                <div class="col-sm-12">
                    
                       
                        <div class="panel-body" style="background:#dbdddd;">
                            <div class="panel-group" id="accordion">
							
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
											<button class="btn btn-default" type="button">
												 New Room Bookings  <span class="badge"><?php echo $c ; ?></span>
											</button>
											</a>
                                        </h4>
                                    </div>
                                
                                    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                       <div class="panel-body" style="width:100%;">
                                          <div class="panel panel-default"> 
                            <div class="table-responsive">
                                 <table class="table table-striped table-bordered table-hover">
                                
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>mobile No</th>
											
											<th>No.Of items</th>
											<th>Statues</th>
											<th>Statues</th>
											<th>Details</th>
											<th>More</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                        
                                          
									<?php
                                        
									$tsql = "select * from posts";
									$tre = mysqli_query($con,$tsql);
									while($trow=mysqli_fetch_array($tre) )
                                     
									{
                                    
										$co =$trow['confirm']; 
										if($co=="Not Confirm")
										{
                                        
                                            
											echo"<tr>
												<td>".$trow['id']."</td>
                                               
												<td>".$trow['first_name']." ".$trow['last_name']."</td>
												<td>".$trow['email']."</td>
												<td>".$trow['phone']."</td>
												
												<td>".$trow['item_count']."</td>
                                                <td>".$trow['statues']."</td>
                                                <td>".$trow['confirm']."</td>
                                                <td><a href='details.php?oid=".$trow['id']." ' class='btn btn-sm' id='button-edit'>Details</a></td>
                                                
												<td><a href='salesbook.php?rid=".$trow['id']." ' class='btn btn-sm' id='button-edit'>Action</a></td>
												</tr>";
										}	
									
									}
                                    
									?>
                                     
                                    </tbody>
                                </table>
								
                            </div>
                                        </div>
                                </div>
                       
                      <!-- End  Basic Table  --> 
                                        </div>
                                    </div>
                                </div>
                    
								
                                <?php
								
								$fsql = "SELECT * FROM `contact`";
								$fre = mysqli_query($con,$fsql);
								$f =0;
								while($row=mysqli_fetch_array($fre) )
								{
										$f = $f + 1;
								
								}
						
								?>
                                <div class="panel panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
											<button class="btn btn-primary" type="button">
												 Followers  <span class="badge"><?php echo $f ; ?></span>
											</button>
											</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
											<th>Follow Start</th>
                                            <th>Permission status</th>
                                            
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
									<?php
									$csql = "select * from contact";
									$cre = mysqli_query($con,$csql);
									while($crow=mysqli_fetch_array($cre) )
									{	
										
											echo"<tr>
												<th>".$crow['id']."</th>
												<th>".$crow['fullname']."</th>
												<th>".$crow['email']." </th>
												<th>".$crow['cdate']." </th>
												<th>".$crow['approval']."</th>
												</tr>";
										
									
									}
									?>
                                        
                                    </tbody>
                                </table>
								<a href="messages.php" class="btn btn-primary">More Action</a>
                            </div>
                        </div>
                    </div>
                                        </div>
                                    </div>
                                
                                
                                
                             
			
				
								
                    

                <!-- /. ROW  -->
				
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
        </div>
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
