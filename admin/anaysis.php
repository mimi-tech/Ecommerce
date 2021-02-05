<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?>
<?php
 require_once 'includes/init.php';
$n = date('n');

$d = date('d');

$y = date('Y');
$m = date('F');
$currentWeekNumber = date('W');
 $date=date("Y-m-d");

$unixTimestamp = strtotime($date);

$dayOfWeek = date("l", $unixTimestamp);
?>




<?php
										include ('db.php');
                                        $yesterday = $d - 1;
                
										$sql = "SELECT * FROM semi_posts WHERE c_date = '$yesterday' AND c_year = '$y'";
										$run_query = mysqli_query($con,$sql);
                                          $count = mysqli_num_rows($run_query);
                                          if($count > 0){
                                               $item_count= 0;
                                              $$qty_amt = 0;
                                             while($row = mysqli_fetch_array($run_query)){  
										$no = $no + 1;
                                        $qty = $row["quantity"];
                                        $pro_total = $row["sub_prices"];         
											$id = $row['id'];
                                            
                                           $pricey_array = array($pro_total);
                                            $totaly_sum = array_sum($pricey_array);
                                            $totaly_amt = $totaly_amt + $totaly_sum; 
											
                                                 $qty_array = array($qty);
                                            $qty_sum = array_sum($qty_array);
                                            $qty_amt = $qty_amt + $qty_sum; 
											
											
											}
											
                                          }
                                          
									?>


<?php
										include ('db.php');
                                       $ly = $y - 1;
                
										$sql = "SELECT * FROM semi_posts WHERE c_year = '$ly'";
										$run_query = mysqli_query($con,$sql);
                                          $county = mysqli_num_rows($run_query);
                                          if($county > 0){
                                               $Qt_count = 0;
                                              $totalty_amt = 0;
                                             while($row = mysqli_fetch_array($run_query)){  
										$no = $no + 1;
                                        $qtyty = $row["quantity"];
                                        $pro_totalty = $row["sub_prices"];         
											$idty = $row['id'];
                                            
                                           $pricety_array = array($pro_totalty);
                                            $totalty_sum = array_sum($pricety_array);
                                            $totalty_amt = $totalty_amt + $totalty_sum;
                                                 
											$Qt_array = array($qtyty);
                                            $Qt_total = array_sum($Qt_array);
                                            $Qt_count = $Qt_count + $Qt_total;  
											
											}
											
                                          }
                                          
									?>



<?php
										include ('db.php');
                                      
                
										$sql = "SELECT * FROM semi_posts WHERE months = '$n' And c_year = '$y'";
										$run_query = mysqli_query($con,$sql);
                                          $countm = mysqli_num_rows($run_query);
                                          if($countm > 0){
                                               $totalm_amt = 0;
                                             while($row = mysqli_fetch_array($run_query)){  
										$no = $no + 1;
                                        $qtym = $row["quantity"];
                                        $pro_totalm = $row["sub_prices"];         
											$idty = $row['id'];
                                          
                                           $pricem_array = array($pro_totalm);
                                            $totalm_sum = array_sum($pricem_array);
                                            $totalm_amt = $totalm_amt + $totalm_sum;
                                                 
											$Qm_array = array($qtym);
                                            $Qm_total = array_sum($Qm_array);
                                            $Qm_count = $Qm_count + $Qm_total;  
											
											}
											
                                          }
                                          
									?>


<?php
										include ('db.php');
                                      $last_month = $n - 1;
                
										$sql = "SELECT * FROM semi_posts WHERE months = '$last_month' ";
										$run_query = mysqli_query($con,$sql);
                                          $countlm = mysqli_num_rows($run_query);
                                          if($countlm > 0){
                                             
                                               $totallm_amt = 0;
                                               $Qlm_count = 0;
                                             while($row = mysqli_fetch_array($run_query)){  
										$no = $no + 1;
                                        $qtylm = $row["quantity"];
                                        $pro_totallm = $row["sub_prices"];         
											$idty = $row['id'];
                                          
                                           $pricelm_array = array($pro_totallm);
                                            $totallm_sum = array_sum($pricelm_array);
                                            $totallm_amt = $totallm_amt + $totallm_sum;
                                                 
											$Qlm_array = array($qtylm);
                                            $Qlm_total = array_sum($Qlm_array);
                                            $Qlm_count = $Qlm_count + $Qlm_total;  
											
											}
											
                                          }
                                          
									?>




