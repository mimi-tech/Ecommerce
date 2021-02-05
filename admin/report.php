<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?> 
<?php
session_start();										
include ('db.php');
 $y = date('Y');
 $m = date('F');
$sql = "SELECT * FROM semi_posts WHERE c_year = '$y' AND month_added = '$m'";
$run_query = mysqli_query($con,$sql);
$countm= mysqli_num_rows($run_query);
if($countm > 0){

 while($row = mysqli_fetch_array($run_query)){  

$pro_totaltm = $row["sub_prices"];         

 $priceym_array = array($pro_totaltm);
 $totaltm_sum = array_sum($priceym_array);
 $totaltm_amt = $totaltm_amt + $totaltm_sum;

 
}
 }

?>

<?php
	
include ('db.php');
 $y = date('Y');
 $m = date('F');
$sql = "SELECT * FROM semi_posts WHERE c_year = '$y' AND month_added = 'April'";
$run_query = mysqli_query($con,$sql);
$counta = mysqli_num_rows($run_query);
if($counta > 0){

  $totalta_amt = 0;
 while($row = mysqli_fetch_array($run_query)){  

$pro_totalta = $row["sub_prices"];         

 $pricea_array = array($pro_totalta);
 $totalta_sum = array_sum($pricea_array);
 $totalta_amt = $totalta_amt + $totalta_sum;
 
 
}
 }
 
?>
<?php
	
include ('db.php');
 $y = date('Y');
 $m = date('F');
$sql = "SELECT * FROM semi_posts WHERE c_year = '$y' AND month_added = 'May'";
$run_query = mysqli_query($con,$sql);
$countmy = mysqli_num_rows($run_query);
if($countmy > 0){

  $totaltmy_amt ;
 while($row = mysqli_fetch_array($run_query)){  

$pro_totaltmy = $row["sub_prices"];         

 $pricemy_array = array($pro_totaltmy);
 $totaltmy_sum = array_sum($pricemy_array);
 $totaltmy_amt = $totaltmy_amt + $totaltmy_sum;
 
 
}
 }
 
?>

<?php
	
include ('db.php');
 $y = date('Y');
 $m = date('F');
$sql = "SELECT * FROM semi_posts WHERE c_year = '$y' AND month_added = 'June'";
$run_query = mysqli_query($con,$sql);
$countj = mysqli_num_rows($run_query);
if($countj > 0){

  $totaltj_amt ;
 while($row = mysqli_fetch_array($run_query)){  

$pro_totaltj = $row["sub_prices"];         

 $pricetj_array = array($pro_totaltj);
 $totaltj_sum = array_sum($pricetj_array);
 $totaltj_amt = $totaltj_amt + $totaltj_sum;
 
 
}
 }
 
?>

<?php
	
include ('db.php');
 $y = date('Y');
 $m = date('F');
$sql = "SELECT * FROM semi_posts WHERE c_year = '$y' AND month_added = 'July'";
$run_query = mysqli_query($con,$sql);
$countjy = mysqli_num_rows($run_query);
if($countjy > 0){

  $totaltjy_amt ;
 while($row = mysqli_fetch_array($run_query)){  

$pro_totaltjy = $row["sub_prices"];         

 $pricetjy_array = array($pro_totaltjy);
 $totaltjy_sum = array_sum($pricetjy_array);
 $totaltjy_amt = $totaltjy_amt + $totaltjy_sum;
 
 
}
 }
 
?>

<?php
	
include ('db.php');
 $y = date('Y');
 $m = date('F');
$sql = "SELECT * FROM semi_posts WHERE c_year = '$y' AND month_added = 'Augest'";
$run_query = mysqli_query($con,$sql);
$countau = mysqli_num_rows($run_query);
if($countau > 0){

  $totaltau_amt ;
 while($row = mysqli_fetch_array($run_query)){  

$pro_totaltau = $row["sub_prices"];         

 $pricetau_array = array($pro_totaltau);
 $totaltau_sum = array_sum($pricetau_array);
 $totaltau_amt = $totaltau_amt + $totaltau_sum;
 
 
}
 }
 
?>

<?php
	
include ('db.php');
 $y = date('Y');
 $m = date('F');
