<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?> 

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FOREVER HOTEL</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- Morris Chart Styles-->
   
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
            
            
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           Payment Details<small> </small>
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
				 
				 
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                          
                                           <th>S/N</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            
											<th>Items</th>
											<th>quantity</th>
											<th>size</th>
											<th>No.Of items</th>
											<th>Sub_price</th>
											<th>Total_price</th>
											
											<th>Date & Time</th>
											<th>Print</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
									<?php
										include ('db.php');
										$sql="select * from payment";
										$re = mysqli_query($con,$sql);
										while($row = mysqli_fetch_array($re))
										{
										
											$id = $row['ids'];
											
											if($id % 2 ==1 )
											{
												echo"<tr class='gradeC'>
                                                <td>".$row['ids']."</td>
													<td>".$row['first_name']." ".$row['last_name']."</td>
													<td>".$row['email']."</td>
													<td>".$row['items']."</td>
													<td>".$row['quantity']."</td>
													<td>".$row['size']."</td>
													<td>".$row['item_count']."</td>
													<td>".$row['sub_price']."</td>
													<td>".$row['total_price']."</td>
                                                    <td>".$row['date_added']."</td>
													
													<td><a href=print.php?pid=".$id ." <button class='btn btn-sm' id='button-edit'> <i class='fa fa-print' ></i> Print</button></td>
													</tr>";
											}
											else
											{
												echo"<tr class='gradeU'>
                                                <td>".$row['ids']."</td>
													<td>".$row['first_name']." ".$row['last_name']."</td>
													<td>".$row['email']."</td>
													<td>".$row['items']."</td>
													<td>".$row['quantity']."</td>
													<td>".$row['size']."</td>
													<td>".$row['item_count']."</td>
													<td>".$row['sub_price']."</td>
													<td>".$row['total_price']."</td>
                                                    <td>".$row['date_added']."</td>
													
													<td><a href=print.php?pid=".$id ." <button class='btn btn-sm' id='button-edit'> <i class='fa fa-print' ></i> Print</button></td>
													</tr>";
											
											}
										
										}
										
									?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            
                </div>
               
            </div>
        
               
    </div>
             <!-- /. PAGE INNER  -->
            
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>