<?php
										include ('db.php');
                                        
										$sql = "SELECT * FROM semi_posts WHERE wk_number = '$currentWeekNumber' AND c_year = '$y'";
										$run_query = mysqli_query($con,$sql);
                                          $countw = mysqli_num_rows($run_query);
                                          if($countw > 0){
                                              $total_amtw = 0;
                                               $item_countw= 0;
                                             while($row = mysqli_fetch_array($run_query)){  
										
                                        $qtyw = $row["quantity"];
                                        $pro_pricew = $row["sub_prices"];         
											
                                            
                                            $pricew_array = array($pro_pricew);
                                            $totalw_sum = array_sum($pricew_array);
                                            $total_amtw = $total_amtw + $totalw_sum;     
                                                 
                                            $Itw_array = array($qtyw);
                                            $Itw_total = array_sum($Itw_array);
                                            $item_countw = $item_countw + $Itw_total; 
                                             }
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
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <link rel="stylesheet" href="up_date.css" />
    
   
    
</head>

<body>
    <style>


        .signup,
.login,
.popular,
.customer{
  width: 15%;
  background: #fff;
  float: left;
  height: 60px;
  line-height: 60px;
  text-align: center;
  cursor: pointer;
  text-transform: uppercase;
}
    </style>
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
                        <a class="active" href="settings.php"><i class="fa fa-dashboard"></i>Products</a>
                    </li>
                    <li>
                        <a href="inventory.php"><i class="fa fa-dashboard"></i>Unavaliable Products</a>
                    </li>

                    <li>
                        <a href="sales.php"><i class="fa fa-dashboard"></i>Sales</a>
                    </li>
                    <li>
                        <a href="All_sales.php"><i class="fa fa-dashboard"></i> All Sales</a>
                    </li>
                    <li>
                        <a href="report.php"><i class="fa fa-dashboard"></i> Report</a>
                    </li>
                    <li>
                        <a href="anaysis.php"><i class="fa fa-dashboard"></i> Report Analysis</a>
                    </li>
                </ul>


            </div>

        </nav>
        <!-- /. NAV SIDE  -->

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <?php
                            $curdate=date("Y-m-d");
                            echo $curdate;    
                            ?>

                            <br>
                            <small> Company's Analysis</small>
                        </h1>
                        <div class="login">Sales</div>
                        <div class="signup">Customer </div>
                        <div class="popular">Popular Items</div>
                        <div class="customer">Clients</div>
                    </div>
                </div>
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
$id = $row['id'];
   
$price_array = array($pro_price);
$total_sum = array_sum($price_array);
$total_amt = $total_amt + $total_sum;     

$It_array = array($qty);
$It_total = array_sum($It_array);
$item_count = $item_count + $It_total;     
	
}	
}
	?>
                <div class="sales-analysis">
                    <div style="border:solid 2px red;">
                        <div class="row">
                            <div class=' col-sm-2'>
                                <div class='panel text-center no-boder bg-color-blue'>
                                    <div class='panel-body'>
                                        <p class="sales">Total Sales</p>
                                        <i class='fa fa-shopping-cart fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $total_amt;?>
                                        </h3>

                                    </div>

                                </div>
                            </div>
                            <?php
										include ('db.php');
                                       
                
										$sql = "SELECT * FROM semi_posts WHERE c_year = '$y'";
										$run_query = mysqli_query($con,$sql);
                                          $county = mysqli_num_rows($run_query);
                                          if($county > 0){
                                               $Qt_count= 0;
                                              $totalty_amt ;
                                             while($row = mysqli_fetch_array($run_query)){  
										$no = $no + 1;
                                        $qtyty = $row["quantity"];
                                        $pro_totalty = $row["sub_prices"];         
											$idty = $row['id'];
                                            
                                           $pricety_array = array($pro_totalty);
                                            $totalty_sum = array_sum($pricety_array);
                                            $totalty_amt = $totalty_amt + $totalty_sum;
                                                 
											$Qt_array = array($qtyty);
                                            $Qt_total = array_sum($Qt_array);
                                            $Qt_count = $Qt_count + $Qt_total;  
											
											}
											
                                          }
                                          
									?>



                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-brown'>
                                    <div class='panel-body'>
                                        <p class="sales">
                                            <?php echo $y?> Sales</p>
                                        <i class='fa fa-shopping-cart fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $totalty_amt; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>

                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-green'>
                                    <div class='panel-body'>
                                        <p class="sales">
                                            <?php echo $m;?> Sales</p>
                                        <i class='fa fa-shopping-cart fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $totalm_amt; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>

                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-red'>
                                    <div class='panel-body'>
                                        <p class="sales">
                                            <?php echo $currentWeekNumber;?> Week Sales</p>
                                        <i class='fa fa-shopping-cart fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $total_amtw; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>

                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-ash'>
                                    <div class='panel-body'>
                                        <p class="sales">Yesterday Sales</p>
                                        <i class='fa fa-shopping-cart fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $totaly_amt; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-blue'>
                                    <div class='panel-body'>
                                        <p class="sales"> Total Sales Count</p>
                                        <i class='fa fa-random fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $item_count; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>


                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-brown'>
                                    <div class='panel-body'>
                                        <p class="sales">
                                            <?php echo $y?> Sales Count</p>
                                        <i class='fa fa-random fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $Qt_count; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>
                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-green'>
                                    <div class='panel-body'>
                                        <p class="sales">
                                            <?php echo $m?> Sales Count</p>
                                        <i class='fa fa-random fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $Qm_count; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>



                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-red'>
                                    <div class='panel-body'>
                                        <p class="sales">
                                            <?php echo $currentWeekNumber;?>Weeks Sales Count</p>
                                        <i class='fa fa-random fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $item_countw; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>


                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-ash'>
                                    <div class='panel-body'>
                                        <p class="sales"> Yesterday Sales Count</p>
                                        <i class='fa fa-random fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $qty_amt; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <?php
										include ('db.php');
                                        
										$sql = "SELECT * FROM semi_posts WHERE date = '$curdate'";
										$run_query = mysqli_query($con,$sql);
                                          $countt = mysqli_num_rows($run_query);
                                          if($countt > 0){
                                              $totalt_amt = 0;
                                               $item_countt= 0;
                                             while($row = mysqli_fetch_array($run_query)){  
										$no = $no + 1;
                                        $qtyt = $row["quantity"];
                                        $pro_pricet = $row["sub_prices"];         
											$id = $row['ids'];
                                            
                                            $pricet_array = array($pro_pricet);
                                            $totalt_sum = array_sum($pricet_array);
                                            $totalt_amt = $totalt_amt + $totalt_sum;     
                                                 
                                            $Itt_array = array($qtyt);
                                            $Itt_total = array_sum($Itt_array);
                                            $item_countt = $item_countt + $Itt_total; 
                                             }
                                          }else{
                                              echo "No sales Today";
                                          }
                                                 
                                                 ?>

                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-blue'>
                                    <div class='panel-body'>
                                        <p class="sales">
                                            <?php echo $dayOfWeek;?> Sales</p>
                                        <i class='fa fa-random fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $totalt_amt; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>
                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-brown'>
                                    <div class='panel-body'>
                                        <p class="sales">
                                            <?php echo $dayOfWeek;?> Sales Count</p>
                                        <i class='fa fa-random fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $item_countt; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="customer-analysis">
                    <div style="border: solid 2px blue">
                        <div class="row">
                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-blue'>
                                    <div class='panel-body'>
                                        <p class="sales">Total Customer Count</p>
                                        <i class='fa fa-users fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $count; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>



                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-brown'>
                                    <div class='panel-body'>
                                        <p class="sales">
                                            <?php echo $y;?> Customer Count</p>
                                        <i class='fa fa-users fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $county; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>

                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-green'>
                                    <div class='panel-body'>
                                        <p class="sales">
                                            <?php echo $m;?> Customer Count</p>
                                        <i class='fa fa-users fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $countm; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>

                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-red'>
                                    <div class='panel-body'>
                                        <p class="sales">
                                            <?php echo $currentWeekNumber;?> Week Customer Count</p>
                                        <i class='fa fa-users fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $countw; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>

                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-ash'>
                                    <div class='panel-body'>
                                        <p class="sales">Yesterday Customer Count</p>
                                        <i class='fa fa-users fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $county; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class='col-sm-2'>
                                <div class='panel text-center no-boder bg-color-blue'>
                                    <div class='panel-body'>
                                        <p class="sales">Today's Customer Count</p>
                                        <i class='fa fa-users fa-3x pull-left'></i>
                                        <h3 class="pull-right">
                                            <?php echo $countt; ?>
                                        </h3>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="popular-items">
                    <?php
