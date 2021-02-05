<?php
require_once '../core/init.php';
require_once '../core/confi.php';

session_start();
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
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
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
                        <a href="sales.php"><i class="fa fa-dashboard"></i>Sales</a>
                    </li>
                   <li>
                        <a href="All_sales.php" ><i class="fa fa-dashboard"></i> All Sales</a>
                    </li>
                   <li>
                        <a href="report.php" ><i class="fa fa-dashboard"></i> Report</a>
                    </li>
                     <li>
                        <a href="chart.php" ><i class="fa fa-dashboard"></i> Chart</a>
                    </li>
                     <li>
                        <a href="anaysis.php" ><i class="fa fa-dashboard"></i> Sales Analysis</a>
                    </li>
                </ul>

                    
            </div>

        </nav>
           
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
				 
				 
           <?php
                
                function sizesToArray($string){
    $sizesArray = explode(',',$string);
    $returnArray = array();
    foreach($sizesArray as $size){
        $s = explode(':',$size);
        $returnArray[] = array('size' => $s[0], 'quantity' => $s[1]);
        
    }
    return $returnArray;
}

function sizesToString($sizes){
   $sizeString = '';
    foreach($sizes as $size){
        $sizeString .= $size['size'].':'.$size['quantity'].',';
    }
    $trimmed = rtrim($sizeString, ',');
    return $trimmed;
    
}
        
        ?>
           
           <?php
             require_once 'includes/init.php';      
        $iQuery = $db->query("SELECT * FROM products WHERE deleted = 0");
        $lowItems = array();
                while($product = mysqli_fetch_assoc($iQuery)){
                   
                    $item = array();
                    $sizes = sizesToArray($product['sizes']);
                    foreach($sizes as $size){
                    $cat = get_category($product['categories']);
                        
                        $item = array(
                        'title' => $product['title'],
                         'price' => $product['price'],    
                        'size' => $size['size'],
                        'quantity' => $size['quantity'],
                        'category' =>  $cat['parent'] . '~' .$cat['child']    
                        );
                        $lowItems[] = $item;
                    }
                }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       
                                        <tr>
                                          
                                           <th>product</th>
                                            <th>price</th>
                                            <th>category</th>
                                            <th>Size</th>
                                            
											<th>Quantity</th>
											
											
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                    <?php foreach($lowItems as $item): ?>
                                    <tr<?php echo ($item['quantity'] <= 10 )?' class="danger"': '';?> <?php echo ($item['quantity'] >= 20 )?' class="success"': '';?>>
                                    <td><?php echo $item['title']; ?></td>
                                    <td><?php echo $item['price']; ?></td>
                                    <td><?php echo $item['category']; ?></td>
                                    <td><?php echo $item['size']; ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
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