$sql = "SELECT * FROM semi_posts WHERE c_year = '$y' AND month_added = 'September'";
$run_query = mysqli_query($con,$sql);
$counts = mysqli_num_rows($run_query);
if($counts > 0){

  $totalts_amt ;
 while($row = mysqli_fetch_array($run_query)){  

$pro_totalts = $row["sub_prices"];         

 $pricets_array = array($pro_totalts);
 $totalts_sum = array_sum($pricets_array);
 $totalts_amt = $totalts_amt + $totalts_sum;
 
 
}
 }
 
?>


<?php
	
include ('db.php');
 $y = date('Y');
 $m = date('F');
$sql = "SELECT * FROM semi_posts WHERE c_year = '$y' AND month_added = 'October'";
$run_query = mysqli_query($con,$sql);
$counto = mysqli_num_rows($run_query);
if($counto > 0){

  $totalto_amt = 0;
 while($row = mysqli_fetch_array($run_query)){  

$pro_totalto = $row["sub_prices"];         

 $priceto_array = array($pro_totalto);
 $totalto_sum = array_sum($priceto_array);
 $totalto_amt = $totalto_amt + $totalto_sum;
 
 
}
 }
 echo $totalto_amt;
?>

<?php
	
include ('db.php');
 $y = date('Y');
 $m = date('F');
$sql = "SELECT * FROM semi_posts WHERE c_year = '$y' AND month_added = 'November'";
$run_query = mysqli_query($con,$sql);
$countn = mysqli_num_rows($run_query);
if($countn > 0){

  $totaltn_amt ;
 while($row = mysqli_fetch_array($run_query)){  

$pro_totaltn = $row["sub_prices"];         

 $pricetn_array = array($pro_totaltn);
 $totaltn_sum = array_sum($pricetn_array);
 $totaltn_amt = $totaltn_amt + $totaltn_sum;
 
 
}
 }
 
?>

<?php
	
include ('db.php');
 $y = date('Y');
 $m = date('F');
$sql = "SELECT * FROM semi_posts WHERE c_year = '$y' AND month_added = 'December'";
$run_query = mysqli_query($con,$sql);
$countd = mysqli_num_rows($run_query);
if($countd > 0){

  $totaltd_amt ;
 while($row = mysqli_fetch_array($run_query)){  

$pro_totaltd = $row["sub_prices"];         

 $pricetd_array = array($pro_totaltd);
 $totaltd_sum = array_sum($pricetd_array);
 $totaltd_amt = $totaltd_amt + $totaltd_sum;
 
 
}
 }
 
?>


 <?php
										include ('db.php');
                                        
										$sql = "SELECT * FROM semi_posts WHERE c_year = '$y'";
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
                <a class="navbar-brand" href="index.php">
                    <?php echo $_SESSION["user"]; ?> </a>
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
                        <a href="chart.php"><i class="fa fa-dashboard"></i> Chart</a>
                    </li>
                </ul>


            </div>

        </nav>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Payment Details<small> </small>
                        </h1>
                    </div>
                </div>

        <?php
 
$dataPoints = array(
    array("label"=> "Jaunary", "y"=> 00.0),
    array("label"=> "Febuary", "y"=> 00.0),
    
	array("label"=> "March", "y"=> $totaltm_amt),
	array("label"=> "April", "y"=> $totalta_amt),
	array("label"=> "May", "y"=> $totaltmy_amt),
	array("label"=> "June", "y"=> $totaltj_amt),
	array("label"=> "July", "y"=> $totaltjy_amt),
	array("label"=> "Augest", "y"=> $totaltau_amt),
	array("label"=> "September", "y"=> $totalts_amt),
	array("label"=> "October", "y"=> $totalto_amt),
	array("label"=> "Novermber", "y"=> $totaltn_amt),
	
	array("label"=> "December", "y"=> $totaltd_amt)
);
	
?>
               <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
    backgroundColor: "#F5DEB3",
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Chilee Market Share - 2019"
	},
	axisY: {
		suffix: "",
		scaleBreaks: {
			autoCalculate: true
		}
	},
	data: [{
		type: "column",
		//yValueFormatString: "#,##0\"%\"",
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
               <div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
           
            <table class="table table-bordered table-condensed text-right">
            <legend>Total</legend>
            <thead class="totals-table-header">
               
                
                <th>Grand Total</th>

            </thead>

            <tbody>
                <tr>
                    
                    
                    <td class="bg-success">
                        <?php echo $total_amt; ?>
                    </td>
                </tr>
            </tbody>
        </table>
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
        $(document).ready(function() {
            $('#dataTables-example').dataTable();
        });
    </script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>