//require_once 'includes/init.php';										
include ('db.php');

$sql = "SELECT items, count(items) AS qt FROM semi_posts GROUP BY items ORDER BY items ASC LIMIT 20";
$lowItems = array();
     $num++;
$query = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($query)){
    $item = array();
    $item = array(
                        'items' => $row['items'],
                         
                        'quantity' => $row['quantity']
                         
                        );
                        $lowItems[] = $item;
    
    
}

 ?>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>

                                                <tr>


                                                    <th>S/N</th>

                                                    <th>Items</th>


                                                </tr>

                                            </thead>
                                            <tbody>
                                                <?php foreach($lowItems as $item): ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $num++;?>
                                                    </td>

                                                    <td>
                                                        <?php echo $item['items']; ?>
                                                    </td>

                                                </tr>

                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <?php
										
include ('db.php');

$sql = "SELECT items, SUM(quantity) AS quantity FROM semi_posts GROUP BY items ORDER BY items ASC LIMIT 20";
$popularItems = array();
     $nump = 0;
   $nump++;  
$query = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($query)){
     
    $Pitem = array();
    $Pitem = array(
                        'items' => $row['items'],
                         
                        'quantity' => $row['quantity']
                
                        );
                        $popularItems[] = $Pitem;
    
}

 ?>

                        <div class="col-md-6">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                            <thead>

                                                <tr>


                                                    <th>S/N</th>

                                                    <th>Items</th>
                                                    <th>Quantity</th>

                                                </tr>

                                            </thead>
                                            <tbody>
                                                <?php foreach($popularItems as $Pitem): ?>
                                                <tr<?php echo ($Pitem['quantity'] <=10 )?' class="danger"': '';?> <?php echo ($Pitem[' quantity']>= 20 )?' class="success"': '';?>>
                                                    <td>
                                                        <?php echo $nump++;?>
                                                    </td>

                                                    <td>
                                                        <?php echo $Pitem['items']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $Pitem['quantity']; ?>
                                                    </td>

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


                <div class="client-name">
                    <?php
									
