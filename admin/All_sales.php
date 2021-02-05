<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?> 
<?php include 'includes/init.php';?>

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
                <a class="navbar-brand" href="index.php">MAIN MENU </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
			
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="user_setting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
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
                        <a class="active" href="settings.php" ><i class="fa fa-dashboard"></i>Products</a>
                    </li>
                    
                    <li>
                        <a href="inventory.php" ><i class="fa fa-dashboard"></i>Unavaliable Products</a>
                    </li>
                   
					<li>
                        <a href="sales.php" ><i class="fa fa-dashboard"></i>Sales</a>
                    </li>
                   <li>
                        <a href="All_sales.php" style="background:#e17339;"><i class="fa fa-dashboard"></i> All Sales</a>
                    </li>
                   
                    <li>
                        <a href="report.php" ><i class="fa fa-dashboard"></i> Report</a>
                    </li>
                    <li>
                        <a href="anaysis.php" ><i class="fa fa-dashboard"></i> Report Analysis</a>
                    </li>
                </ul>

                    
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
             
            
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           Payment Details
                           <?php 
                            $curdate=date("Y/m/d");
                            echo $curdate;
                            ?>
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
                                           <th>Customer Name</th>
                                            
											<th>Items</th>
											
											<th>size</th>
											<th>quantity</th>
											
											<th>Sub-Totals</th>
											<th>Date & Time</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
									<?php
										include ('db.php');
                                        
										$sql = "SELECT * FROM semi_posts";
										$run_query = mysqli_query($con,$sql);
                                          $count = mysqli_num_rows($run_query);
                                          if($count > 0){
                                               $item_count= 0;
                                             while($row = mysqli_fetch_array($run_query)){  
										$no = $no + 1;
                                        $qty = $row["quantity"];
                                        $pro_price = $row["sub_prices"];         
											$id = $row['ids'];
                                            
                                            $price_array = array($pro_price);
                                            $total_sum = array_sum($price_array);
                                            $total_amt = $total_amt + $total_sum;     
                                                 
                                            $It_array = array($qty);
                                            $It_total = array_sum($It_array);
                                            $item_count = $item_count + $It_total;     
                                                 
											
											if($id % 2 ==1 )
											{
												echo"<tr class='gradeC'>
                                                <td>$no</td>
													<td>".$row['customer_name']."</td>
													<td>".$row['items']."</td>
													
													<td>".$row['sizes']."</td>
                                                    <td>".$row['quantity']."</td>
													 <td>".$row['sub_prices']."</td>
                                                    <td>".$row['date_added']."</td>
													
													
													</tr>";
											}
											else
											{
												echo"<tr class='gradeU'>
                                                 <td>$no</td>
                                                <td>".$row['customer_name']."</td>
													<td>".$row['items']."</td>
													
													<td>".$row['sizes']."</td>
                                                    <td>".$row['quantity']."</td>
													 <td>".$row['sub_prices']."</td>
                                                    <td>".$row['date_added']."</td>
													</tr>";
											
											}
										
										}
                                          }else{
                                              echo "No sales Today";
                                          }
									?>
                                      
                                        
                                            
                                    </tbody>
                                </table>
                                
                                
                                <table class="table table-bordered table-condensed text-right">
            <legend>Total</legend>
            <thead class="totals-table-header">
                <th>Total items</th>
                
                <th>Grand Total</th>

            </thead>

            <tbody>
                <tr>
                    <td>
                        <?php echo $item_count; ?>
                    </td>
                    
                    <td class="bg-success">
                        <?php echo $total_amt; ?>
                    </td>
                </tr>
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