include ('db.php');

$sql = "SELECT user_id, SUM(quantity) AS quantity FROM semi_posts GROUP BY user_id ORDER BY user_id ASC LIMIT 10";
$clientItems = array();
$nums = 0;
   $nums++;            
$query = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($query)){
    $u = $row['user_id'];
    
    $sqlk = "SELECT * FROM user_info WHERE user_id = '$u'";
    $kquery = mysqli_query($con, $sqlk);
while($rowk = mysqli_fetch_array($kquery)){
   
   
    $citem = array();
    $citem = array(
                         'user_id' => $rowk['user_id'],
                        'first_name' => $rowk['first_name'],
                        'last_name' => $rowk['last_name'],
                        'email' => $rowk['email'],
                         
                        'quantity' => $row['quantity'],
                         'token'   => $rowk['token']
                        );
    
     
                        $clientItems[] = $citem;
    
    
}
}
                
 ?>
                    <?php
                    /*
                                         
                                       if(isset($_POST['sub'])){
                                        if ($_POST['acs'] == 'yes'){
                                             
                                                 $result = "$hashednote";
                                             }else{
                                                 echo "Please Check all the checkbox";
                                             }
                                         }  
                                       */
                                       
                                        ?>
 
     
 


                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <form action="anaysis.php" method="post" id="coupon_form">
                                            <table class="table table-bordered table-hover" id="dataTables-example2">
                                                <thead>

                                                    <tr>


                                                        <th>S/N</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Email</th>

                                                        <th>Quantity</th>
                                                        <th>Copoun Code</th>
                                                       
                                                       


                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php foreach($clientItems as $citem): ?>
    
                                                  <?php
$hashedtoken = password_hash($citem['token'], PASSWORD_DEFAULT);
if(isset($_POST['save'])){ 

include ('db.php');

 $query = "INSERT INTO code ( id , user_id, first_name, last_name, email, qty, codes ,date_added) VALUES(Null, '".$citem['user_id']."','".$citem['first_name']."','".$citem['last_name']."', '".$citem['email']."', '".$citem['quantity']."', '$hashedtoken', CURRENT_TIMESTAMP)";
      
       $res = mysqli_query( $con, $query);

    
   if ($res) { 
       
       echo "saved Successfully";
}else{
       echo "Sorry there is a problem";
        //echo "Error:" . $query . "<br>" . mysqli_error($con);
   }
}


?>
                                                
                                                  
                                                  
                                                   <tr>

                                                        <td>
                                                            <?php echo  $nums++; ?>
                                                        </td>
                                                        <td><input type="text" class="form-control" name="fName" value="<?php echo $citem['first_name']; ?>" autocomplete="off" readonly></td>
                                                        <td><input type="text" class="form-control" name="lName" value="<?php echo $citem['last_name']; ?> " autocomplete="off" readonly></td>
                                                        <td><input type="email" class="form-control" name="email" value="<?php echo $citem['email']; ?>" autocomplete="off" readonly></td>
                                                        <td><input type="number" class="form-control" name="qtyc" value="<?php echo $citem['quantity']; ?>" autocomplete="off" readonly style="width:70px;"></td>
                                                        <td><input type="text" class="form-control"  name="token" value="<?php echo $hashedtoken; ?>"></td>


                                                      
						
						
                                                        <?php endforeach; ?>

                                                </tbody>

                                            </table>
                                            <button type="submit" name="save" class="pull-right submitBtn">Save</button>
                                            <a href="/chilee/admin/send-multiple-email-using-phpmailer-with-php-ajax/indexs.php" role="button" class="btn-btn-primary pull-right">Send Message</a>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

      

                    </div>

                </div>
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example1').dataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#dataTables-example2').dataTable();
        });
    </script>

    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    <script>
        $(".customer-analysis").hide();
        $(".popular-items").hide();
        $(".client-name").hide();

        $(".login").css("background", "#fff");

        $(".login").click(function() {
            $(".customer-analysis").hide();
            $(".popular-items").hide();
            $(".client-name").hide();
            $(".sales-analysis").fadeIn(500);
            $(".signup").css("background", "none");
            $(".login").css("background", "blue");
            $(".popular").css("background", "none");
            $(".customer").css("background", "none");
            $(".login").fadeIn(500);

        });

        $(".signup").css("background", "none");

        $(".signup").click(function() {
            $(".customer-analysis").fadeIn(500);
            $(".sales-analysis").hide();
            $(".popular-items").hide();
            $(".client-name").hide();
            $(".login").css("background", "none");
            $(".signup").css("background", "blue");
            $(".popular").css("background", "none");
            $(".customer").css("background", "none");
            $(".signup").fadeIn(500);

        });

        $(".popular").css("background", "none");

        $(".popular").click(function() {
            $(".popular-items").fadeIn(500);
            $(".customer-analysis").hide();
            $(".sales-analysis").hide();
            $(".client-name").hide();
            $(".login").css("background", "none");
            $(".signup").css("background", "none");
            $(".popular").css("background", "blue");
            $(".customer").css("background", "none")
            $(".popular").fadeIn(500);

        });

        $(".customer").css("background", "none");

        $(".customer").click(function() {
            $(".client-name").fadeIn(500);
            $(".customer-analysis").hide();
            $(".sales-analysis").hide();
            $(".popular-items").hide();
            $(".login").css("background", "none");
            $(".signup").css("background", "none");
            $(".popular").css("background", "none");
            $(".customer").css("background", "blue")
            $(".customer").fadeIn(500);

        });
    </script>

    <script type="text/javascript">
        function selectAll() {
            var items = document.getElementsByName('acs');
            for (var i = 0; i < items.length; i++) {
                if (items[i].type == 'checkbox')
                    items[i].checked = true;

            }
        }

        function UnSelectAll() {
            var items = document.getElementsByName('acs');
            for (var i = 0; i < items.length; i++) {
                if (items[i].type == 'checkbox')
                    items[i].checked = false;
            }
        }
    </script>


</body>

</html>